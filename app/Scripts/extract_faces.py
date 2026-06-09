#!/usr/bin/env python3
import os
import sys

# Save original stdout and redirect default stdout to stderr to avoid library log pollution
real_stdout = sys.stdout
sys.stdout = sys.stderr

import json

try:
    import cv2
    import numpy as np
    from insightface.app import FaceAnalysis
except ImportError as e:
    print(f"Error: missing dependency: {str(e)}", file=sys.stderr)
    sys.exit(1)

def main():
    if len(sys.argv) < 2:
        print("Usage: extract_faces.py <image_path>", file=sys.stderr)
        sys.exit(1)

    img_path = sys.argv[1]

    if not os.path.exists(img_path):
        print(f"Error: image not found: {img_path}", file=sys.stderr)
        sys.exit(1)

    # Initialize InsightFace model buffalo_l using shared storage/insightface directory
    app = FaceAnalysis(name='buffalo_l', root='/app/storage/insightface')
    app.prepare(ctx_id=-1, det_size=(640, 640))

    img = cv2.imread(img_path)
    if img is None:
        print("Error: failed to load image", file=sys.stderr)
        sys.exit(1)

    faces = app.get(img)

    results = []
    for face in faces:
        results.append({
            'bounding_box': [float(x) for x in face.bbox.tolist()],
            'embedding': [float(x) for x in face.embedding.tolist()]
        })

    # Output JSON array only to the real stdout
    print(json.dumps(results), file=real_stdout)

if __name__ == "__main__":
    main()
