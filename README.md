# Karya Inovasi Success Examination

## How to run the app

> [See Here](https://devmarketer.io/learn/setup-laravel-project-cloned-github-com/)

## DOCS

### Available User

-   admin

```
email: admin@gmail.com
password: password
```

-   user

```
email: user@gmail.com
password: password
```

### User RBAC

-   admin

```
'admin' => [
    'user' => ['create', 'read', 'update', 'delete'],
    'category' => ['create', 'read', 'update', 'delete'],
    'article' => ['create', 'read', 'update', 'delete'],
    'role' => ['create', 'read', 'update', 'delete'],
    'permission' => ['create', 'read', 'update', 'delete'],
]
```

-   user

```
'user' => [
    'my-stories' => ['create', 'read', 'update', 'delete'],
]
```

-   all user

```
login, register, view stories
```
