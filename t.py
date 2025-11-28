import os
import crypto
def generate_tree_markdown(path, indent=""):
    entries = sorted(os.listdir(path))
    tree_md = ""

    for index, entry in enumerate(entries):
        full_path = os.path.join(path, entry)
        is_last = index == len(entries) - 1

        prefix = "└── " if is_last else "├── "
        next_indent = "    " if is_last else "│   "

        tree_md += f"{indent}{prefix}{entry}\n"

        if os.path.isdir(full_path):
            tree_md += generate_tree_markdown(full_path, indent + next_indent)

    return tree_md


def export_tree_to_markdown(path, output_file="PROJECT_STRUCTURE.md"):
    project_name = os.path.basename(os.path.abspath(path))
    md_content = f"# Struktur Proyek: {project_name}\n\n```\n"
    md_content += generate_tree_markdown(path)
    md_content += "```"

    with open(output_file, "w", encoding="utf-8") as f:
        f.write(md_content)

    print(f"[OK] Markdown berhasil dibuat: {output_file}")


if __name__ == "__main__":
    print("[INFO] Memulai scan struktur proyek...")
    export_tree_to_markdown(".")
    print("[DONE] Selesai.")
