<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Facemask</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900' rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/@mdi/font@4.x/css/materialdesignicons.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.min.css" rel="stylesheet">
        <link rel="shortcut icon" href="/img/icon.ico">
        <!-- Styles -->
        <style>
            /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */html{line-height:1.15;-webkit-text-size-adjust:100%}body{margin:0}a{background-color:transparent}[hidden]{display:none}html{font-family:system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;line-height:1.5}*,:after,:before{box-sizing:border-box;border:0 solid #e2e8f0}a{color:inherit;text-decoration:inherit}svg,video{display:block;vertical-align:middle}video{max-width:100%;height:auto}.bg-white{--bg-opacity:1;background-color:#fff;background-color:rgba(255,255,255,var(--bg-opacity))}.bg-gray-100{--bg-opacity:1;background-color:#f7fafc;background-color:rgba(247,250,252,var(--bg-opacity))}.border-gray-200{--border-opacity:1;border-color:#edf2f7;border-color:rgba(237,242,247,var(--border-opacity))}.border-t{border-top-width:1px}.flex{display:flex}.grid{display:grid}.hidden{display:none}.items-center{align-items:center}.justify-center{justify-content:center}.font-semibold{font-weight:600}.h-5{height:1.25rem}.h-8{height:2rem}.h-16{height:4rem}.text-sm{font-size:.875rem}.text-lg{font-size:1.125rem}.leading-7{line-height:1.75rem}.mx-auto{margin-left:auto;margin-right:auto}.ml-1{margin-left:.25rem}.mt-2{margin-top:.5rem}.mr-2{margin-right:.5rem}.ml-2{margin-left:.5rem}.mt-4{margin-top:1rem}.ml-4{margin-left:1rem}.mt-8{margin-top:2rem}.ml-12{margin-left:3rem}.-mt-px{margin-top:-1px}.max-w-6xl{max-width:72rem}.min-h-screen{min-height:100vh}.overflow-hidden{overflow:hidden}.p-6{padding:1.5rem}.py-4{padding-top:1rem;padding-bottom:1rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.pt-8{padding-top:2rem}.fixed{position:fixed}.relative{position:relative}.top-0{top:0}.right-0{right:0}.shadow{box-shadow:0 1px 3px 0 rgba(0,0,0,.1),0 1px 2px 0 rgba(0,0,0,.06)}.text-center{text-align:center}.text-gray-200{--text-opacity:1;color:#edf2f7;color:rgba(237,242,247,var(--text-opacity))}.text-gray-300{--text-opacity:1;color:#e2e8f0;color:rgba(226,232,240,var(--text-opacity))}.text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.text-gray-500{--text-opacity:1;color:#a0aec0;color:rgba(160,174,192,var(--text-opacity))}.text-gray-600{--text-opacity:1;color:#718096;color:rgba(113,128,150,var(--text-opacity))}.text-gray-700{--text-opacity:1;color:#4a5568;color:rgba(74,85,104,var(--text-opacity))}.text-gray-900{--text-opacity:1;color:#1a202c;color:rgba(26,32,44,var(--text-opacity))}.underline{text-decoration:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.w-5{width:1.25rem}.w-8{width:2rem}.w-auto{width:auto}.grid-cols-1{grid-template-columns:repeat(1,minmax(0,1fr))}@media (min-width:640px){.sm\:rounded-lg{border-radius:.5rem}.sm\:block{display:block}.sm\:items-center{align-items:center}.sm\:justify-start{justify-content:flex-start}.sm\:justify-between{justify-content:space-between}.sm\:h-20{height:5rem}.sm\:ml-0{margin-left:0}.sm\:px-6{padding-left:1.5rem;padding-right:1.5rem}.sm\:pt-0{padding-top:0}.sm\:text-left{text-align:left}.sm\:text-right{text-align:right}}@media (min-width:768px){.md\:border-t-0{border-top-width:0}.md\:border-l{border-left-width:1px}.md\:grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}}@media (min-width:1024px){.lg\:px-8{padding-left:2rem;padding-right:2rem}}@media (prefers-color-scheme:dark){.dark\:bg-gray-800{--bg-opacity:1;background-color:#2d3748;background-color:rgba(45,55,72,var(--bg-opacity))}.dark\:bg-gray-900{--bg-opacity:1;background-color:#1a202c;background-color:rgba(26,32,44,var(--bg-opacity))}.dark\:border-gray-700{--border-opacity:1;border-color:#4a5568;border-color:rgba(74,85,104,var(--border-opacity))}.dark\:text-white{--text-opacity:1;color:#fff;color:rgba(255,255,255,var(--text-opacity))}.dark\:text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}}
        </style>

        <style>
            body {
                font-family: 'Nunito';
            }
        </style>
    </head>

    <body>
        <div id="app">
          <v-app>
            <v-app-bar
              app
              color="secondary primary--text"
              height="100"
            >
              <v-avatar
                class="mr-3"
                size="70"
                color="white"
              >
                <v-img  contain max-height="70%" :src="'/img/logo.png'" alt="logo"></v-img>

              </v-avatar>

              <v-toolbar-title class="font-weight-black headline">
                facemask
              </v-toolbar-title>


              @if (Route::has('login'))
                    <div class="ml-auto">
                        @auth
                                <a href="{{ url('/dashboard') }}" class="primary--text" >Dashboard</a>
                        @else
                                <a href="{{ route('login') }}" class="primary--text mx-3">Login</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="primary--text mx-3">Register</a>
                            @endif
                        @endauth
                    </div>
                @endif
            </v-app-bar>

            <v-main>
              <section id="hero">
                <v-row no-gutters>
                  <v-img
                    :min-height="'calc(100vh - ' + $vuetify.application.top + 'px)'"
                    src="https://images.unsplash.com/photo-1585559605151-d4da31836a99?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80"
                  >
                    <v-theme-provider dark>
                      <v-container fill-height>
                        <v-row
                          align="center"
                          class="white--text mx-auto"
                          justify="center"
                        >
                          <v-col
                            class="white--text text-center"
                            cols="12"
                            tag="h1"
                          >
                            <span
                            :class="[$vuetify.breakpoint.smAndDown ? 'display-1' : 'display-2']"
                              class="font-weight-light"
                            >
                              Welcome to
                            </span>

                            <br>

                            <span

                              :class="[$vuetify.breakpoint.smAndDown ? 'display-3': 'display-4']"
                              class="font-weight-black"
                            >
                              facemask
                            </span>

                          </v-col>

                          <v-btn
                            class="align-self-end"
                            fab
                            outlined
                            @click="$vuetify.goTo('#about-me')"
                          >
                            <v-icon>mdi-chevron-double-down</v-icon>
                          </v-btn>
                        </v-row>
                      </v-container>
                    </v-theme-provider>
                  </v-img>
                </v-row>
              </section>

              <section id="about-me">
                <div class="py-12"></div>

                <v-container class="text-center">
                  <h2 class="display-2 font-weight-bold mb-3">What is this? 🤷‍♂️</h2>

                  <v-responsive
                    class="mx-auto mb-8"
                    width="56"
                  >
                    <v-divider class="mb-1"></v-divider>

                    <v-divider></v-divider>
                  </v-responsive>

                  <v-responsive
                    class="mx-auto title font-weight-light mb-8"
                    max-width="720"
                  >
                  facemask is a mini social media.
                  It tries to assist us to go through this pandemic by sharing our experiencies and learn from each other.
                  This is my submission on the <a href="https://dev.to/devteam/announcing-the-digitalocean-app-platform-hackathon-on-dev-2i1k">DigitalOcean App Platform Hackathon</a>

                  </v-responsive>

                  <v-avatar
                    class="elevation-12 mb-12"
                    size="128"
                  >
                    <v-img :src="'/img/profile.jpg'"></v-img>
                  </v-avatar>

                  <div></div>

                  <v-btn
                    color="grey"
                    href="https://github.com/alladinmelico/facemask"
                    outlined
                    large
                  >
                    <span class="grey--text text--darken-1 font-weight-bold">
                      Source Code
                    </span>
                  </v-btn>
                </v-container>

                <div class="py-12"></div>
              </section>

              <section
                id="features"
                class="yellow lighten-5"
              >
                <div class="py-12"></div>

                <v-container class="text-center">
                  <h2 class="display-2 font-weight-bold mb-3">Simple Features 📱</h2>

                  <v-responsive
                    class="mx-auto mb-12"
                    width="56"
                  >
                    <v-divider class="mb-1"></v-divider>

                    <v-divider></v-divider>
                  </v-responsive>

                  <v-row>
                    <v-col
                      v-for="({ icon, title, text }, i) in features"
                      :key="i"
                      cols="12"
                      md="3"
                    >
                      <v-card
                        class="py-12 px-4 yellow lighten-5" flat
                      >
                        <v-theme-provider dark>
                          <div>
                            <v-avatar
                              color="primary"
                              size="88"
                            >
                              <v-icon
                                large
                                v-text="icon"
                              ></v-icon>
                            </v-avatar>
                          </div>
                        </v-theme-provider>

                        <v-card-title
                          class="justify-center font-weight-black text-uppercase"
                          v-text="title"
                        ></v-card-title>

                        <v-card-text
                          class="subtitle-1"
                          v-text="text"
                        >
                        </v-card-text>
                      </v-card>
                    </v-col>
                  </v-row>
                </v-container>

                <div class="py-12"></div>
              </section>

              <section id="stack">
                <v-parallax
                  :height="$vuetify.breakpoint.smAndDown ? 700 : 500"
                  src="https://images.unsplash.com/photo-1503252947848-7338d3f92f31?ixlib=rb-1.2.1&ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&auto=format&fit=crop&w=1489&q=80"
                >
                  <v-container fill-height>
                    <v-row class="mx-auto">
                      <v-col
                        v-for="[title, img] of stacks"
                        :key="title"
                      >
                        <div class="text-center">
                          <v-avatar
                          color="white"
                          size="80"
                          >
                            <img
                              :src="img"
                              :alt="title"
                            >
                          </v-avatar>

                          <div
                            class="title font-weight-regular text-uppercase"
                            v-text="title"
                          ></div>
                        </div>
                      </v-col>
                    </v-row>
                  </v-container>
                </v-parallax>
              </section>

              <section id="blog">
                <div class="py-12"></div>

                <v-container>
                  <h2 class="display-2 font-weight-bold mb-3 text-uppercase text-center">Dev Blog Series 📝</h2>

                  <v-responsive
                    class="mx-auto mb-12"
                    width="56"
                  >
                    <v-divider class="mb-1"></v-divider>

                    <v-divider></v-divider>
                  </v-responsive>

                  <v-row>
                    <v-col
                      v-for="({ src, text, title, link }, i) in articles"
                      :key="i"
                      cols="12"
                      md="4"
                    >
                        <v-card class="mx-auto" max-width="400" hover>

                            <v-img
                                :src="src"
                                class="mb-4"
                                height="275"
                                max-width="100%"
                            ></v-img>
                            <v-card-title v-text="title"></v-card-title>
                            <v-card-text v-text="text"  class="title font-weight-light mb-5"> </v-card-text>
                            <v-card-actions>
                                <v-btn
                                  text
                                >
                                    <a :href="link">
                                        Continue Reading
                                    </a>
                                </v-btn>
                              </v-card-actions>
                        </v-card>

                      <div


                      ></div>

                      <v-btn
                        class="ml-n4 font-weight-black"
                        text
                      >

                      </v-btn>
                    </v-col>
                  </v-row>
                </v-container>

                <div class="py-12"></div>
              </section>

              <v-sheet
                id="contact"
                color="#333333"
                dark
                tag="section"
                tile
              >
                <div class="py-12"></div>

                <v-container>
                  <v-responsive
                    class="mx-auto mb-12"
                    width="56"
                  >
                    <v-divider class="mb-1"></v-divider>

                    <v-divider></v-divider>
                  </v-responsive>

                  <v-theme-provider light>
                    <v-row align="center" justify="center">
                      <v-col v-for="link in links" :key="link.url" class="d-flex">
                        <v-btn icon class="mx-auto pa-1">
                            <a :href="link.url">
                                <v-icon size="40px" color="primary">
                                    @{{ link.icon }}
                                </v-icon>
                            </a>
                        </v-btn>
                      </v-col>
                    </v-row>
                  </v-theme-provider>
                </v-container>

                <div class="py-12"></div>
              </v-sheet>
            </v-main>

            <v-footer
              class="justify-center"
              color="#292929"
              height="100"
            >
              <div class="title font-weight-light grey--text text--lighten-1 text-center">
                &copy; @{{ date }} — facemask - Developed by Alladin Melico 💛
              </div>
            </v-footer>
          </v-app>
         </div>
         <script src="https://cdn.jsdelivr.net/npm/vue@2.x/dist/vue.js"></script>
         <script src="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.js"></script>
         <script>
          new Vue({
            el: '#app',
            vuetify: new Vuetify({
                theme: {
                    themes: {
                        dark: {
                            primary: '#F5DF4D',
                            secondary: '#939597',
                            accent: '#624CF5',
                            error: '#FF5252',
                            info: '#2196F3',
                            success: '#4CAF50',
                            warning: '#FFC107'
                        },
                        light: {
                            primary: '#F5DF4D',
                            secondary: '#939597',
                            accent: '#624CF5',
                            error: '#FF5252',
                            info: '#2196F3',
                            success: '#4CAF50',
                            warning: '#FFC107'
                        }
                    },
                }
            }),
            data () {
              return {
                date: (new Date()).getFullYear(),
                articles: [
                  {
                    src: 'https://images.unsplash.com/photo-1493612276216-ee3925520721?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=700&q=80',
                    title: 'Planning 🤔',
                    text: "What I'm building? I'll list all features on my last post. Basically, this is a mini socmed app just to share people's experiences during this pandemic. About their struggles to quarantine themselves, how we miss the old normal, and how we can all survive.",
                    link: 'https://dev.to/alladinmelico/facemask-a-mini-social-media-app-for-sharing-pandemic-experiences-1-n-44dj'
                  },
                  {
                    src: 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=1352&q=80',
                    title: 'Redesign 💻',
                    text: 'My initial stack is Laravel 8 with Jetstream, Vue, Inertia.js and Tailwind. I had difficulties maintaining this kind of setup. It was challenging for me to debug. I also have to figure out if I have to fix the frontend or the backend.',
                    link: 'https://dev.to/alladinmelico/facemask-progress-2-n-2ho8'
                  },
                  {
                    src: 'https://images.unsplash.com/photo-1500989145603-8e7ef71d639e?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=1355&q=80',
                    title: 'Minimum viable product 🧱',
                    text: 'I went back to my initial stack after I set up the backend. I also integrated Vuetify onto my UI.',
                    link: '#'
                  },
                ],
                features: [
                  {
                    icon: 'mdi-message-outline',
                    title: 'Chats',
                    text: 'A realtime chat powered by Pusher',
                  },
                  {
                    icon: 'mdi-check-decagram',
                    title: 'User status',
                    text: "You can easily see user's status(Staying at home, Covid Positive, Tested Negative, Under Quarantine, A survivor, Vaccinated, and a verified Doctor).",
                  },
                  {
                    icon: 'mdi-post-outline',
                    title: 'Posting experiences',
                    text: 'A simple create, update, and deleting of post/s with Usplash integration. A simple multilevel nested comment system',
                  },
                  {
                    icon: 'mdi-magnify',
                    title: 'Global Search',
                    text: 'Quickly search posts, comments, or any user you want to follow.',
                  }
                ],
                links: [
                    {
                        url: 'https://www.facebook.com/melico.alladin',
                        icon: 'mdi-facebook'
                    },
                    { url: 'https://twitter.com/iDontHaveALamp', icon: 'mdi-twitter' },
                    { url: 'https://linkedin.com/in/alladin-m', icon: 'mdi-linkedin' },
                    {
                        url: 'https://www.instagram.com/melico.alladin/',
                        icon: 'mdi-instagram'
                    },
                    { url: 'https://dev.to/alladinmelico', icon: 'mdi-dev-to' }
                ],
                stacks: [
                    ['laravel', 'https://upload.wikimedia.org/wikipedia/commons/thumb/9/9a/Laravel.svg/1200px-Laravel.svg.png'],
                    ['Vue', 'https://vuejs.org/images/logo.png'],
                    ['Vuetify', 'https://seeklogo.com/images/V/vuetify-logo-3BCF73C928-seeklogo.com.png'],
                    ['Inertia', 'https://avatars0.githubusercontent.com/u/47703742?s=280&v=4'],
                    ['Pusher', 'https://avatars0.githubusercontent.com/u/739550?s=280&v=4'],
                ]
              }
            }
          })
        </script>
        </body>
</html>
