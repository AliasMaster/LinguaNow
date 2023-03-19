import config from './config.json' assert { type: 'json' };

const startOfURL = `${location.origin}/${config.pathname}`;

export default startOfURL;
