# Students News Portal

A comprehensive news management system built with Laravel, designed for educational institutions to manage and distribute news articles to students and staff.

## 🚀 Live Demo

**Live Site:** [https://red-wren-824127.hostingersite.com](https://red-wren-824127.hostingersite.com)

## 📋 Table of Contents

- [Features](#features)
- [User Roles](#user-roles)
- [Installation](#installation)
- [Configuration](#configuration)
- [Usage](#usage)
- [API Endpoints](#api-endpoints)
- [Database Schema](#database-schema)
- [File Structure](#file-structure)
- [Deployment](#deployment)
- [Troubleshooting](#troubleshooting)
- [Contributing](#contributing)

## ✨ Features

### 🎯 Core Features
- **News Management**: Create, edit, publish, and manage news articles
- **Category System**: Organize news by categories with active/inactive status
- **User Authentication**: Secure login system with role-based access
- **Image Upload**: Support for news article images with automatic storage
- **View Tracking**: Track article views for analytics
- **Search & Filter**: Advanced search and category filtering for news
- **Responsive Design**: Modern UI built with Tailwind CSS

### 👥 Role-Based Access Control
- **Staff Members**: Full access to news management, categories, and enquiries
- **Students**: Read-only access to published news with enquiry submission
- **Public Users**: Can submit enquiries without registration

### 📊 Dashboard Analytics
- **Staff Dashboard**: Overview of news statistics, recent articles, and pending enquiries
- **Student Dashboard**: Personalized news feed with filtering options
- **Real-time Statistics**: View counts, category distribution, and enquiry status

### 📝 Enquiry Management
- **Public Submission**: Anyone can submit enquiries
- **Status Tracking**: Pending, In Progress, Resolved statuses
- **Staff Management**: View, update status, and manage all enquiries
- **User Association**: Enquiries linked to registered users

## 👥 User Roles

### Staff Members
- Create, edit, and delete news articles
- Manage news categories
- Publish/unpublish articles
- View and manage all enquiries
- Access comprehensive dashboard analytics
- Upload images for news articles

### Students
- View published news articles
- Search and filter news by category
- Submit enquiries
- View personal enquiry history
- Access student-specific dashboard

### Public Users
- Submit enquiries without registration
- View public enquiry form

## 🛠️ Installation

### Prerequisites
- PHP 8.1 or higher
- Composer
- MySQL 5.7 or higher
- Node.js and NPM (for asset compilation)

### Step 1: Clone the Repository
```bash
git clone <repository-url>
cd students-news-portal
```

### Step 2: Install Dependencies
```bash
composer install
npm install
```

### Step 3: Environment Setup
```bash
cp .env.example .env
php artisan key:generate
```

### Step 4: Database Configuration
Update your `.env` file with database credentials:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=newsportal
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### Step 5: Run Migrations and Seeders
```bash
php artisan migrate
php artisan db:seed
```

### Step 6: Storage Setup
```bash
php artisan storage:link
```

### Step 7: Build Assets
```bash
npm run build
```

### Step 8: Start Development Server
```bash
php artisan serve
```

## ⚙️ Configuration

### Environment Variables
Key configuration options in `.env`:

```env
APP_NAME="Students News Portal"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-domain.com

# Database
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password

# File Storage
FILESYSTEM_DISK=public

# Session
SESSION_DRIVER=database
SESSION_LIFETIME=120
```

### File Permissions
Ensure proper permissions for storage:
```bash
chmod -R 755 storage/
chmod -R 755 bootstrap/cache/
```

## 📖 Usage

### For Staff Members

#### Managing News Articles
1. **Create News**: Navigate to News → Add News
2. **Upload Image**: Select image file (max 2MB, formats: jpeg, png, jpg, gif)
3. **Set Category**: Choose from available categories
4. **Publish**: Toggle publish status to make articles visible to students

#### Managing Categories
1. **Create Category**: Navigate to Categories → Add Category
2. **Set Status**: Toggle active/inactive status
3. **Edit/Delete**: Manage existing categories (cannot delete if articles exist)

#### Managing Enquiries
1. **View All**: See all submitted enquiries with status
2. **Update Status**: Change status to Pending/In Progress/Resolved
3. **Delete**: Remove unwanted enquiries

### For Students

#### Reading News
1. **Browse Articles**: View all published news on dashboard
2. **Search**: Use search bar to find specific articles
3. **Filter**: Filter by category using dropdown
4. **Read Full Article**: Click "Read More" to view complete content

#### Submitting Enquiries
1. **Access Form**: Navigate to "Submit Enquiry"
2. **Fill Details**: Provide name, email, subject, and message
3. **Submit**: Enquiry is sent to staff for review
4. **Track Status**: View status updates in "My Enquiries"

## 🔌 API Endpoints

### News Management
```
GET    /news                    - List all news articles
GET    /news/{id}              - Show specific article
POST   /news                   - Create new article (staff only)
PUT    /news/{id}              - Update article (staff only)
DELETE /news/{id}              - Delete article (staff only)
PATCH  /news/{id}/toggle-publish - Toggle publish status (staff only)
```

### Category Management
```
GET    /categories             - List all categories
POST   /categories             - Create category (staff only)
PUT    /categories/{id}        - Update category (staff only)
DELETE /categories/{id}        - Delete category (staff only)
PATCH  /categories/{id}/toggle-status - Toggle active status (staff only)
```

### Enquiry Management
```
GET    /enquiries              - List all enquiries (staff only)
GET    /enquiries/{id}         - Show specific enquiry
POST   /enquiries              - Submit new enquiry (public)
PATCH  /enquiries/{id}/status  - Update enquiry status (staff only)
DELETE /enquiries/{id}         - Delete enquiry (staff only)
```

## 🗄️ Database Schema

### Users Table
```sql
- id (Primary Key)
- name (VARCHAR)
- email (VARCHAR, Unique)
- password (VARCHAR)
- role (ENUM: 'staff', 'student')
- student_id (VARCHAR, Nullable)
- department (VARCHAR, Nullable)
- email_verified_at (TIMESTAMP, Nullable)
- remember_token (VARCHAR, Nullable)
- created_at, updated_at (TIMESTAMP)
```

### News Table
```sql
- id (Primary Key)
- title (VARCHAR)
- content (TEXT)
- image (VARCHAR, Nullable)
- category_id (Foreign Key)
- user_id (Foreign Key)
- is_published (BOOLEAN, Default: false)
- published_at (TIMESTAMP, Nullable)
- views (INTEGER, Default: 0)
- created_at, updated_at (TIMESTAMP)
```

### Categories Table
```sql
- id (Primary Key)
- name (VARCHAR)
- slug (VARCHAR)
- description (TEXT, Nullable)
- is_active (BOOLEAN, Default: true)
- created_at, updated_at (TIMESTAMP)
```

### Enquiries Table
```sql
- id (Primary Key)
- name (VARCHAR)
- email (VARCHAR)
- subject (VARCHAR)
- message (TEXT)
- user_id (Foreign Key, Nullable)
- status (ENUM: 'pending', 'in_progress', 'resolved', Default: 'pending')
- created_at, updated_at (TIMESTAMP)
```

## 📁 File Structure

```
students-news-portal/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Auth/           # Authentication controllers
│   │   │   ├── NewsController.php
│   │   │   ├── CategoryController.php
│   │   │   ├── EnquiryController.php
│   │   │   └── DashboardController.php
│   │   ├── Middleware/
│   │   │   ├── StaffMiddleware.php
│   │   │   └── StudentMiddleware.php
│   │   └── Requests/           # Form request validation
│   ├── Models/
│   │   ├── User.php
│   │   ├── News.php
│   │   ├── Category.php
│   │   └── Enquiry.php
│   └── Providers/
├── config/                     # Configuration files
├── database/
│   ├── migrations/            # Database migrations
│   ├── seeders/              # Database seeders
│   └── factories/            # Model factories
├── public/                    # Public assets
│   ├── build/                # Compiled assets
│   └── storage/              # Storage symlink
├── resources/
│   ├── views/                # Blade templates
│   │   ├── auth/            # Authentication views
│   │   ├── news/            # News management views
│   │   ├── categories/      # Category management views
│   │   ├── enquiries/       # Enquiry management views
│   │   ├── dashboard/       # Dashboard views
│   │   └── layouts/         # Layout templates
│   ├── css/                 # Stylesheets
│   └── js/                  # JavaScript files
├── routes/
│   ├── web.php              # Web routes
│   └── auth.php             # Authentication routes
└── storage/
    └── app/
        └── public/
            └── news/         # Uploaded news images
```

## 🚀 Deployment

### Production Deployment Steps

1. **Server Requirements**
   - PHP 8.1+
   - MySQL 5.7+
   - Apache/Nginx
   - Composer

2. **Upload Files**
   ```bash
   # Upload project files to server
   # Ensure proper file permissions
   chmod -R 755 storage/
   chmod -R 755 bootstrap/cache/
   ```

3. **Install Dependencies**
   ```bash
   composer install --optimize-autoloader --no-dev
   npm install && npm run build
   ```

4. **Environment Setup**
   ```bash
   cp .env.example .env
   # Edit .env with production settings
   php artisan key:generate
   ```

5. **Database Setup**
   ```bash
   php artisan migrate --force
   php artisan db:seed --force
   ```

6. **Storage Setup**
   ```bash
   php artisan storage:link
   # If exec() is disabled, manually create symlink:
   ln -s ../storage/app/public public/storage
   ```

7. **Cache Configuration**
   ```bash
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```

### Web Server Configuration

#### Apache (.htaccess)
```apache
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteRule ^(.*)$ public/$1 [L]
</IfModule>
```

#### Nginx
```nginx
server {
    listen 80;
    server_name your-domain.com;
    root /path/to/your/project/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.1-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

## 🔧 Troubleshooting

### Common Issues

#### Images Not Showing
```bash
# Create storage symlink
php artisan storage:link

# If exec() is disabled, manually create:
ln -s ../storage/app/public public/storage

# Check permissions
chmod -R 755 storage/app/public/
```

#### Database Connection Issues
```bash
# Clear config cache
php artisan config:cache

# Check database credentials in .env
# Ensure database exists and user has permissions
```

#### Asset Loading Issues
```bash
# Rebuild assets
npm run build

# Clear cache
php artisan cache:clear
php artisan view:clear
```

#### Permission Denied Errors
```bash
# Set proper permissions
chmod -R 755 storage/
chmod -R 755 bootstrap/cache/
chown -R www-data:www-data storage/
chown -R www-data:www-data bootstrap/cache/
```

### Performance Optimization

1. **Enable OPcache**
2. **Use Redis for caching**
3. **Optimize database queries**
4. **Enable gzip compression**
5. **Use CDN for static assets**

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

### Development Guidelines
- Follow PSR-12 coding standards
- Write tests for new features
- Update documentation for API changes
- Use meaningful commit messages

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 📞 Support

For support and questions:
- Create an issue on GitHub
- Contact: [your-email@example.com]
- Documentation: [link-to-docs]

---

**Built with ❤️ using Laravel and Tailwind CSS**
