<?php
session_start();
include 'db_connect.php'; // Ensure this file establishes the $pdo connection

// Function to correct common misspellings
function correctSpelling($message) {
    $corrections = [
        'admission' => 'admission',
        'admisison' => 'admission',
        'courses' => 'courses',
        'corse' => 'course',
        'university' => 'university',
        'universty' => 'university',
        // Add more common misspellings as needed...
    ];

    $message = strtolower($message);
    foreach ($corrections as $misspelled => $correct) {
        $message = str_replace($misspelled, $correct, $message);
    }

    return $message;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get user input
    $userMessage = trim($_POST['message']);
    $username = $_SESSION['username'];

    // Correct spelling in the user message
    $userMessage = correctSpelling($userMessage);

    // Chatbot response logic
    $botResponse = '';

    switch ($userMessage) {
        // Greetings
        case 'hi':
            $botResponse = 'Hello, my name is MKU Enquiry chatbot. How may I help you?';
            break;
        case 'hello':
            $botResponse = 'Hi there! How can I assist you today?';
            break;
        case 'good morning':
            $botResponse = 'Good morning too! And how are you this fine day.';
            break;
        case 'good afternoon':
            $botResponse = 'Good afternoon! How can I assist you this fine day?';
            break;
        case 'good evening':
            $botResponse = 'Good evening! What can I help you with tonight?';
            break;
        case 'how are you?':
            $botResponse = 'I’m just a chatbot, but I’m here to help you! How can I assist you today?';
            break;
        case 'thank you':
            $botResponse = 'You’re welcome! If you have any more questions, feel free to ask.';
            break;
        case 'have a lovely day':
            $botResponse = 'Thank you! I hope you have a lovely day as well.';
            break;
    
        // IT student queries
        case 'what courses are available for IT students?':
            $botResponse = 'MKU offers courses like Networking, Cyber Security, Web Development, and Database Management for IT students.';
            break;
        case 'what programming languages are taught in the IT program?':
            $botResponse = 'We teach languages such as Python, Java, C++, and PHP.';
            break;
        case 'do you offer certifications in cyber security?':
            $botResponse = 'Yes, we offer certification courses in Cyber Security.';
            break;
        case 'are there online IT courses available?':
            $botResponse = 'Yes, we offer online IT courses, including Web Development and Programming.';
            break;
        case 'what is the duration of the IT degree program?':
            $botResponse = 'The IT degree program typically lasts 4 years.';
            break;
        case 'is there a specialization in artificial intelligence for IT students?':
            $botResponse = 'Yes, we offer AI as a specialization for final-year IT students.';
            break;
        case 'how can I access the computer labs?':
            $botResponse = 'You can access the computer labs using your student ID during designated lab hours.';
            break;
        case 'what projects do IT students work on?':
            $botResponse = 'IT students work on projects related to Web Development, Networking, and Software Development.';
            break;
        case 'are there internship opportunities for IT students?':
            $botResponse = 'Yes, we have partnerships with tech companies that offer internships to IT students.';
            break;
        case 'how can I apply for an internship?':
            $botResponse = 'You can apply for an internship through the Career Services department or by contacting your course advisor.';
            break;
        case 'what is the grading system for IT courses?':
            $botResponse = 'Grades are based on assignments, projects, and final exams. The passing mark is 50%.';
            break;
        case 'are there coding boot camps available?':
            $botResponse = 'Yes, MKU offers coding boot camps in Web Development and Software Engineering during the holidays.';
            break;
        case 'what hardware specifications are recommended for IT students?':
            $botResponse = 'We recommend a laptop with at least 8GB of RAM, 256GB SSD, and an i5 processor or better.';
            break;
        case 'are there scholarships available for IT students?':
            $botResponse = 'Yes, scholarships are available for top-performing students and those with financial needs.';
            break;
        case 'can IT students access free software licenses?':
            $botResponse = 'Yes, students have access to free software licenses for tools like Microsoft Office, GitHub, and JetBrains IDEs.';
            break;
    
        // General student queries
        case 'what are the library hours?':
            $botResponse = 'The library is open from 8:00 AM to 8:00 PM on weekdays and from 9:00 AM to 5:00 PM on weekends.';
            break;

        case 'which requirements are needed to join mku':
            $botResponse = 'You need atleast a C+ and above to do a Degree and atleast a D+ and above to do certificate and diploma courses';
            break;
              
        case 'how do I register for courses?':
            $botResponse = 'You can register for courses through the student portal during the registration period.';
            break;
        case 'how do I reset my student portal password?':
            $botResponse = 'To reset your password, click on the "Forgot Password" link on the student portal login page.';
            break;
        case 'what is the deadline for paying fees?':
            $botResponse = 'The fee payment deadline is usually two weeks before the semester begins. Please check the university calendar.';
            break;
        case 'where can I find the academic calendar?':
            $botResponse = 'The academic calendar is available on the university website under the “Student Resources” section.';
            break;
        case 'how do I join a club or society?':
            $botResponse = 'To join a club or society, contact the club leader or sign up during the annual clubs’ day event.';
            break;
        case 'what is the dress code on campus?':
            $botResponse = 'The university encourages decent dressing, and official wear is required during presentations and exams.';
            break;
        case 'how can I access my exam timetable?':
            $botResponse = 'Your exam timetable is available on the student portal.';
            break;
        case 'what should I do if I miss an exam?':
            $botResponse = 'If you miss an exam, contact your department head immediately to arrange for a special exam.';
            break;
        case 'where is the admissions office?':
            $botResponse = 'The admissions office is located on the ground floor of the administration building.';
            break;
        case 'what is the procedure for deferring a semester?':
            $botResponse = 'To defer a semester, submit a request through the student portal or visit the registrar’s office.';
            break;
        case 'where can I find past exam papers?':
            $botResponse = 'Past exam papers are available in the library or on the student portal under “Resources.”';
            break;
        case 'what is the process for applying for a student ID?':
            $botResponse = 'You can apply for your student ID online via the student portal. IDs are issued during the first semester.';
            break;
        case 'where can I get help with academic advising?':
            $botResponse = 'You can contact your department advisor or visit the academic office for help with course selection.';
            break;
        case 'what is the wifi password on campus?':
            $botResponse = 'The campus wifi password is updated every semester. Check with IT services for the latest password.';
            break;
        case 'how do I check my exam results?':
            $botResponse = 'You can check your exam results through the student portal once they are officially released.';
            break;
        case 'what facilities are available for sports?':
            $botResponse = 'MKU has facilities for football, basketball, volleyball, and athletics, among other sports.';
            break;
        case 'how do I apply for a room in the hostel?':
            $botResponse = 'Hostel applications are done online through the student portal. Rooms are allocated on a first-come, first-served basis.';
            break;
        case 'what are the dining hall hours?':
            $botResponse = 'The dining hall is open from 6:30 AM to 8:30 PM daily.';
            break;
        case 'where can I find my class schedule?':
            $botResponse = 'Your class schedule is available on the student portal.';
            break;
        case 'how do I register for graduation?':
            $botResponse = 'You can register for graduation through the student portal when the graduation application period opens.';
            break;
        case 'what is the policy on attendance?':
            $botResponse = 'You must attend at least 75% of your classes to be eligible for exams.';
            break;
        case 'are there any student exchange programs?':
            $botResponse = 'Yes, we have student exchange programs with partner universities in Europe and Asia.';
            break;
        case 'where can I get help with mental health?':
            $botResponse = 'The university has a counseling center located in the Student Welfare office.';
            break;
        case 'how do I apply for financial aid?':
            $botResponse = 'You can apply for financial aid through the Financial Aid Office or by visiting the university website.';
            break;
        case 'what happens if I fail a course?':
            $botResponse = 'If you fail a course, you can retake it during the next available semester.';
            break;
        case 'can I get a refund if I drop a course?':
            $botResponse = 'Yes, but only if you drop the course within the refund deadline, as stated in the academic calendar.';
            break;
    
        // If none of the predefined responses match
        default:
            $botResponse = 'Sorry, I don’t have an answer to that. Please contact the administration for more info.';
            break;
    }
    


    // Save the query and response to the database
    try {
        $stmt = $pdo->prepare("INSERT INTO query_history (username, query, response, date) VALUES (?, ?, ?, NOW())");
        $stmt->execute([$username, $userMessage, $botResponse]);

        // Check if bot response is a default "unanswered" message
        if ($botResponse == 'Sorry, I don’t have an answer to that. Please contact the administration for more info.') {
            // Save unanswered query for later review (you can skip this if you just need to track unanswered)
            // Optionally, you could mark the query as unanswered in the `query_history` table itself
        }

    } catch (PDOException $e) {
        echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
        exit();
    }

    // Return the bot response as JSON
    echo json_encode(['response' => $botResponse]);
    exit();
}
?>
