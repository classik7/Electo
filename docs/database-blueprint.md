# ELECTO DATABASE BLUEPRINT

Version: 1.0

---

# DATABASE OVERVIEW

Electo is a multi-tenant electronic voting platform.

One Electo installation can serve thousands of organizations.

Each organization manages its own elections independently.

---

# MODULE 1

## USERS

Purpose

Stores every authenticated user on the platform.

Examples

- Super Admin
- Platform Administrator
- Organization Owner
- Election Manager
- Observer
- Voter

Fields

- id
- name
- email
- phone
- password
- avatar
- email_verified_at
- last_login_at
- status
- remember_token
- timestamps

Relationships

- A User can own many Organizations.
- A User can belong to many Organizations.
- A User can cast many Votes.

---

# MODULE 2

## ORGANIZATIONS

Purpose

Represents every school, university, church, company, association, union, NGO or government institution using Electo.

Fields

- id
- owner_id
- name
- slug
- logo
- email
- phone
- website
- country
- state
- city
- address
- description
- verification_status
- subscription_plan
- status
- timestamps

Relationships

- Organization belongs to one Owner.
- Organization has many Members.
- Organization has many Elections.

---

# MODULE 3

## ORGANIZATION MEMBERS

Purpose

Connects users to organizations.

Fields

- id
- organization_id
- user_id
- role
- joined_at
- status
- timestamps

Relationships

- Member belongs to User.
- Member belongs to Organization.

---

# UPCOMING MODULES

- Elections
- Election Positions
- Candidates
- Ballots
- Votes
- Audit Logs
- Notifications
- API Tokens
- Subscriptions
- Billing