# XKeyMail
Simple BCC audit/statistics via PHP imap. Tested on postfix server.


## How to use this tool ? See example below:
#### 1. Set BCC in your POSTFIX main.cf :
- always_bcc = your-audit-mail@domain.com
#### 2. Edit 2 lines in audit_statistic.php...see example below what you need edit:
- $conn = imap_open('{maildomain.com:143/imap/tls}INBOX', 'your-audit-mail@domain.com', 'your_strong_password', OP_READONLY);
- $conn = imap_open('{maildomain.com:143/imap/tls}INBOX', 'your-audit-mail@domain.com', 'your_strong_password', OP_READONLY);

#### What is done and what is still in development ?
- [x] Simple search for mail passed over the server
- [x] First statistics option for specific search
- [ ] More complex search
- [ ] More complex statistics
- [ ] Export feature
- [ ] Weekly/Monthly reports
- [ ] Custom notifications

...
