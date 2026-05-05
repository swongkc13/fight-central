# 🥊 Fight Central

**Fight Central** is a full‑stack web application that displays MMA fighters and their details using data from the open **Octagon API**. The app is built with a modern VILT stack — **Laravel**, **Inertia.js**, **Vue 3**, and **Tailwind CSS** — and demonstrates a clean server‑driven SPA experience without a separate API backend.  

The goal of this project is to explore a real‑world API integration, build responsive UI, and learn full‑stack application architecture suitable for portfolio and practical use.
```
fight-central
├─ .editorconfig
├─ .prettierignore
├─ .prettierrc
├─ app
│  ├─ Actions
│  │  └─ Fortify
│  │     ├─ CreateNewUser.php
│  │     └─ ResetUserPassword.php
│  ├─ Concerns
│  │  ├─ PasswordValidationRules.php
│  │  └─ ProfileValidationRules.php
│  ├─ Http
│  │  ├─ Controllers
│  │  │  ├─ Controller.php
│  │  │  ├─ DivisionController.php
│  │  │  ├─ FighterController.php
│  │  │  ├─ RankingController.php
│  │  │  └─ Settings
│  │  │     ├─ PasswordController.php
│  │  │     ├─ ProfileController.php
│  │  │     └─ TwoFactorAuthenticationController.php
│  │  ├─ Middleware
│  │  │  ├─ HandleAppearance.php
│  │  │  └─ HandleInertiaRequests.php
│  │  └─ Requests
│  │     └─ Settings
│  │        ├─ PasswordUpdateRequest.php
│  │        ├─ ProfileDeleteRequest.php
│  │        ├─ ProfileUpdateRequest.php
│  │        └─ TwoFactorAuthenticationRequest.php
│  ├─ Models
│  │  └─ User.php
│  └─ Providers
│     ├─ AppServiceProvider.php
│     └─ FortifyServiceProvider.php
├─ artisan
├─ bootstrap
│  ├─ app.php
│  ├─ cache
│  │  ├─ packages.php
│  │  └─ services.php
│  └─ providers.php
├─ components.json
├─ composer.json
├─ composer.lock
├─ config
│  ├─ app.php
│  ├─ auth.php
│  ├─ cache.php
│  ├─ database.php
│  ├─ filesystems.php
│  ├─ fortify.php
│  ├─ inertia.php
│  ├─ logging.php
│  ├─ mail.php
│  ├─ queue.php
│  ├─ services.php
│  └─ session.php
├─ database
│  ├─ database.sqlite
│  ├─ factories
│  │  └─ UserFactory.php
│  ├─ migrations
│  │  ├─ 0001_01_01_000000_create_users_table.php
│  │  ├─ 0001_01_01_000001_create_cache_table.php
│  │  ├─ 0001_01_01_000002_create_jobs_table.php
│  │  └─ 2025_08_14_170933_add_two_factor_columns_to_users_table.php
│  └─ seeders
│     └─ DatabaseSeeder.php
├─ eslint.config.js
├─ package-lock.json
├─ package.json
├─ phpunit.xml
├─ pint.json
├─ public
│  ├─ .htaccess
│  ├─ apple-touch-icon.png
│  ├─ favicon.ico
│  ├─ favicon.svg
│  ├─ index.php
│  └─ robots.txt
├─ README.md
├─ resources
│  ├─ css
│  │  └─ app.css
│  ├─ js
│  │  ├─ app.ts
│  │  ├─ components
│  │  │  └─ HeroSection.vue
│  │  ├─ composables
│  │  │  ├─ useAppearance.ts
│  │  │  ├─ useCurrentUrl.ts
│  │  │  ├─ useInitials.ts
│  │  │  └─ useTwoFactorAuth.ts
│  │  ├─ layouts
│  │  │  ├─ app
│  │  │  │  ├─ AppHeaderLayout.vue
│  │  │  │  └─ AppSidebarLayout.vue
│  │  │  ├─ AppLayout.vue
│  │  │  ├─ auth
│  │  │  │  ├─ AuthCardLayout.vue
│  │  │  │  ├─ AuthSimpleLayout.vue
│  │  │  │  └─ AuthSplitLayout.vue
│  │  │  ├─ AuthLayout.vue
│  │  │  └─ settings
│  │  │     └─ Layout.vue
│  │  ├─ lib
│  │  │  └─ utils.ts
│  │  ├─ pages
│  │  │  ├─ division
│  │  │  │  ├─ Index.vue
│  │  │  │  └─ Show.vue
│  │  │  ├─ fighters
│  │  │  │  ├─ Index.vue
│  │  │  │  └─ Show.vue
│  │  │  ├─ Home.vue
│  │  │  └─ rankings
│  │  │     ├─ Index.vue
│  │  │     └─ Show.vue
│  │  ├─ ssr.ts
│  │  └─ types
│  │     ├─ auth.ts
│  │     ├─ globals.d.ts
│  │     ├─ index.ts
│  │     ├─ navigation.ts
│  │     └─ ui.ts
│  └─ views
│     └─ app.blade.php
├─ routes
│  ├─ console.php
│  ├─ settings.php
│  └─ web.php
├─ storage
│  ├─ app
│  │  ├─ private
│  │  └─ public
│  ├─ framework
│  │  ├─ cache
│  │  │  └─ data
│  │  ├─ sessions
│  │  ├─ testing
│  │  └─ views
│  │     ├─ 16b16d1c41a23c386c53117cf7f3d991.php
│  │     ├─ 1ff79b25b9c7d8489101e0e3a5e261cf.php
│  │     ├─ 20faa5b6b012f47fc22e153d0ec1e8e7.php
│  │     ├─ 246e89ba1d2715c0b2599bffce31aed0.php
│  │     ├─ 2b5e929b6e11573c059ea7a529b31181.php
│  │     ├─ 338f51a5bbccd75a8a5c2c3371890458.php
│  │     ├─ 43ce8a2c8a080a67716c6a1200d6de55.php
│  │     ├─ 4cc7b747ab5523b344212969ffa7977f.php
│  │     ├─ 5cb8b55c3ce9e62ad108994d4a05c9cb.php
│  │     ├─ 6911703370708af33e213ccbd6223306.php
│  │     ├─ 78fe296e214085c387f1a2e7ee34bc7a.php
│  │     ├─ 7a2c30952ff6faf398f4d84f70a1fa3b.php
│  │     ├─ 8628714b80b1ed7db089bb5c9c817cf1.php
│  │     ├─ 88adffbdeeb9325e3f9be90a66ab216f.php
│  │     ├─ 8e92ec0a5074be9f628578fef3a43c4b.php
│  │     ├─ 960f8d169a943d55bf04555003374c1f.php
│  │     ├─ 9cc38ff94f954495465fb384b6e01118.php
│  │     ├─ 9fa241438cd8deb1d1b91666d09fb94c.php
│  │     ├─ a49e0944c5fa1e14066eb8efa8924e94.php
│  │     ├─ a4dd6352c63e141664b72fc11aa0285d.php
│  │     ├─ a52eb7f21aa6f4243ba6f181a3afa408.php
│  │     ├─ aa46c679ef48237c519e39643c8bb425.php
│  │     ├─ aba6bbfb1dc925e7a776edb68d1b1ddc.php
│  │     ├─ b4fc8e77d6f17db7d4f106656e1d835a.php
│  │     ├─ b56c9b037c1d9d31e69b4919eb6a9969.php
│  │     ├─ b67960c723244a88568662a390764b76.php
│  │     ├─ b76ac4516e2766e3bf89a36ec98a8f41.php
│  │     ├─ bec027382986360825a743e695e1ae1c.php
│  │     ├─ bf4ccc509d0a49431d8835891d892a83.php
│  │     ├─ c36a64e8ace43ec7c17f39147e34325b.php
│  │     ├─ c7325f2f411cd81ccb649613c6349eac.php
│  │     ├─ cd03c16783006e6182ecff34dce8dda2.php
│  │     ├─ cd3ed73668f3318555d3bbea9d5ba4b6.php
│  │     ├─ da8ae6e2730bbe7ca5abe4103f1b2949.php
│  │     ├─ e1619a584fcbb68d568f53380d1e72cf.php
│  │     ├─ e1b9c4c69e54fde6ae6eaa0610762efe.php
│  │     ├─ e2e0149b60f0a93042598dab391f9d2e.php
│  │     ├─ ed19ba8ff801855eb64178be8cb766fa.php
│  │     ├─ edb44e3897e43c9ecd4c0e3e95ebcd10.php
│  │     ├─ ee8b139debcaf1ace0dc68cedf458371.php
│  │     ├─ ef765d66b05a88488e6b73df742b4143.php
│  │     ├─ f03332aa5885f69859769f277fcbd2eb.php
│  │     ├─ f0da22c43dbed5a7a8a13a45da4643e8.php
│  │     ├─ f4b44b2784e985a526784367d5f2b153.php
│  │     └─ f539f48a57e57838432f1730d2c07693.php
│  └─ logs
│     └─ laravel.log
├─ tests
│  ├─ Feature
│  │  ├─ Auth
│  │  │  ├─ AuthenticationTest.php
│  │  │  ├─ EmailVerificationTest.php
│  │  │  ├─ PasswordConfirmationTest.php
│  │  │  ├─ PasswordResetTest.php
│  │  │  ├─ RegistrationTest.php
│  │  │  ├─ TwoFactorChallengeTest.php
│  │  │  └─ VerificationNotificationTest.php
│  │  ├─ DashboardTest.php
│  │  ├─ ExampleTest.php
│  │  └─ Settings
│  │     ├─ PasswordUpdateTest.php
│  │     ├─ ProfileUpdateTest.php
│  │     └─ TwoFactorAuthenticationTest.php
│  ├─ Pest.php
│  ├─ TestCase.php
│  └─ Unit
│     └─ ExampleTest.php
├─ tsconfig.json
└─ vite.config.ts

```