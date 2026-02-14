<p align="center">
  <a href="https://laravel.com" target="_blank">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
  </a>
</p>

# RestApiEwallet

REST API sederhana untuk sistem E-Wallet menggunakan:

- Laravel 11  
- JWT Authentication  

---

# ⚙️ Instalasi & Menjalankan Project

```bash
git clone <repo-url>
cd nama-project
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
```

---

# 🔐 Authentication (Users)

Base URL:
```
http://127.0.0.1:8000/api/auth
```

## 1. Register

**POST** `/register`

```json
{
  "name": "user1",
  "email": "user1@gmail.com",
  "password": "passwordcoba",
  "password_confirmation": "passwordcoba"
}
```

---

## 2. Login

**POST** `/login`

```json
{
  "email": "user1@gmail.com",
  "password": "passwordcoba"
}
```

Response: Mengembalikan JWT Token.

---

## 3. Get User (Authenticated)

**GET** `/me`

Header:
```
Authorization: Bearer {token}
```

---

# 💰 Wallet

Base URL:
```
http://127.0.0.1:8000/api/v1/wallet
```

## 1. Get Saldo

**GET** `/`

Header:
```
Authorization: Bearer {token}
```

---

## 2. Deposit

**POST** `/deposit`

```json
{
  "amount": 2000
}
```

---

## 3. Withdraw

**POST** `/withdraw`

```json
{
  "amount": 20000
}
```

---

# 📄 Transaction

Base URL:
```
http://127.0.0.1:8000/api/v1
```

## 1. List Transactions

**GET** `/transactions`

Header:
```
Authorization: Bearer {token}
```

---

## 2. Detail Transaction

**GET** `/transactions/{id}`

Header:
```
Authorization: Bearer {token}
```

---

# 🔁 Transfer

Base URL:
```
http://127.0.0.1:8000/api/v1
```

**POST** `/transfers`

```json
{
  "receiver_wallet_id": 1,
  "amount": 880000,
  "description": "testing"
}
```

Header:
```
Authorization: Bearer {token}
```

