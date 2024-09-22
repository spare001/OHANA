-- Create the database
CREATE DATABASE IF NOT EXISTS ohana;
USE ohana;


CREATE TABLE IF NOT EXISTS bookings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    prefix VARCHAR(10),
    first_name VARCHAR(50),
    middle_name VARCHAR(50),
    last_name VARCHAR(50),
    mobile_phone VARCHAR(15),
    email_address VARCHAR(100),
    address1 VARCHAR(255),
    city VARCHAR(100),
    postal_code VARCHAR(10),
    checkin_date DATE,
    checkout_date DATE,
    num_small_rooms INT,
    num_big_rooms INT,
    payment_screenshot VARCHAR(255),
    time_selection VARCHAR(20),
    total_price DECIMAL(10, 2),
    downpayment_price DECIMAL(10, 2),
    multiple_days_total_price DECIMAL(10, 2),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


-- Create the users table for login functionality
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE,
    password VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert default admin user (if needed, adjust username and password)
INSERT INTO users (username, password) VALUES
('admin', PASSWORD('admin123'));

-- Add any reserved dates to bookings table
-- Example of reserved dates (can be removed or adjusted as needed)
INSERT INTO bookings (checkin_date, checkout_date, num_small_rooms, num_big_rooms, time_selection, total_price, downpayment_price) VALUES
('2024-10-01', '2024-10-02', 1, 0, '12:00:00', 5000.00, 1000.00),
('2024-10-05', '2024-10-07', 0, 1, '15:00:00', 7000.00, 1500.00);

-- Create the dashboard table (if needed, add extra statistics or data)
CREATE TABLE IF NOT EXISTS dashboard_stats (
    id INT AUTO_INCREMENT PRIMARY KEY,
    total_reservations INT,
    total_income DECIMAL(10, 2),
    avg_stay_duration DECIMAL(5, 2),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert default dashboard stats (optional, update this dynamically based on application data)
INSERT INTO dashboard_stats (total_reservations, total_income, avg_stay_duration) VALUES
(10, 50000.00, 2.5);