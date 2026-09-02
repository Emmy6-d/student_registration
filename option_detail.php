<?php

$option = $_GET['option'] ?? 'admissions';

$optionData = [
    'admissions' => [
        'title' => 'Admissions',
        'summary' => 'Manage student applications, supporting documents, and admission decisions from a single intake workflow.',
        'topics' => [
            'Application Intake' => 'Review incoming forms, confirm eligibility, and assign a student status for processing.',
            'Document Verification' => 'Check academic records, ID proof, and transfer documents before final approval.',
            'Enrollment Approval' => 'Approve or decline applicants and notify parents or guardians with clear next steps.'
        ]
    ],
    'student-records' => [
        'title' => 'Student Records',
        'summary' => 'Maintain a reliable record of each learner’s profile, academic history, and contact information.',
        'topics' => [
            'Profile Management' => 'Update personal information, emergency contacts, and student identifiers without duplication.',
            'Academic History' => 'Store previous schools, assessment records, and academic milestones for reference.',
            'Data Security' => 'Protect sensitive details through controlled access and regular verification routines.'
        ]
    ],
    'attendance' => [
        'title' => 'Attendance',
        'summary' => 'Track school presence, missing learners, and participation trends across the term.',
        'topics' => [
            'Daily Check-In' => 'Record present, absent, and late arrivals as soon as students arrive at school.',
            'Trends and Alerts' => 'Flag repeated absences and identify students who may need follow-up support.',
            'Parent Communication' => 'Share attendance updates with families to encourage prompt and consistent school attendance.'
        ]
    ],
    'class-schedule' => [
        'title' => 'Class Schedule',
        'summary' => 'Plan subject timetables, room assignments, and class transitions smoothly across the school day.',
        'topics' => [
            'Timetable Design' => 'Structure lesson blocks across subjects, grades, and student groups efficiently.',
            'Room Allocation' => 'Assign classrooms based on capacity, subject needs, and teacher availability.',
            'Schedule Updates' => 'Adjust for events, exams, or emergencies while keeping changes visible to all staff.'
        ]
    ],
    'exams' => [
        'title' => 'Exams',
        'summary' => 'Coordinate exam periods, grading systems, and result publication with transparency and consistency.',
        'topics' => [
            'Exam Planning' => 'Set dates, venues, and instructions for internal and external assessments.',
            'Result Recording' => 'Store marks, compute scores, and compare performance to grade-level expectations.',
            'Progress Reviews' => 'Identify learning gaps and recommend support for students who need additional attention.'
        ]
    ],
    'assignments' => [
        'title' => 'Assignments',
        'summary' => 'Distribute class tasks, monitor work completion, and evaluate academic progress regularly.',
        'topics' => [
            'Task Creation' => 'Define assignments with clear instructions, deadlines, and success criteria.',
            'Submission Tracking' => 'Collect work submissions and flag late or missing tasks for review.',
            'Feedback and Grading' => 'Give constructive comments and grade submissions consistently across learners.'
        ]
    ],
    'library' => [
        'title' => 'Library',
        'summary' => 'Organize book circulation, reading resources, and supporting literacy programs for students.',
        'topics' => [
            'Catalog Management' => 'Track titles, categories, and availability for convenient student access.',
            'Borrowing Process' => 'Monitor checkouts, returns, and due dates for every library item.',
            'Reading Programs' => 'Support literacy initiatives through reading lists and student recommendations.'
        ]
    ],
    'sports' => [
        'title' => 'Sports',
        'summary' => 'Support athletic development with training plans, team management, and event coordination.',
        'topics' => [
            'Team Selection' => 'Create balanced teams and monitor participation across sporting activities.',
            'Practice Scheduling' => 'Set training times, facilities, and coaching assignments for each sport.',
            'Competitions' => 'Prepare event rosters and track results for school competitions and matches.'
        ]
    ],
    'clubs' => [
        'title' => 'Clubs',
        'summary' => 'Encourage student engagement through extracurricular activities and club participation.',
        'topics' => [
            'Membership Lists' => 'Track student interest, club enrollment, and active participation levels.',
            'Meeting Coordination' => 'Schedule club sessions and ensure leadership roles are assigned clearly.',
            'Event Support' => 'Prepare club activities and showcase student talents through coordinated programs.'
        ]
    ],
    'transport' => [
        'title' => 'Transport',
        'summary' => 'Manage routes, pickup times, and transportation assignments for safe daily travel.',
        'topics' => [
            'Route Planning' => 'Map commuting patterns and assign vehicles to areas with consistent demand.',
            'Student Pickup Lists' => 'Track who is traveling on each bus or shuttle route each day.',
            'Safety Checks' => 'Monitor boarding procedures and maintain a clear transport communication channel.'
        ]
    ],
    'health' => [
        'title' => 'Health',
        'summary' => 'Support student well-being with health services, wellness records, and follow-up support.',
        'topics' => [
            'Medical Records' => 'Keep annual health forms, allergies, and treatment notes in one secure place.',
            'Wellness Monitoring' => 'Track health check-ups and identify students who may need intervention.',
            'Emergency Response' => 'Coordinate first-aid support and communication with families when needed.'
        ]
    ],
    'career-guidance' => [
        'title' => 'Career Guidance',
        'summary' => 'Help students explore future pathways and make informed decisions for higher education or employment.',
        'topics' => [
            'Career Exploration' => 'Introduce students to careers based on interests, skills, and academic strengths.',
            'Counseling Sessions' => 'Organize guidance meetings and goal-setting conversations with advisors.',
            'Pathway Planning' => 'Support applications, training opportunities, and academic preparation for future success.'
        ]
    ],
    'scholarships' => [
        'title' => 'Scholarships',
        'summary' => 'Identify funding opportunities and guide students through the application and selection process.',
        'topics' => [
            'Funding Opportunities' => 'List scholarships, eligibility rules, and application deadlines in one place.',
            'Application Support' => 'Review student submissions and help prepare documents for selection.',
            'Award Tracking' => 'Monitor winners, disbursement status, and renewal conditions for each scholarship.'
        ]
    ],
    'events' => [
        'title' => 'Events',
        'summary' => 'Coordinate school events, communication, and activity participation for the full community.',
        'topics' => [
            'Event Planning' => 'Schedule academic, cultural, and social events with staff responsibilities and timelines.',
            'Public Communication' => 'Share event information with students, parents, and teachers through clear messaging.',
            'Participation Tracking' => 'Record attendance and engagement to improve future event planning.'
        ]
    ],
    'parent-portal' => [
        'title' => 'Parent Portal',
        'summary' => 'Keep families informed with important updates, progress reports, and daily school communication.',
        'topics' => [
            'Progress Updates' => 'Share attendance, marks, and performance summaries with parents and guardians.',
            'Notices and Announcements' => 'Distribute school-wide updates, notifications, and upcoming activity reminders.',
            'Family Communication' => 'Facilitate direct yet organized communication between home and school.'
        ]
    ],
    'fees-billing' => [
        'title' => 'Fees & Billing',
        'summary' => 'Manage tuition, due dates, payment records, and financial reporting in a transparent system.',
        'topics' => [
            'Fee Collection' => 'Track school fees, monthly dues, and payments received from families.',
            'Billing Reports' => 'Produce summaries of balances, outstanding amounts, and payment deadlines.',
            'Payment Follow-Up' => 'Notify families of overdue payments and ensure financial records remain accurate.'
        ]
    ]
];

$current = $optionData[$option] ?? $optionData['admissions'];

$topics = $current['topics'];
$keys = array_keys($topics);
$activeTopic = $_GET['topic'] ?? $keys[0];

if (!isset($topics[$activeTopic])) {
    $activeTopic = $keys[0];
}

$sidebarOptions = [
    'admissions' => 'Admissions',
    'student-records' => 'Student Records',
    'attendance' => 'Attendance',
    'class-schedule' => 'Class Schedule',
    'exams' => 'Exams',
    'assignments' => 'Assignments',
    'library' => 'Library',
    'sports' => 'Sports',
    'clubs' => 'Clubs',
    'transport' => 'Transport',
    'health' => 'Health',
    'career-guidance' => 'Career Guidance',
    'scholarships' => 'Scholarships',
    'events' => 'Events',
    'parent-portal' => 'Parent Portal',
    'fees-billing' => 'Fees & Billing',
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($current['title']) ?> | Bluebridge</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <header class="header">
        <div class="brand-wrap">
            <div class="brand-mark">B</div>
            <h1>Bluebridge Student Hub</h1>
        </div>
        <nav>
            <a href="index.php">Home</a>
            <a href="register.php">Register Student</a>
            <a href="list.php">View Students</a>
            <a href="options.php" class="active">Options</a>
        </nav>
    </header>

    <main class="card options-page">
        <div class="eyebrow">OPTION DETAIL</div>
        <div class="option-detail-layout">
            <aside class="option-sidebar">
                <h3>All Options</h3>
                <nav>
                    <?php foreach ($sidebarOptions as $slug => $label): ?>
                        <a href="option_detail.php?option=<?= urlencode($slug) ?>" class="<?= $option === $slug ? 'active' : '' ?>"><?= htmlspecialchars($label) ?></a>
                    <?php endforeach; ?>
                </nav>
            </aside>

            <div class="option-content">
                <div class="option-overview">
                    <div class="eyebrow">Option <?= array_search($option, array_keys($sidebarOptions)) + 1 ?></div>
                    <h3><?= htmlspecialchars($current['title']) ?></h3>
                    <p><?= htmlspecialchars($current['summary']) ?></p>
                </div>

                <div class="topic-nav">
                    <?php foreach ($topics as $topicTitle => $topicText): ?>
                        <a href="option_detail.php?option=<?= urlencode($option) ?>&topic=<?= urlencode($topicTitle) ?>" class="<?= $activeTopic === $topicTitle ? 'active' : '' ?>"><?= htmlspecialchars($topicTitle) ?></a>
                    <?php endforeach; ?>
                </div>

                <section class="topic-panel">
                    <h4><?= htmlspecialchars($activeTopic) ?></h4>
                    <p><?= htmlspecialchars($topics[$activeTopic]) ?></p>
                    <ul>
                        <li>Supports daily school operations and decision-making.</li>
                        <li>Improves consistency and accountability for staff and families.</li>
                        <li>Helps students get the right support at the right time.</li>
                    </ul>
                </section>

                <p style="margin-top: 18px;">
                    <a href="options.php" class="inline-link">&larr; Back to all options</a>
                </p>
            </div>
        </div>
    </main>
</div>
</body>
</html>
