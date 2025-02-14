# Resume Management System

## Overview

This Resume Management System is a robust application built using the PHP/Laravel framework alongside a MariaDB database. It is designed to efficiently manage candidate profiles and academic qualifications, providing functionalities for creating, deleting, and searching candidate records with ease.

## Key Features

- **Candidate Management:** Seamlessly add new candidates, remove existing ones, and search through candidate records based on the job they applied for.
- **Degree Management:** Add new degrees and ensure data integrity by preventing the deletion of degrees that are currently in use by any candidate.
- **Resume Uploads:** Candidates can upload their resumes exclusively in PDF format.
- **Data Integrity:** The system pre-seeds degrees such as High School, BSc, and MSc, and protects them from deletion if they are associated with any candidate profiles.
- **Filtering Capabilities:** Filter candidates based on the job roles they have applied to enhance user experience and system usability.

## Entities

### Candidate

- **First Name** (Mandatory)
- **Last Name** (Mandatory)
- **Email** (Validated format)
- **Mobile** (10-digit validation)
- **Degree** (Choice from an existing list)
- **Resume** (PDF format)
- **Job Applied For** (Selection required from predefined roles)
- **Application Date** (Automatically set to current date, non-editable)

### Degree

- **ID** (Primary key, auto-incremented)
- **Degree Title** (Mandatory and unique)


    
