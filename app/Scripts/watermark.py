#!/usr/bin/env python3
import sys
import os
import math
from PIL import Image, ImageOps, ImageDraw, ImageFont

def generate_watermark(original_path, watermark_path, logo_path):
    try:
        # Check if original exists
        if not os.path.exists(original_path):
            print(f"Error: Original image path does not exist: {original_path}", file=sys.stderr)
            return False

        # Ensure output directory exists
        output_dir = os.path.dirname(watermark_path)
        if output_dir:
            os.makedirs(output_dir, exist_ok=True)

        # Open original image
        with Image.open(original_path) as im:
            # Apply EXIF rotation to keep original orientation
            im = ImageOps.exif_transpose(im)
            
            # Convert to RGBA for alpha channel operations
            original_rgba = im.convert("RGBA")
            width, height = original_rgba.size

            # Create transparent overlay layer of the same size
            overlay = Image.new("RGBA", original_rgba.size, (0, 0, 0, 0))

            # Check if custom PNG logo watermark exists
            if logo_path and os.path.exists(logo_path):
                # Load PNG logo
                with Image.open(logo_path) as logo:
                    logo_rgba = logo.convert("RGBA")
                    w_width, w_height = logo_rgba.size

                    # Sizing matching PHP: geometric mean of the dimensions
                    size_base = math.sqrt(width * height)
                    
                    # Each tile occupies about 18% of the geometric mean
                    new_w = int(size_base * 0.18)
                    if new_w <= 0:
                        new_w = 1
                    new_h = int(w_height * (new_w / w_width))
                    if new_h <= 0:
                        new_h = 1

                    # Resize logo with Lanczos for premium quality
                    logo_resized = logo_rgba.resize((new_w, new_h), Image.Resampling.LANCZOS)

                    # Grid spacing matching PHP: 2.2x size
                    step_x = int(new_w * 2.2)
                    step_y = int(new_h * 2.2)

                    row = 0
                    for y in range(-new_h, height + new_h, step_y):
                        # Alternate row staggering
                        offset_x = 0 if row % 2 == 0 else int(step_x / 2)
                        for x in range(-new_w + offset_x, width + new_w, step_x):
                            overlay.paste(logo_resized, (x, y), logo_resized)
                        row += 1
            else:
                # Fallback to text watermark
                draw = ImageDraw.Draw(overlay)
                
                # Load standard system fonts on Linux or PIL default
                font = None
                font_paths = [
                    "/usr/share/fonts/truetype/dejavu/DejaVuSans-Bold.ttf",
                    "/usr/share/fonts/truetype/freefont/FreeSansBold.ttf",
                    "/usr/share/fonts/truetype/liberation/LiberationSans-Bold.ttf",
                ]
                for path in font_paths:
                    if os.path.exists(path):
                        try:
                            # Use larger size for high resolution photos
                            font_size = max(18, int(math.sqrt(width * height) * 0.02))
                            font = ImageFont.truetype(path, font_size)
                            break
                        except Exception:
                            pass
                if not font:
                    font = ImageFont.load_default()

                text = "RunSnap"
                
                # Calculate text dimensions
                try:
                    bbox = draw.textbbox((0, 0), text, font=font)
                    text_w = bbox[2] - bbox[0]
                    text_h = bbox[3] - bbox[1]
                except AttributeError:
                    # Fallback for old PIL versions
                    if hasattr(draw, 'textsize'):
                        text_w, text_h = draw.textsize(text, font=font)
                    else:
                        text_w, text_h = (len(text) * 12, 24)

                # Grid spacing matching PHP:
                step_x = 180 + text_w
                step_y = 120 + text_h

                # White semi-transparent text (Alpha = 60)
                text_color = (255, 255, 255, 60)

                for x in range(40, width, step_x):
                    for y in range(40, height, step_y):
                        draw.text((x, y), text, font=font, fill=text_color)

            # Combine original and overlay
            watermarked = Image.alpha_composite(original_rgba, overlay)

            # Determine extension
            _, ext = os.path.splitext(watermark_path.lower())
            if ext in ['.png']:
                # Save as PNG
                watermarked.save(watermark_path, "PNG", optimize=True)
            else:
                # Save as JPEG (quality 90)
                watermarked.convert("RGB").save(watermark_path, "JPEG", quality=90)

        return True
    except Exception as e:
        print(f"Error during watermark generation: {str(e)}", file=sys.stderr)
        return False

if __name__ == "__main__":
    if len(sys.argv) < 4:
        print("Usage: python3 watermark.py <original_path> <watermark_path> <logo_path>", file=sys.stderr)
        sys.exit(1)

    orig = sys.argv[1]
    out = sys.argv[2]
    logo = sys.argv[3]

    success = generate_watermark(orig, out, logo)
    if success:
        sys.exit(0)
    else:
        sys.exit(1)
