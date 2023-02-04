# Endpoints

| Endpoint description | Domain |Method | Endpoint URI | PHP SDK | Implemented | Tested |
|----------------------|--------|-------|--------------|----------------|---------------|-------------|
| Get all accounts | Accounts | GET | /api/accounts | AccountService::getAccounts() | | |
| List all users in account | Accounts | GET | /api/accounts/{account_id}/account_accesses | AccountService::getUsersInAccount() | | |
| Remove user from the account | Accounts | DELETE | /api/accounts/{account_id}/account_accesses/{account_access_id} | AccountService::removeUserFromAccount() | | |
| Manage user or token permissions | Accounts | PUT | /api/accounts/{account_id}/account_accesses/{account_access_id}/permissions/bulk | AccountService::managePermissions() | | |
| Get resources | Accounts | GET | /api/accounts/{account_id}/permissions/resources | AccountService::getResources() | | |
| Send email | Emails | POST | /api/send | | | |
| Receive events | Webhooks | POST | /user-provided-url | |
| Get all email campaigns for an account | Campaigns | GET | /api/accounts/{account_id}/email_campaigns | |
| Get a simple campaign record for an account | Campaigns | GET | /api/accounts/{account_id}/simple_email_campaigns/{campaign_id} | |
| Update a simple email campaign | Campaigns | PATCH | /api/accounts/{account_id}/simple_email_campaigns/{campaign_id} | |
| Send email message | Emails |POST | /api/send/{inbox_id} | |
| Create project | Projects |  POST | /api/accounts/{account_id}/projects | ProjectsService::createProject() | [x] | [x] |
| Get a list of projects | Projects | GET | /api/accounts/{account_id}/projects | ProjectService::getProjects() | [x] | [x] |
| Get project by ID | Projects | GET | /api/accounts/{account_id}/projects/{project_id} | ProjectService::getProject() | [x] | [x] |
| Update project | Projects | PATCH | /api/accounts/{account_id}/projects/{project_id} | ProjectService::updateProject() | [x] | [x] |
| Delete project | Projects | DELETE | /api/accounts/{account_id}/projects/{project_id} | ProjectService::deleteProject() | [x] | [x] |
| Create an inbox | Inboxes | POST | /api/accounts/{account_id}/projects/{project_id}/inboxes | InboxService::createInbox() | | |
| Get inbox attributes | Inboxes | GET | /api/accounts/{account_id}/inboxes/{inbox_id} | InboxService::getInboxAttributes() | | |
| Delete an inbox | Inboxes | DELETE | /api/accounts/{account_id}/inboxes/{inbox_id} | InboxService::deleteInbox() | | |
| Update an inbox | Inboxes | PATCH | /api/accounts/{account_id}/inboxes/{inbox_id} | InboxService::updateInbox() | | |
| Clean inbox | Inboxes | PATCH | /api/accounts/{account_id}/inboxes/{inbox_id}/clean | InboxService::clean() | |
| Mark as read | Inboxes | PATCH | /api/accounts/{account_id}/inboxes/{inbox_id}/all_read | InboxService::markAllMessagesAsRead() | | |
| Reset credentials | Inboxes | PATCH | /api/accounts/{account_id}/inboxes/{inbox_id}/reset_credentials | InboxService::resetCredentials() | | |
| Enable email address | Inboxes | PATCH | /api/accounts/{account_id}/inboxes/{inbox_id}/toggle_email_username | InboxService::enableEmailAddress() | | |
| Reset email address | Inboxes | PATCH | /api/accounts/{account_id}/inboxes/{inbox_id}/reset_email_username | InboxService::resetEmailUsername() | | |
| Get a list of inboxes | Inboxes | GET | /api/accounts/{account_id}/inboxes | InboxService::getInboxes() | | |
| Show email message | Message | GET | /api/accounts/{account_id}/inboxes/{inbox_id}/messages/{message_id} | MessageService::getMessage() | | |
| Update message | Message | PATCH | /api/accounts/{account_id}/inboxes/{inbox_id}/messages/{message_id} | MessageService::updateMessage() | | | 
| Delete message | Message | DELETE | /api/accounts/{account_id}/inboxes/{inbox_id}/messages/{message_id} | MessageService::deleteMessage()| | |
| Get messages | Message | GET | /api/accounts/{account_id}/inboxes/{inbox_id}/messages | MessageService::getMessages() | | |
| Forward message | Message | POST | /api/accounts/{account_id}/inboxes/{inbox_id}/messages/{message_id}/forward | MessageService::forwardMessage() | | |
| Get message spam score | Message | GET | /api/accounts/{account_id}/inboxes/{inbox_id}/messages/{message_id}/spam_report | MessageService::getMessageSpamScore() | | |
| Get text message | Message | GET | /api/accounts/{account_id}/inboxes/{inbox_id}/messages/{message_id}/body.txt | MessageService::getTextMessage() | | |
| Get raw message | Message | GET | /api/accounts/{account_id}/inboxes/{inbox_id}/messages/{message_id}/body.raw | MessageService::getRawMessage() | | |
| Get message source | Message | GET | /api/accounts/{account_id}/inboxes/{inbox_id}/messages/{message_id}/body.htmlsource | MessageService::getMessageSource() | | |
| Get HTML message | Message | GET | /api/accounts/{account_id}/inboxes/{inbox_id}/messages/{message_id}/body.html | MessageService::getHtmlMessage() | | |
| Get message as .eml | Message | GET | /api/accounts/{account_id}/inboxes/{inbox_id}/messages/{message_id}/body.eml | MessageService::getEmlMessage() | | |
| Get attachments | Message | GET | /api/accounts/{account_id}/inboxes/{inbox_id}/messages/{message_id}/attachments | MessageService::getAttachments() | | |
| Get single attachment | Message | GET | /api/accounts/{account_id}/inboxes/{inbox_id}/messages/{message_id}/attachments/{attachment_id} | MessageService::getAttachment() | | |
