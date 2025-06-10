_CREATE DATABASE job_finding;
USE job_finding;

CREATE TABLE employees (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100),
  email VARCHAR(100),
  mobile VARCHAR(15),
  skills TEXT,
  qualification VARCHAR(100),
  experience VARCHAR(10),
  resume VARCHAR(255)
);

CREATE TABLE companies (
  id INT AUTO_INCREMENT PRIMARY KEY,
  company_name VARCHAR(100),
  job_title VARCHAR(100),
  required_skills TEXT,
  required_qualification VARCHAR(100),
  experience_required VARCHAR(10),
  location VARCHAR(100),
  job_description VARCHAR(255),
  apply_link VARCHAR(255)
);
