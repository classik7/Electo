# Electo

Electo is a full-stack election management and digital voting platform built with Laravel 12 and PHP. It provides organizations with tools to create and manage elections, register voters and candidates, conduct voting workflows, process results, and issue verifiable certificates.

The application also provides a versioned REST API for mobile clients and is deployed on AWS EC2.

## Live Demo

**Web Application:** http://13.60.29.19

> The live deployment is available as a project demonstration.

## Core Features

### Election Management

- Create and manage organizations
- Create and schedule elections
- Configure election positions
- Manage candidates
- Manage voters
- Assign voters to elections
- Bulk candidate import
- Bulk voter import
- Election type management

### Voter Workflow

- Voter authentication
- Election selection
- Voter accreditation
- Voting sessions
- Ballot management
- Vote review before submission
- Vote submission
- Voting completion workflow
- Voting history

### Results & Certificates

- Election results processing
- Candidate result views
- Certificate issuance
- Certificate display
- Certificate verification using a verification code

### Security

- Laravel authentication
- Role-based access control
- Permission management
- Two-factor authentication (2FA)
- Recovery codes
- Passkey authentication
- Laravel Sanctum API authentication
- Protected authenticated routes
- Protected mobile API endpoints

### Notifications

- In-app notifications
- Unread notification count
- Mark individual notifications as read
- Mark all notifications as read

## REST API

Electo includes a versioned REST API under:

`/api/v1`

The API provides functionality for:

- Authentication
- Current user information
- Organizations
- Elections
- Election details
- Election results
- Voting sessions
- Vote review and submission
- Voting history
- Notifications
- Administrative election management

Protected API routes use **Laravel Sanctum** authentication.

## Technology Stack

### Backend

- PHP 8.2+
- Laravel 12
- Laravel Blade
- Laravel Sanctum
- Spatie Laravel Permission

### Frontend

- Blade
- Tailwind CSS
- Alpine.js
- Axios
- Vite

### Database

- MySQL
- Laravel Eloquent ORM
- Laravel migrations

### Security & Authentication

- Laravel Authentication
- Laravel Sanctum
- Two-Factor Authentication
- Google Authenticator-compatible 2FA
- Passkeys / WebAuthn
- Role-Based Access Control

### Supporting Packages

- Maatwebsite Excel
- Simple QR Code
- Blade Heroicons

### Deployment

- AWS EC2
- Ubuntu
- Nginx
- PHP-FPM
- MySQL
- Composer
- Node.js
- npm
- Vite

## Architecture

Electo follows a Laravel MVC architecture with dedicated application areas for:

- Organizations
- Elections
- Candidates
- Voters
- Accreditation
- Voting
- Results
- Certificates
- Notifications
- Settings
- API authentication

The application separates browser-based workflows from its versioned REST API for mobile clients.

## Engineering Highlights

This project demonstrates practical experience with:

- Full-stack Laravel application development
- PHP backend development
- REST API development
- Authentication and authorization
- Role-based access control
- Two-factor authentication
- Passkey authentication
- Election and voting business logic
- Database-driven workflows
- Bulk data import
- Result processing
- Certificate generation and verification
- Mobile API integration
- AWS server deployment
- Nginx configuration
- PHP-FPM configuration
- MySQL database management
- Production environment configuration

## Local Development

### Requirements

- PHP 8.2+
- Composer
- MySQL
- Node.js
- npm

### Installation

Clone the repository:

```bash
git clone https://github.com/classik7/Electo.git
cd Electo
