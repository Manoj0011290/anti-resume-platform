# Project Overiew:
When we apply for a role in a company,there is a chance that we might get rejected because of lack of the keywords that a resume must contain,which is unfair and the company also might lose out on quality contenders for the job.So,in this anti resume method we will ask the candidates questions,auto generated by AI,which in turn suggest the applicant the jobs that would suit them more.

# Key Features and Functionalities:
In our application,there are two stakeholders.Employees and Applicants
Login can be done as a candidate or an employee.
The candidate can login in,search for jobs,take a test and apply for jobs and give the feedback
The employees can post jobs,see the statistics of a candidate and see the candidate insights.
# Setup Instructions:
The frontend part was written using html,css and javascript.
Php files were used so To get an understanding on how the backend works use phpmyadmin
-> firstly you need to install a local web server that is XAMPP 
-> using XAMPP control pannel start Apache and Mysql 
-> now as default Xampp will be in c folder open it you will get many files , go to htdocs, now create a new folder name it as resume_1(you can name anything) and upload all the files provided into that folder)
-> go to web browse and go to myphpadmin and create table 
     (for now only two tables are enough) that are as follows:
                         1) users that have column: id (Primary key)	, username, email, password, user_type	enum('candidate', 'company') and company_id
                         2) candidate details that have column: name, phone_no, email, state, image	(mediumblob), user_id(foregin key refers to id in users table)
-> now you have to go to browser and run the c_login.php (url: http://localhost/resume_1/c_login.php)
-> click on signup and then login and enjoy the webpage 
## website runs locally
     I made website locally  i did not host it online 

## Video Presentation 
    https://drive.google.com/file/d/1jQ20JRGtjBDpsYS1W_oQw_MPPIpTkl7u/view?usp=sharing  
