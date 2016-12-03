SafEye API
===

Provide SafEye basic scan API.

# Installation

Clone this project

```bash
git clone https://github.com/0xlen/safeye-api
cd safeye-api
```

Copy `.config.sample` as `.config`

```bash
cp .config.sample .config
```

Open `.config` and set `api_key` value

```
[virustotal]
api_key = **YOUR_API_KEY**
```

Run server by apache open `http://localhost`

- Apache
    ```bash
    service apache start
    ```

    access api: `http://localhost/api/*`

- PHP built-in web server (PHP > 5.4.0)
    ```
    cd safeye-api
    php -S localhost:8000
    ```

    access api: `http://localhost:8000/api/*`

# API

`/api/url_scan.php`

|type|param|description|
|----|-----|-----------|
|POST| url | url you wanna scan |

# API Provider

- [virustotal public API v2.0](https://www.virustotal.com/en/documentation/public-api/#getting-url-scans)
