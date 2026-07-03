# Contributing Guidelines

Terima kasih telah berkontribusi pada proyek ini! Berikut adalah aturan main tim kita:

## Alur Kerja (Workflow)
1. **Semua pengembangan (fitur/bugfix)** harus dilakukan pada branch baru yang dicabang (branch off) dari branch `develop`.
2. Nama branch harus menggunakan format: `feature/nama-fitur` atau `bugfix/nama-bug`.
3. Setelah selesai, buat **Pull Request (PR)** dengan target ke branch `develop`, BUKAN ke `main`.
4. Branch `main` hanya digunakan untuk *production release* (kode yang sudah stabil dan siap tayang). Penggabungan ke `main` hanya boleh dilakukan dari `develop`.

## Standar Kode & Commit
- Tulis *commit message* yang jelas, menggunakan format konvensional (contoh: `feat: add user login`, `fix: handle null exception`).
- Pastikan kodingan bersih dan tidak meninggalkan `console.log()` atau `dd()`/`var_dump()`.
- Jangan *push* file sensitif atau `.env`.
