#!/usr/bin/env python3

import sys
import json

def main():
    if len(sys.argv) != 6:
        print(json.dumps({"error": "Exactly five values required."}))
        return

    values = sys.argv[1:]
    nums = []
    for v in values:
        try:
            nums.append(float(v))
        except ValueError:
            print(json.dumps({"error": f"Invalid number: {v}"}))
            return

    negative = any(n < 0 for n in nums)
    average = sum(nums) / 5
    positive_count = sum(1 for n in nums if n > 0)
    parity = "even" if (positive_count & 1) == 0 else "odd"
    sorted_values = sorted([n for n in nums if n > 10])

    print(json.dumps({
        "negative": negative,
        "average": average,
        "average_gt_50": average > 50,
        "parity": parity,
        "original": nums,
        "sorted": sorted_values
    }))

if __name__ == "__main__":
    main()