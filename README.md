<p align="center"><a href="https://facemask-tyi4m.ondigitalocean.app/" target="_blank"><img src="https://facemask-tyi4m.ondigitalocean.app/img/cover.jpg" width="400"></a></p>

## About facemask

facemask is a mini social media. It tries to assist us to go through this pandemic by sharing our experiencies and learn from each other. This is my submission on the [DigitalOcean App Platform Hackathon](https://dev.to/devteam/announcing-the-digitalocean-app-platform-hackathon-on-dev-2i1k)

<div style="text-align:center">
[![Deploy to DO](https://mp-assets1.sfo2.digitaloceanspaces.com/deploy-to-do/do-btn-blue.svg)](https://cloud.digitalocean.com/apps/new?repo=https://github.com/alladinmelico/facemask/tree/master&refcode=d5a8688f39ac)
<div>

### Screenshots

-   Landing Page
    ![Landing Page](https://dev-to-uploads.s3.amazonaws.com/i/ixbbxqtqmfojhy1rfb3f.gif)

-   Registration
    ![Registration](https://dev-to-uploads.s3.amazonaws.com/i/rs1m4o3q5udro4vxtiaq.gif)

-   Login
    ![Alt Text](https://dev-to-uploads.s3.amazonaws.com/i/fx0roqgk9sp83vh2e1zx.gif)

-   Dashboard
    ![Alt Text](https://dev-to-uploads.s3.amazonaws.com/i/9ksqqzoyyajac0fcv1o9.gif)

-   Update profile cover and create Post
    ![Alt Text](https://dev-to-uploads.s3.amazonaws.com/i/la4i7l6lrbzemka0u93s.gif)

-   Edit and delete post
    ![Alt Text](https://dev-to-uploads.s3.amazonaws.com/i/z17miic0hnmiycyurbvo.gif)

-   Comments
    ![Alt Text](https://dev-to-uploads.s3.amazonaws.com/i/74qr4pdbx7ci70awycte.gif)

-   Chat
    ![Alt Text](https://dev-to-uploads.s3.amazonaws.com/i/mokfhkk637i5tonj7j9b.gif)

-   Tags
    ![Alt Text](https://dev-to-uploads.s3.amazonaws.com/i/uvs6myc301mo6dsnnlhk.gif)

-   Search
    ![Alt Text](https://dev-to-uploads.s3.amazonaws.com/i/29b6e79yqd1io10ujclq.gif)

### Description

**Tech Stack**

-   backend: [Laravel 8](https://laravel.com/docs/8.x)
-   frontend: [Vue](https://vuejs.org/)
-   UI framework: [Vuetify](https://vuetifyjs.com/en/)
-   SPA: [Inertia JS](https://inertiajs.com/)
-   Scaffolding: [Laravel Jetstream](https://jetstream.laravel.com/1.x/introduction.html) - a kit for all the auth I need
-   Realtime feature: [Pusher](https://dashboard.pusher.com/)

**Features**

-   BREAD of posts
-   Comments system
-   Real-time chat
-   See user's status(Staying at home, Covid Positive, Tested Negative, Under Quarantine, A survivor, Vaccinated, and a verified Doctor)
-   Followings, likes, post bookmark
-   Global search on posts, comments, and users.
-   Dashboard for showing stats and newsfeed.

### Additional Resources/Info

If you are building app using Laravel 8 here are some configs that might help you:

-   the default database database.php is mysql and it comes with charset of utf8mb4. The default dabase in the App Platform is pgsql it expects the charset to be utf8. So might encounter an error if you deploy your Laravel 8 app with all those defaults.
-   I had to set all the routes to https since App Platform serves your app with Https. Put this in AppServiceProvider.php

```php
if (env('APP_ENV') === 'production') {
    \Illuminate\Support\Facades\URL::forceScheme('https');
}
```

-   Just a reminder (for those who new to deploying app), all the variables you used in the .env file should be put on App Platform's env variables.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
