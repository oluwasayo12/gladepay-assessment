<?php
return [
    "app_name" => "AstraKash",

    "sms"=> [
        "sender" => env("SMS_SENDER", "AstraKash"),
        "estore" => [
            "username" => env("ESTORE_USERNAME", "shayo"),
            "password" => env("ESTORE_PASSWORD", "following"),
            "base_url" => env("TERMII_BASE_URL", "http://www.estoresms.com/smsapi.php?")
        ],
        "termii" => [
            "company" => env("TERMII_COMPANY", "AstraKash"),
            "api_key" => env("TERMII_API_KEY", "TLy4LhkDBYvWLo1zxzM9gr5mek6XHBvbJvrovMcQgNaDleLgex7L3SKY6BVpUN"),
            "secret" => env("TERMII_SECRET", "tsk_vuib618520603102f62393lutg"),
            "base_url" => env("TERMII_BASE_URL", "https://termii.com/api/")
        ]
    ],
    "bill" => [
        "estore" => [
            "email" => env("BILL_ESTORE_EMAIL", "oluwasayo12@gmail.com"),
            "username" => env("BILL_ESTORE_USERNAME", "shayo"),
            "password" => env("BILL_ESTORE_PASSWORD", "following"),
            "token" => env("BILL_ESTORE_TOKEN", "geYJCWRX7jBa8jMXKM9nb9c8Qc2M5w"),
            "base_url" => env("BILL_ESTORE_BASE_URL", "https://estoresms.com/bill_payment_processing/v/2/")
        ]
    ],
    "airtime" => [
        "estore" => [
            "email" => env("AIRTIME_ESTORE_EMAIL", "oluwasayo12@gmail.com"),
            "username" => env("AIRTIME_ESTORE_USERNAME", "shayo"),
            "password" => env("AIRTIME_ESTORE_PASSWORD", "following"),
            "token" => env("AIRTIME_ESTORE_TOKEN", "geYJCWRX7jBa8jMXKM9nb9c8Qc2M5w"),
            "base_url" => env("AIRTIME_ESTORE_BASE_URL", "https://estoresms.com/network_list/v/2"),
            "airtime_process_base_url" => env("AIRTIME_ESTORE_BASE_URL", "https://estoresms.com/network_processing/v/2"),
        ]
    ],
    "loan_origination" => [
        "okra" => [
            "client_token" => env("OKRA_CLIENT_TOKEN", "61433a67a2f9fb0041d14bc1"),
            "sandbox_public_key" => env("OKRA_SANDBOX_PUBLIC_KEY", "3d105254-c3b5-5047-96de-2727fa86ca19"),
            "sandbox_secret_key" => env("OKRA_SANDBOX_SECRET_KEY", "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJfaWQiOiI2MTQzM2E2N2EyZjlmYjAwNDFkMTRiYzEiLCJpYXQiOjE2MzE3OTU4MTV9.NExphDrE1U55csZWqGy0w1NVpqn9tVfjxHxE6UPw6uY"),
            "sandbox_url" => env("OKRA_SANDBOX_URL", "https://api.okra.ng/v2/sandbox/"),
        ]
    ]

];
