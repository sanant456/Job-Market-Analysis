# Required Libraries
import pandas as pd
import numpy as np
import matplotlib.pyplot as plt
import seaborn as sns
from collections import Counter
from sklearn.feature_extraction.text import CountVectorizer

# Simulated job market data
data = {
    'Job Title': ['Data Analyst', 'Software Engineer', 'Data Scientist', 'Software Engineer', 'Business Analyst'],
    'Company': ['ABC Corp', 'XYZ Ltd', 'Data Inc', 'TechSoft', 'BizGroup'],
    'Location': ['Bangalore', 'Pune', 'Bangalore', 'Hyderabad', 'Pune'],
    'Skills_Required': [
        'Python, SQL, Excel',
        'Java, Spring, SQL',
        'Python, ML, SQL',
        'Java, Microservices, AWS',
        'Excel, SQL, Power BI'
    ],
    'Salary': [600000, 800000, 1200000, 900000, 700000]
}

# Simulated candidate skill data
candidates = {
    'Candidate': ['Alice', 'Bob', 'Charlie', 'Diana'],
    'Skills': ['Python, SQL', 'Java, Spring', 'Python, Excel', 'Excel, Power BI']
}

# Convert to DataFrames
df_jobs = pd.DataFrame(data)
df_candidates = pd.DataFrame(candidates)

# Preview
print("Jobs Dataset:\n", df_jobs, "\n")
print("Candidates Dataset:\n", df_candidates, "\n")

# ----------------------------
# Job Market Analysis Section
# ----------------------------

# Most in-demand job roles
print("\nTop Job Titles:\n", df_jobs['Job Title'].value_counts())

# Top hiring locations
print("\nTop Locations:\n", df_jobs['Location'].value_counts())

# Most in-demand skills
all_skills = df_jobs['Skills_Required'].str.split(', ').explode()
top_skills = all_skills.value_counts()
print("\nMost In-Demand Skills:\n", top_skills)

# Average salary by role
avg_salary = df_jobs.groupby('Job Title')['Salary'].mean()
print("\nAverage Salary by Job Title:\n", avg_salary)

# ----------------------------
# Skills Gap Finder Section
# ----------------------------

# Flatten candidate skills
candidate_skills = df_candidates['Skills'].str.split(', ').explode()
candidate_skill_counts = candidate_skills.value_counts()

# Skill Gap = Job Market Skills - Candidate Skills
job_skill_set = set(all_skills)
candidate_skill_set = set(candidate_skills)
skills_gap = job_skill_set - candidate_skill_set

print("\nSkills Gap (Market needs but candidates lack):\n", skills_gap)

# ----------------------------
# Visualization Section
# ----------------------------

# Skill demand chart
plt.figure(figsize=(8, 4))
top_skills.plot(kind='bar', color='skyblue')
plt.title('Most In-Demand Skills')
plt.ylabel('Frequency')
plt.xticks(rotation=45)
plt.tight_layout()
plt.show()

# Salary comparison
plt.figure(figsize=(6, 4))
avg_salary.plot(kind='bar', color='salmon')
plt.title('Average Salary by Job Title')
plt.ylabel('Salary (INR)')
plt.xticks(rotation=45)
plt.tight_layout()
plt.show()
