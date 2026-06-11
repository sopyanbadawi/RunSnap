#!/usr/bin/env python3
import os
import sys
import re
import json

# Save original stdout and redirect default stdout to stderr to avoid library log pollution
real_stdout = sys.stdout
sys.stdout = sys.stderr

try:
    import easyocr
except ImportError as e:
    print(f"Error: missing dependency: {str(e)}", file=sys.stderr)
    sys.exit(1)

def main():
    if len(sys.argv) < 2:
        print("Usage: extract_bibs.py <image_path>", file=sys.stderr)
        sys.exit(1)

    img_path = sys.argv[1]

    if not os.path.exists(img_path):
        print(f"Error: image not found: {img_path}", file=sys.stderr)
        sys.exit(1)

    # Initialize EasyOCR (use gpu=False for Docker compatibility)
    reader = easyocr.Reader(['en'], gpu=False, verbose=False)

    # readtext returns a list of tuples: (bounding_box, text, confidence)
    # bounding_box is a list of 4 points: [[x1, y1], [x2, y2], [x3, y3], [x4, y4]]
    result = reader.readtext(img_path)

    bibs = []

    if result:
        for line in result:
            bbox_points = line[0]  # 4 corner points
            text = str(line[1]).strip()
            confidence = line[2]

            # Filter: hanya ambil teks yang berisi angka murni (nomor BIB)
            # Nomor BIB biasanya 1-6 digit angka
            cleaned = re.sub(r'[^0-9]', '', text)

            if cleaned and 1 <= len(cleaned) <= 6 and confidence >= 0.5:
                # Convert 4-point bbox to [x_min, y_min, x_max, y_max]
                x_coords = [p[0] for p in bbox_points]
                y_coords = [p[1] for p in bbox_points]
                bounding_box = [
                    float(min(x_coords)),
                    float(min(y_coords)),
                    float(max(x_coords)),
                    float(max(y_coords))
                ]

                bibs.append({
                    'bounding_box': bounding_box,
                    'bib_number': cleaned
                })

    # Output JSON array only to the real stdout
    print(json.dumps(bibs), file=real_stdout)

if __name__ == "__main__":
    main()
