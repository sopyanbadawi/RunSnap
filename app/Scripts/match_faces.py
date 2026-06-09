#!/usr/bin/env python3
import os
import sys
import numpy as np

# Print a friendly message if requirements are missing
try:
    import cv2
    from insightface.app import FaceAnalysis
    from numpy.linalg import norm
except ImportError as e:
    print(f"[!] Warning: Missing dependency: {str(e)}")
    print("[!] Please run: pip install opencv-python insightface onnxruntime numpy")
    # Define placeholder classes/functions so the script doesn't syntax error on load
    class FaceAnalysis:
        def __init__(self, **kwargs): pass
        def prepare(self, **kwargs): pass
    norm = np.linalg.norm

import argparse

def main():
    parser = argparse.ArgumentParser(description="RunSnap AI Face Recognition & Matching Script")
    parser.add_argument('--target', type=str, default='target.jpg',
                        help='Path to target runner selfie image (e.g., storage/app/public/selfies/selfie_1.jpg)')
    parser.add_argument('--collection', type=str, default='koleksi_foto',
                        help='Path to folder of photos to search (e.g., storage/app/public/photos/event-3/original)')
    parser.add_argument('--threshold', type=float, default=0.45,
                        help='Similarity threshold (default: 0.45)')
    parser.add_argument('--gpu', action='store_true',
                        help='Use GPU for inference (default: False)')

    args = parser.parse_args()

    TARGET_IMAGE = args.target
    FOLDER_KOLEKSI = args.collection
    THRESHOLD = args.threshold
    USE_GPU = args.gpu

    # Verify dependency import again before starting inference
    if 'cv2' not in sys.modules or 'insightface' not in sys.modules:
        print("[!] ERROR: Cannot run matching. Please install required libraries:")
        print("    pip install opencv-python insightface onnxruntime numpy")
        return

    # ctx_id=0 artinya GPU, ctx_id=-1 artinya CPU
    ctx = 0 if USE_GPU else -1
    print(f"[*] Menyiapkan model Buffalo_L (Device: {'GPU' if USE_GPU else 'CPU'})...")
    
    try:
        app = FaceAnalysis(name='buffalo_l')
        app.prepare(ctx_id=ctx, det_size=(640, 640))
    except Exception as e:
        print(f"[!] ERROR: Gagal memuat model FaceAnalysis. Detail: {e}")
        return

    def get_embedding(img_path):
        try:
            img = cv2.imread(img_path)
            if img is None:
                return None
            faces = app.get(img)
            if len(faces) > 0:
                return faces[0].embedding
        except Exception as e:
            print(f"[!] Warning: Gagal memproses {img_path}: {e}")
        return None

    def compute_sim(feat1, feat2):
        return np.dot(feat1, feat2) / (norm(feat1) * norm(feat2))

    print(f"[*] Memproses target: {TARGET_IMAGE}...")
    if not os.path.exists(TARGET_IMAGE):
        print(f"[!] ERROR: File target '{TARGET_IMAGE}' tidak ditemukan!")
        return

    target_feat = get_embedding(TARGET_IMAGE)
    if target_feat is None:
        print("[!] ERROR: Wajah tidak terdeteksi di foto target!")
        return

    if not os.path.exists(FOLDER_KOLEKSI):
        print(f"[!] ERROR: Folder koleksi '{FOLDER_KOLEKSI}' tidak ditemukan!")
        return

    all_files = [f for f in os.listdir(FOLDER_KOLEKSI) 
                 if f.lower().endswith(('.jpg', '.jpeg', '.png', '.webp'))]
    
    total_files = len(all_files)
    if total_files == 0:
        print(f"[!] ERROR: Tidak ada gambar di folder '{FOLDER_KOLEKSI}'")
        return

    print(f"[*] Menemukan {total_files} gambar. Memulai pencarian (Threshold: {THRESHOLD})...\n")

    matches_found = 0
    
    for index, filename in enumerate(all_files):
        path_foto = os.path.join(FOLDER_KOLEKSI, filename)
        
        print(f"[{index + 1}/{total_files}] Memeriksa: {filename}", end="\r")
        
        current_feat = get_embedding(path_foto)
        
        if current_feat is not None:
            score = compute_sim(target_feat, current_feat)
            
            if score > THRESHOLD:
                matches_found += 1
                print(f"\n[MATCH] {filename} | Skor: {score:.4f} " + ("(Sangat Mirip)" if score > 0.6 else ""))
        
    print(f"\n\n--- Pencarian Selesai ---")
    print(f"Total Match Ditemukan: {matches_found}")

if __name__ == "__main__":
    main()
