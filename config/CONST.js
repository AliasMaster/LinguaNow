import config from './config.json' assert { type: 'json' };

let pathname = config.pathname;

if (location.pathname.includes('linguanow')) {
  pathname = location.pathname.slice(
    0,
    location.pathname.indexOf('linguanow') + 'linguanow'.length,
  );
}

const startOfURL = `${location.origin}/${pathname}`;

export default startOfURL;
