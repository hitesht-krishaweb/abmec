/* eslint-disable */

// Nodelist.forEach Polyfill
if (window.NodeList && !NodeList.prototype.forEach) {
    NodeList.prototype.forEach = function (callback, thisArg) {
        const arg = thisArg || window;
        for (var i = 0; i < this.length; i+=1) {
            callback.call(arg, this[i], i, this);
        }
    };
}

// .prepent() PolyFill
// Source: https://github.com/jserz/js_piece/blob/master/DOM/ParentNode/prepend()/prepend().md
(function (arr) {
    arr.forEach(function (item) {
      if (item.hasOwnProperty('prepend')) {
        return;
      }
      Object.defineProperty(item, 'prepend', {
        configurable: true,
        enumerable: true,
        writable: true,
        value: function prepend() {
          var argArr = Array.prototype.slice.call(arguments),
            docFrag = document.createDocumentFragment();

          argArr.forEach(function (argItem) {
            var isNode = argItem instanceof Node;
            docFrag.appendChild(isNode ? argItem : document.createTextNode(String(argItem)));
          });

          this.insertBefore(docFrag, this.firstChild);
        }
      });
    });
  })([Element.prototype, Document.prototype, DocumentFragment.prototype]);