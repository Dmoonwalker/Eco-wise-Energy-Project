EcoWise

[![Laravel](https://img.shields.io/badge/Laravel-8.x-red)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-%3E%3D%207.4-blue)](https://www.php.net/)

EcoWise is a Laravel-based dashboard designed for efficient management of devices within solar grids, 
focusing on clean energy utilization. It facilitates monitoring of energy status, location tracking, performance analysis,
and last seen updates for each device. With EcoWise, users can effectively oversee and manage their solar grid infrastructure, 
ensuring optimal performance and sustainability.

Table of Contents

- Installation and Dependencies
- Features
- Usage
- Contributing
- License

Installation and Dependencies

To set up EcoWise, ensure you have the following dependencies installed and configured:

1. Laravel Framework: EcoWise is built on the Laravel framework. Make sure you have Laravel installed on your system. You can install it via Composer using the following command:

composer global require laravel/installer

2. AWS SDK: EcoWise utilizes the AWS SDK for integrating with Amazon Web Services. Install the AWS SDK using Composer:

composer require aws/aws-sdk-php

3. Google Maps API Key: EcoWise requires a Google Maps API key for location tracking functionality. Obtain a Google Maps API key from the Google Cloud Console and configure it in your environment variables (.env file):

GOOGLE_MAPS_API_KEY=your_api_key_here

4. AWS Credentials: Provide your AWS credentials (Access Key ID and Secret Access Key) in the environment variables for authentication with AWS services:

AWS_ACCESS_KEY_ID=your_access_key_id
AWS_SECRET_ACCESS_KEY=your_secret_access_key

Once you have all the dependencies installed and configured, you can proceed with setting up the Laravel project and configuring EcoWise.

Features

- Dashboard Overview: Provides a comprehensive overview of the entire solar grid, including real-time energy production, performance metrics, and device statuses.
- Device Management: Enables users to register, monitor, and manage individual devices within the solar grid.
- Energy Status Monitoring: Offers detailed insights into the energy production of each device, such as current output, historical data, and trends over time.
- Location Tracking: Utilizes GPS or geolocation data to track the precise location of each device within the solar grid.
- Last Seen Updates: Provides real-time updates on when each device was last active or connected to the dashboard.
- Performance Analysis: Offers in-depth performance analysis tools, allowing users to assess the overall health and efficiency of the solar grid.
- Alerts and Notifications: Sends automatic alerts and notifications to users in the event of critical issues.
- User Management: Supports multiple user roles and permissions.
- Customizable Reporting: Generates customizable reports and analytics to track key performance indicators.

Usage

1. Setup Laravel Project: Clone the EcoWise repository and navigate to the project directory.
2. Environment Configuration: Copy the .env.example file to .env and fill in the necessary configuration values.
3. Generate Application Key: Run php artisan key:generate to generate a unique application key.
4. Serve Application: Serve the application using php artisan serve.

Contributing

Contributions are welcome! Please follow the guidelines mentioned in CONTRIBUTING.md.

License

This project is licensed under the MIT License.
