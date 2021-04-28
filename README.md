# Laravel

## Setup

- Create new database.
- Update `.env` to your config.
- Run `make setup` on project root directory.

## Testing
#### Run `make test` on project dir. To run unit test on all endpoints.

#### API endpoints
- `/api/auth/login` **(POST)** - Login user
    - `user_name` **required**
    - `password` **required**
- `/api/auth/sign-up` **(POST)** - Sign up user
    - `user_name` **required**
    - `password` **required**
    - `password_confirmation` **required**
    - `code` **required**
- `/api/user/update` **(POST)** - Update user profile
    - `name`
    - `user_name`
    - `avatar`
    - `email` 
- `/api/user/verify` **(POST)** - Verify user account
    - `code` **required|length:6**
- `/api/admin/user/invite/store` **(POST)** - Verify user account
    - `email` **required**