__sshclient-promises__ is a lightweight ssh/scp library for [node](http://nodejs.org) using Promises.

__sshclient-promises__ doesn't support interactivity, so you need to set up your remote server to allow login without a password

(Google: 'ssh login without a password').

## Installation

```sh
npm install node-sshclient-promises
```

## Preflight

```js
//some.js
'use strict';
var SSHClient = require('node-sshclient-promises');
const SSH = SSHClient.SSH;
const SCP = SSHClient.SCP;
```

## Examples

### ssh

```js
var ssh = new SSH({
  hostname: 'server',
  user: 'user',
  port: 22
});

//Simple Promise
ssh.command('echo', 'test').then((procResult) => {
  console.log(procResult.stdout);
});

//Chaining Commands
ssh.command('echo', 'test').then((procResult) => {
  console.log(procResult.stdout);
  return ssh.command('ls', '-l');
}).then((procResult) => {
  console.log(procResult.stdout);
});
```

### scp

```js
var scp = new SCP({
  hostname: 'server',
  user: 'user'
});

//Upload
scp.upload('myfile', 'path/to/remote/dir/').then((procResult) => {
  console.log(procResult.exitCode);
});

//Download Single
scp.download('remotefile', 'path/to/local/dir/').then((procResult) => {
  console.log(procResult.exitCode);
});

//Download Queue
scp.download('remotefile', 'path/to/local/dir/').then((procResult) => {
  console.log(procResult.exitCode);
  return scp.download('remotefile2', 'path/to/local/dir');
}).then((procResult) => {
  console.log(procResult.exitCode);
});

```

## Credits

Based off the original callback based `node-sshclient` module found [here](https://github.com/sperka/node-sshclient).
