const Ziggy = {"url":"http:\/\/localhost","port":null,"defaults":{},"routes":{"debugbar.openhandler":{"uri":"_debugbar\/open","methods":["GET","HEAD"]},"debugbar.clockwork":{"uri":"_debugbar\/clockwork\/{id}","methods":["GET","HEAD"],"parameters":["id"]},"debugbar.assets.css":{"uri":"_debugbar\/assets\/stylesheets","methods":["GET","HEAD"]},"debugbar.assets.js":{"uri":"_debugbar\/assets\/javascript","methods":["GET","HEAD"]},"debugbar.cache.delete":{"uri":"_debugbar\/cache\/{key}\/{tags?}","methods":["DELETE"],"parameters":["key","tags"]},"listings.index":{"uri":"listings","methods":["GET","HEAD"]},"listings.create":{"uri":"listings\/create","methods":["GET","HEAD"]},"listings.store":{"uri":"listings","methods":["POST"]},"listings.show":{"uri":"listings\/{listing}","methods":["GET","HEAD"],"parameters":["listing"],"bindings":{"listing":"id"}},"listings.edit":{"uri":"listings\/{listing}\/edit","methods":["GET","HEAD"],"parameters":["listing"],"bindings":{"listing":"id"}},"listings.update":{"uri":"listings\/{listing}","methods":["PUT","PATCH"],"parameters":["listing"],"bindings":{"listing":"id"}},"listings.destroy":{"uri":"listings\/{listing}","methods":["DELETE"],"parameters":["listing"],"bindings":{"listing":"id"}}}};
if (typeof window !== 'undefined' && typeof window.Ziggy !== 'undefined') {
  Object.assign(Ziggy.routes, window.Ziggy.routes);
}
export { Ziggy };
