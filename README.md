## Запуск

Після завантаження запустити команди
- ``php artisan migrate --seed``
- ``php artisan passport:install``

## Робота з API

#### Для роботи з закритими ресурсами потрібно авторизуватися та отримати токен:
```curl 
POST    /api/login
// form-data 
    name (string)Admin
    email (string)admin@gmail.com
    password (string)admin1233
```
Output
```json 
{
    "data": {
        "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiZWQ3NDM2MTNiZjA0N2M3OGM2ZWJlYWViMWE1YjM1ZDE4N2FhOWVhZWFjYWYyM2IzMzlkNGM1Mjg1MzY4NWQzY2QzMDc1YWMxYjI0NTgwOTkiLCJpYXQiOjE2ODY1NTc1MzMuMDIxNzA2LCJuYmYiOjE2ODY1NTc1MzMuMDIxNzA4LCJleHAiOjE3MTgxNzk5MzMuMDE3NDEyLCJzdWIiOiIxMSIsInNjb3BlcyI6W119.Ea_DPXXJv6j-EN5e66cxI_EAe6l18fU9lg2G_esyvDY6uz4567AnChU0TVSkBmFBophC3tPSudFuBxRz8CXWbitH5W6q3noNQgCyXP6T0WYJYcONSMghCLfPOYF1vl984aKS8hQSJ-PRhryz_1eCsbmb__CdaO1uBP7NBCNP4bDzIQHlSP1mmbOEno-5YP2oPuf6-weiosstRDyky_Nvv7yu38i78klVMPQ3KE3sKcfwQ-SkQY2JlMU-_PaeXbQdAGusgDdICManw_tgb437zL0hz2WO0xjWRaOjHooQsTk7P394vAN_T4B7oZS7HVXK2M2b_MnHVr7AcbKDFeZr2jDle_qHaFI-YOd2T8xayZZuLRZ0uMvInth8vG7zS-FH-8Z-V2qOOS_Hf_q4GxaI2EWympQfXH94EZVJjBuCwYYJyIWgIK_k1WusRfWv6i8t_vLGcUyMhpkToDpDcvkszUHrFoHaw3s1kleSO2L4Vd7lxg7jIJdlCB9Pehzz1qy8zXp6EzJzNHg0yuEOcR4DZUkAWzyIfSLGaDxDsZp4BQqooazOHNs0Pxlx7H1RyMguFEFpEVYDp-eIiocxph9_ArJMITZqjnNo7LO8EwWePK_ZrUJw2Cd6ZUyjS4uTEVquhF2vcxln5gfPuwfSjB5kmB38YR4YCEgExwsu4b5HIc0"
    }
}
```

### Доступні маршрути

#### Список всіх відгуків

```curl 
GET 	/api/reviews
// Auth Headers
    Bearer Token = // токен який ви отримали при авторизації
// Aviable query params
    page = (int)3
    sort_by = (string) created_at (default)
    sort_order = (string) desc (default)
    theme_code (string) // фільтрація за темою
        //Aviable themes
        gratitude
        proposal
        сomplaint
```

#### Створення відгука

```curl
POST 	/api/reviews
// Auth Headers
    Bearer Token = // токен який ви отримали при авторизації
//form-data
    theme_code (string, required) 
        //Aviable themes
        gratitude
        proposal
        сomplaint
    user_name (string, required) Any name
    body (string, required) Any text of review
    like_count (int) Any number
    thumbnail (file, jpg or png) Any image

```
#### Перегляд відгука
```curl
GET 	/api/reviews/3
// Auth Headers
    Bearer Token = // токен який ви отримали при авторизації
```

#### Оновлення відгука
```curl
POST 	/api/reviews/3
// Auth Headers
    Bearer Token = // токен який ви отримали при авторизації
//form-data
    theme_code (string, required) 
        //Aviable themes
        gratitude
        proposal
        сomplaint
    user_name (string, required) Any name
    body (string, required) Any text of review
    like_count (int) Any number
    thumbnail (file, jpg or png) Any image
```

#### Видалення відгука
```curl
DELETE 	/api/reviews/3
// Auth Headers
    Bearer Token = // токен який ви отримали при авторизації
```

#### Інформація про користувача
```curl 
GET    /api/user
// Auth Headers
    Bearer Token = // токен який ви отримали при авторизації
```

#### Деактивація токена і вихід з аккаунту
```curl 
POST    /api/logout
// Auth Headers
    Bearer Token = // токен який ви отримали при авторизації
```
