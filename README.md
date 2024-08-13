# Tiptap issue [445](https://github.com/awcodes/filament-tiptap-editor/issues/445)

## Setup

- clone
- make sure you have .env (copy .env.example) and generate key
- composer install
- php artisan migrate (uses sqlite)
- php artisan serve

## Steps to reproduce

- Go to: `http://127.0.0.1:8000/admin/` (port might be different)
- In posts create a new plain_text entry: 123 (leave rich_text blank)
- In post create a new plain_text that contains any string character such as '123a' (leave rich_text blank)
- See: `app/Filament/Resources/PostResource/Pages/EditPost.php` for code. Uncomment each individual part between `/* ... */` one at a time and comment out the ones before.
