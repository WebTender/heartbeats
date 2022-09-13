# Heartbeat Service Monitor

Heartbeak monitoring microservice for tracking if background processes stop responding.

#### Setup

`cp .env.example .env`
Update your `.env` as required

-   Set your MySQL / MariaDB credentials
-   Set your Slack or Discord webhooks (optional)

Custom .env options

-   `ENABLE_LIST=true|false`
-   `API_KEY=RANDOM HASH HERE`

`php artisan migrate`

Serve with nginx or for development:
`./up.sh`

#### Create Heartbeats

`curl https://{server}/heartbeat-create?name=XXX&description=YYYY&max_minutes=15&api_key=xxx`
You will receive the UUID back for the heartbeat
You need to add `&api_key=xxx` from your .env's `API_KEY` setting.

#### Delete Heartbeats

`curl https://{server}/heartbeat-delete?uuid={uuid}&api_key=xxx`

#### Use Heartbeats

To update the Heartbeat timestamp by making a GET Request to:
`https://{server}/heartbeat/{uuid}`

You may use this like so using CURL on your linux server
`./work-process.sh && curl https://{server}/heartbeat/{uuid}`

To check the status of the heartbut make a GET request to:
`https://{server}/heartbeat-status/{uuid}`
This will return 200 http status for "online" or 503 http status or "missing in action".

#### Donation

If you find use out of this script, consider buying me a coffee with Bitcoin or don't.

BTC: 3QCnGKxMfak7WZurVpEGkCAxNPcpgDzDGj
