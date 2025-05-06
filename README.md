# Education Meeting Management System

This is a web-based application for managing educational meetings, users, and categories. The system includes features for user authentication, meeting management, and an admin dashboard for managing users, categories, and meetings.

## Features

### User Features
- User registration and login with secure password hashing.
- View upcoming meetings with filtering options (e.g., "Soon", "Important", "Attractive").
- View meeting details, including title, date, location, price, and category.

### Admin Features
- **User Management**:
  - Add, edit, and delete users.
  - Manage user roles and access control.
- **Meeting Management**:
  - Create, edit, and delete meetings.
  - Upload meeting images and manage categories.
  - Track meeting popularity with a views counter.
- **Category Management**:
  - Add, edit, and delete categories.
- Admin dashboard with data tables for efficient management.

### Additional Features
- Pagination for meetings to improve performance and user experience.
- Secure database interactions using `PDO`.
- Image upload functionality with validation.
- Responsive design using Bootstrap.
