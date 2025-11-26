# Parse It – Resume Parsing & Matching Portal

**Parse It** is a full workflow management system built for resume parsing and resume-matching operations. It includes two separate dashboards — **Admin** and **Client** — allowing structured job creation, resume uploading, filtering, matching, status updates, and staff management.


---



## 🚀 Features Overview

### 🔹 Client Portal

Clients can:

- Create new jobs with fields:
  - Job Title  
  - Recruiter Name  
  - Company Name  
  - Required Services: **Parsing / Matching / Both**
  - Select parsing fields:
    - First Name  
    - Last Name  
    - Email  
    - Phone  
    - Date of Birth  
  - Add matching keywords (tag-based)

- Upload candidate resumes to each job  
- Edit job details and manage job information  
- Add staff to their portal (multi-user access)  
- View filtered results uploaded by admin:
  - **Matched Resumes**
  - **Unmatched Resumes**

Every newly created job starts with status: **Lodged**

---

### 🔹 Admin Portal

Admins can:

- View all jobs and all clients  
- Download resumes submitted by clients  
- Parse/match resumes manually or using third-party tools  
- Upload processed results under:
  - **Matched**
  - **Unmatched**
- Update job status:
  - **Active**
  - **Completed**
- Add new clients manually (with logo upload)  
- Edit client information  
- Add staff users with admin-panel access  
- View dashboard statistics:
  - New jobs today  
  - Jobs in last 7 days  
  - Jobs in last 30 days  
  - Total jobs  

Only **Admin** can create new client accounts.

---


## 🛠️ Technologies Used

- **Frontend:** HTML5, CSS3, JavaScript, jQuery  
- **Backend:** PHP (Procedural)  
- **Database:** MySQL  
- **Communication:** AJAX  
- **File Handling:** Resume uploads, matched/unmatched uploads  
- **Role-Based Access:** Admin, Client, Staff  

---

## 📦 How to Run Locally

### 1. Clone the Repository
```bash
git clone https://github.com/UsamaAmanat/Parse-It-Resume-Parsing-Matching-Portal.git
```
2. Import the Database
The SQL file is inside:

```bash
/database/
```
3. Update Database Credentials
Update these files:

```bash
/admin/dbcon.php
/dbcon.php
```
4. Start Local Server (XAMPP, WAMP, Laragon)
Place the project inside:

```bash
htdocs/parse-it/
```
5. Access the System
Client Portal:
http://localhost/parse-it/

Admin Portal:
http://localhost/parse-it/admin/

---

## 📸 Project Screenshot

![Project Screenshot](https://github.com/UsamaAmanat/Parse-It-Resume-Parsing-Matching-Portal/blob/main/project-screenshots/1.jpg)
![Project Screenshot](https://github.com/UsamaAmanat/Parse-It-Resume-Parsing-Matching-Portal/blob/main/project-screenshots/2.jpg)
![Project Screenshot](https://github.com/UsamaAmanat/Parse-It-Resume-Parsing-Matching-Portal/blob/main/project-screenshots/3.jpg)
![Project Screenshot](https://github.com/UsamaAmanat/Parse-It-Resume-Parsing-Matching-Portal/blob/main/project-screenshots/4.jpg)
![Project Screenshot](https://github.com/UsamaAmanat/Parse-It-Resume-Parsing-Matching-Portal/blob/main/project-screenshots/5.jpg)
![Project Screenshot](https://github.com/UsamaAmanat/Parse-It-Resume-Parsing-Matching-Portal/blob/main/project-screenshots/6.jpg)
![Project Screenshot](https://github.com/UsamaAmanat/Parse-It-Resume-Parsing-Matching-Portal/blob/main/project-screenshots/7.jpg)
![Project Screenshot](https://github.com/UsamaAmanat/Parse-It-Resume-Parsing-Matching-Portal/blob/main/project-screenshots/8.jpg)
![Project Screenshot](https://github.com/UsamaAmanat/Parse-It-Resume-Parsing-Matching-Portal/blob/main/project-screenshots/9.jpg)
