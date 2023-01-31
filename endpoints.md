# Endpoints

| Endpoint description | Method | Endpoint URI | Implementation |
|----------------------|--------|--------------|----------------|
| Get all accounts | GET | /api/accounts | |
| List all users in account | GET | /api/accounts/{account_id}/account_accesses | |
| Remove user from the account | DELETE | /api/accounts/{account_id}/account_accesses/{account_access_id} |
| Manage user or token permissions | PUT | /api/accounts/{account_id}/account_accesses/{account_access_id}/permissions/bulk | |
| Get resources | GET | /api/accounts/{account_id}/permissions/resources |
| Send email | POST | /api/send | |
| Receive events | POST | /user-provided-url | |
| Get all email campaigns for an account | GET | /api/accounts/{account_id}/email_campaigns | |
| Get a simple campaign record for an account | GET | /api/accounts/{account_id}/simple_email_campaigns/{campaign_id} | |
| Update a simple email campaign | PATCH | /api/accounts/{account_id}/simple_email_campaigns/{campaign_id} | |
| Send email message | POST | /api/send/{inbox_id} | |
| Create project | POST | /api/accounts/{account_id}/projects | |
| Get a list of projects | GET | /api/accounts/{account_id}/projects | |
| Get project by ID | GET | /api/accounts/{account_id}/projects/{project_id} | |
| Update project | PATCH | /api/accounts/{account_id}/projects/{project_id} | |
| Delete project | DELETE | /api/accounts/{account_id}/projects/{project_id} | |
| Create an inbox | POST | /api/accounts/{account_id}/projects/{project_id}/inboxes | |
| Get inbox attributes | GET | /api/accounts/{account_id}/inboxes/{inbox_id} | |
| Delete an inbox | DELETE | /api/accounts/{account_id}/inboxes/{inbox_id} | |
| Update an inbox | PATCH | /api/accounts/{account_id}/inboxes/{inbox_id} | |
| Clean inbox | PATCH | /api/accounts/{account_id}/inboxes/{inbox_id}/clean | |
| Mark as read | PATCH | /api/accounts/{account_id}/inboxes/{inbox_id}/all_read | |
| Reset credentials | PATCH | /api/accounts/{account_id}/inboxes/{inbox_id}/reset_credentials | |
| Enable email address | PATCH | /api/accounts/{account_id}/inboxes/{inbox_id}/toggle_email_username | |
| Reset email address | PATCH | /api/accounts/{account_id}/inboxes/{inbox_id}/reset_email_username | |
| Get a list of inboxes | GET | /api/accounts/{account_id}/inboxes | |
| Show email message | GET | /api/accounts/{account_id}/inboxes/{inbox_id}/messages/{message_id} | |
| Update message | PATCH | /api/accounts/{account_id}/inboxes/{inbox_id}/messages/{message_id} | |
| Delete message | DELETE | /api/accounts/{account_id}/inboxes/{inbox_id}/messages/{message_id} | |
| Get messages | GET | /api/accounts/{account_id}/inboxes/{inbox_id}/messages | |
| Forward message | POST | /api/accounts/{account_id}/inboxes/{inbox_id}/messages/{message_id}/forward | |
| Get message spam score | GET | /api/accounts/{account_id}/inboxes/{inbox_id}/messages/{message_id}/spam_report | |
| Get text message | GET | /api/accounts/{account_id}/inboxes/{inbox_id}/messages/{message_id}/body.txt | |
| Get raw message | GET | /api/accounts/{account_id}/inboxes/{inbox_id}/messages/{message_id}/body.raw | |
| Get message source | GET | /api/accounts/{account_id}/inboxes/{inbox_id}/messages/{message_id}/body.htmlsource | |
| Get HTML message | GET | /api/accounts/{account_id}/inboxes/{inbox_id}/messages/{message_id}/body.html | |
| Get message as .eml | GET | /api/accounts/{account_id}/inboxes/{inbox_id}/messages/{message_id}/body.eml | |
| Get attachments | GET | /api/accounts/{account_id}/inboxes/{inbox_id}/messages/{message_id}/attachments | |
| Get single attachment | GET | /api/accounts/{account_id}/inboxes/{inbox_id}/messages/{message_id}/attachments/{attachment_id} | |
