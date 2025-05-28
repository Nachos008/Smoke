# 🎮 Smoke Gaming Website

A modern, full-featured gaming website built with Laravel that provides game reviews, a digital game store, user library management, and community features.

## 📋 Table of Contents

- [Features](#features)
- [Tech Stack](#tech-stack)
- [Installation](#installation)
- [Configuration](#configuration)
- [Usage](#usage)
- [Project Structure](#project-structure)
- [API Endpoints](#api-endpoints)
- [Database Schema](#database-schema)
- [Contributing](#contributing)
- [License](#license)

## ✨ Features

### 🏠 Home Page
- **Game Reviews & Analysis**: In-depth, objective game reviews with detailed analysis
- **Featured Games**: Showcase of new and trending games
- **Discount Section**: Currently discounted games with real-time pricing
- **Best of the Best**: Curated selection of top-rated games with video trailers
- **Technology Tags**: Interactive technology stack display

### 🛒 Game Store
- **Game Catalog**: Browse through extensive game collection
- **Search Functionality**: Find games by title
- **Game Details**: Comprehensive game information including:
  - Cover images and screenshots
  - Developer and publisher information
  - Release dates and ratings
  - Video trailers and media content
  - User and critic review scores
- **Purchase System**: Buy and own games digitally

### 📚 User Library
- **Personal Game Collection**: View all owned games
- **Purchase History**: Track when games were acquired
- **Game Management**: Easy access to owned titles
- **Library Statistics**: Display total games owned

### 👤 User System
- **Registration & Authentication**: Secure user accounts
- **User Profiles**: Personalized user pages with:
  - Profile avatars with initials
  - Member since information
  - Game ownership statistics
  - Personal game library display

### 💬 Community Features
- **Q&A Section**: Community-driven help and discussions
- **Interactive UI**: Modern, responsive design
- **Social Integration**: Community engagement features

## 🛠 Tech Stack

### Backend
- **Framework**: Laravel 12.x
- **Language**: PHP 8.2+
- **Database**: MySQL/SQLite
- **Authentication**: Laravel Auth

### Frontend
- **Template Engine**: Blade Templates
- **Styling**: Custom CSS with modern design
- **JavaScript**: Vanilla JS for interactivity
- **Build Tool**: Vite
- **CSS Framework**: Tailwind CSS 4.0

### Development Tools
- **Package Manager**: Composer (PHP), NPM (Node.js)
- **Testing**: PHPUnit
- **Code Quality**: Laravel Pint

## 🚀 Installation

### Prerequisites
- PHP 8.2 or higher
- Composer
- Node.js & NPM
- MySQL or SQLite database

### Step-by-step Installation

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd Smoke
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install Node.js dependencies**
   ```bash
   npm install
   ```

4. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Database setup**
   ```bash
   # Create database (MySQL)
   # OR for SQLite:
   touch database/database.sqlite
   
   php artisan migrate
   ```

6. **Seed the database (optional)**
   ```bash
   php artisan db:seed
   ```

7. **Build assets**
   ```bash
   npm run build
   # OR for development:
   npm run dev
   ```

8. **Start the development server**
   ```bash
   php artisan serve
   ```

Visit `http://localhost:8000` to see your application.

## ⚙️ Configuration

### Environment Variables
Configure your `.env` file with the following settings:

```env
# Application
APP_NAME="Smoke Gaming"
APP_ENV=local
APP_KEY=base64:generated-key
APP_DEBUG=true
APP_URL=http://localhost:8000

# Database
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=smoke_gaming
DB_USERNAME=your_username
DB_PASSWORD=your_password

# Or for SQLite:
# DB_CONNECTION=sqlite
# DB_DATABASE=/absolute/path/to/database.sqlite
```

### File Storage
Make sure the storage directory is properly linked:
```bash
php artisan storage:link
```

## 📖 Usage

### For Users
1. **Registration**: Create an account via `/register`
2. **Browse Games**: Explore the store at `/store`
3. **Purchase Games**: Buy games and add them to your library
4. **Manage Library**: View owned games at `/library`
5. **Profile Management**: Update profile information at `/profile`

### For Developers
- **Add Games**: Use database seeders or admin interface
- **Customize Styling**: Edit CSS files in `public/styles/`
- **Extend Features**: Add new controllers and routes
- **API Integration**: Utilize existing game and user controllers

## 📁 Project Structure

```
Smoke/
├── app/
│   ├── Http/Controllers/
│   │   ├── GameController.php      # Game catalog and details
│   │   ├── UserController.php      # Authentication and user management
│   │   ├── ProfileController.php   # User profile management
│   │   └── PurchaseController.php  # Game purchase and library
│   └── Models/
│       ├── Games.php               # Game model with relationships
│       ├── User.php                # User authentication model
│       └── Users.php               # Extended user model
├── resources/views/
│   ├── index.blade.php             # Homepage with featured content
│   ├── store.blade.php             # Game catalog and store
│   ├── library.blade.php           # User game library
│   ├── profile.blade.php           # User profile page
│   ├── game.blade.php              # Individual game details
│   ├── q&a.blade.php               # Community Q&A section
│   ├── auth/                       # Authentication views
│   ├── layout/                     # Layout templates
│   └── inc/                        # Reusable components
├── public/
│   ├── styles/                     # Custom CSS files
│   └── image/                      # Static images and assets
├── database/
│   ├── migrations/                 # Database schema
│   └── seeders/                    # Sample data
└── routes/web.php                  # Application routes
```

## 🌐 API Endpoints

### Authentication Routes
- `GET /register` - Registration form
- `POST /register` - User registration
- `GET /login` - Login form
- `POST /login` - User authentication
- `POST /logout` - User logout

### Game Routes
- `GET /` - Homepage
- `GET /store` - Game catalog
- `GET /store/game/{id}` - Game details
- `POST /buy-game/{id}` - Purchase game

### User Routes
- `GET /profile` - User profile
- `GET /library` - User game library
- `POST /sell-game/{id}` - Sell game from library

### Community Routes
- `GET /qa` - Q&A community section

## 🗄️ Database Schema

### Users Table
- `id` - Primary key
- `name` - User display name
- `email` - User email (unique)
- `password` - Hashed password
- `created_at`, `updated_at` - Timestamps

### Games Table
- `game_id` - Primary key
- `title` - Game title
- `description` - Game description
- `price` - Game price
- `cover_image` - Cover image path
- `publisher` - Game publisher
- `developer` - Game developer
- `release_date` - Release date
- `pge_rating` - Age rating
- `review_score` - Average review score
- `tags` - Game tags (JSON)
- `main_trailer_video` - Main trailer URL
- `secondary_trailer_video` - Secondary trailer URL
- `game_image_1`, `game_image_2`, `game_image_3` - Additional screenshots

### User_Games Table (Pivot)
- `user_id` - Foreign key to users
- `game_id` - Foreign key to games
- `purchased_at` - Purchase timestamp
- `created_at`, `updated_at` - Timestamps

## 🎨 Features in Detail

### Game Management System
- **Dynamic Game Catalog**: Fully searchable and filterable game collection
- **Rich Media Support**: Images, trailers, and screenshots
- **Review Integration**: User and critic review scores
- **Purchase Tracking**: Complete purchase history and ownership validation

### User Experience
- **Responsive Design**: Works seamlessly on desktop and mobile
- **Modern UI/UX**: Clean, game-focused interface design
- **Interactive Elements**: Smooth scrolling, hover effects, and animations
- **Accessibility**: Proper semantic HTML and keyboard navigation

### Security Features
- **Authentication Middleware**: Protected routes for authenticated users
- **Input Validation**: Comprehensive form validation
- **Password Hashing**: Secure password storage
- **CSRF Protection**: Built-in Laravel CSRF protection

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

### Development Guidelines
- Follow PSR-12 coding standards
- Write tests for new features
- Update documentation as needed
- Use meaningful commit messages

## 📧 Support

For support, questions, or suggestions:
- Create an issue on GitHub
- Contact the development team

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

---

## 🚀 Getting Started Quick Guide

1. **Clone & Install**:
   ```bash
   git clone <repo-url> && cd Smoke
   composer install && npm install
   ```

2. **Setup Environment**:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

3. **Database & Assets**:
   ```bash
   php artisan migrate
   npm run build
   ```

4. **Launch**:
   ```bash
   php artisan serve
   ```

Visit `http://localhost:8000` and start gaming! 🎮

---

**Built with ❤️ using Laravel Framework**
