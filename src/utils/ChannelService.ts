/* eslint-disable */ 

// @ts-ignore
class ChannelService {
    constructor() {
      this.loadScript();
    }
  
    loadScript() {
      var w = window;
      // @ts-ignore
      if (w.ChannelIO) {
        return (window.console.error || window.console.log || function(){})('ChannelIO script included twice.');
      }
      var ch = function() {
        // @ts-ignore
        ch.c(arguments);
      };
      // @ts-ignore
      ch.q = [];
      // @ts-ignore
      ch.c = function(args) {
        // @ts-ignore
        ch.q.push(args);
      };
      // @ts-ignore
      w.ChannelIO = ch;
      function l() {
        // @ts-ignore
        if (w.ChannelIOInitialized) {
          return;
        }
        // @ts-ignore
        w.ChannelIOInitialized = true;
        var s = document.createElement('script');
        s.type = 'text/javascript';
        s.async = true;
        s.src = 'https://cdn.channel.io/plugin/ch-plugin-web.js';
        s.charset = 'UTF-8';
        var x = document.getElementsByTagName('script')[0];
        // @ts-ignore
        x.parentNode.insertBefore(s, x);
      }
      if (document.readyState === 'complete') {
        l();
        // @ts-ignore
      } else if (window.attachEvent) {
        // @ts-ignore
        window.attachEvent('onload', l);
      } else {
        window.addEventListener('DOMContentLoaded', l, false);
        window.addEventListener('load', l, false);
      }
    }
  
    // @ts-ignore
    boot(settings) {
      // @ts-ignore
      window.ChannelIO('boot', settings);
    }
  
    shutdown() {
      // @ts-ignore
      window.ChannelIO('shutdown');
    }
  }
  
export default new ChannelService();