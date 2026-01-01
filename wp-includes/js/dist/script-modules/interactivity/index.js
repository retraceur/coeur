// node_modules/preact/dist/preact.module.js
var n;
var l;
var u;
var t;
var i;
var o;
var r;
var f;
var e;
var c;
var s;
var a;
var h = {};
var v = [];
var p = /acit|ex(?:s|g|n|p|$)|rph|grid|ows|mnc|ntw|ine[ch]|zoo|^ord|itera/i;
var y = Array.isArray;
function d(n3, l5) {
  for (var u4 in l5) n3[u4] = l5[u4];
  return n3;
}
function w(n3) {
  n3 && n3.parentNode && n3.parentNode.removeChild(n3);
}
function _(l5, u4, t4) {
  var i4, o4, r4, f4 = {};
  for (r4 in u4) "key" == r4 ? i4 = u4[r4] : "ref" == r4 ? o4 = u4[r4] : f4[r4] = u4[r4];
  if (arguments.length > 2 && (f4.children = arguments.length > 3 ? n.call(arguments, 2) : t4), "function" == typeof l5 && null != l5.defaultProps) for (r4 in l5.defaultProps) void 0 === f4[r4] && (f4[r4] = l5.defaultProps[r4]);
  return g(l5, f4, i4, o4, null);
}
function g(n3, t4, i4, o4, r4) {
  var f4 = { type: n3, props: t4, key: i4, ref: o4, __k: null, __: null, __b: 0, __e: null, __d: void 0, __c: null, constructor: void 0, __v: null == r4 ? ++u : r4, __i: -1, __u: 0 };
  return null == r4 && null != l.vnode && l.vnode(f4), f4;
}
function b(n3) {
  return n3.children;
}
function k(n3, l5) {
  this.props = n3, this.context = l5;
}
function x(n3, l5) {
  if (null == l5) return n3.__ ? x(n3.__, n3.__i + 1) : null;
  for (var u4; l5 < n3.__k.length; l5++) if (null != (u4 = n3.__k[l5]) && null != u4.__e) return u4.__e;
  return "function" == typeof n3.type ? x(n3) : null;
}
function C(n3) {
  var l5, u4;
  if (null != (n3 = n3.__) && null != n3.__c) {
    for (n3.__e = n3.__c.base = null, l5 = 0; l5 < n3.__k.length; l5++) if (null != (u4 = n3.__k[l5]) && null != u4.__e) {
      n3.__e = n3.__c.base = u4.__e;
      break;
    }
    return C(n3);
  }
}
function M(n3) {
  (!n3.__d && (n3.__d = true) && i.push(n3) && !P.__r++ || o !== l.debounceRendering) && ((o = l.debounceRendering) || r)(P);
}
function P() {
  var n3, u4, t4, o4, r4, e4, c4, s5;
  for (i.sort(f); n3 = i.shift(); ) n3.__d && (u4 = i.length, o4 = void 0, e4 = (r4 = (t4 = n3).__v).__e, c4 = [], s5 = [], t4.__P && ((o4 = d({}, r4)).__v = r4.__v + 1, l.vnode && l.vnode(o4), O(t4.__P, o4, r4, t4.__n, t4.__P.namespaceURI, 32 & r4.__u ? [e4] : null, c4, null == e4 ? x(r4) : e4, !!(32 & r4.__u), s5), o4.__v = r4.__v, o4.__.__k[o4.__i] = o4, j(c4, o4, s5), o4.__e != e4 && C(o4)), i.length > u4 && i.sort(f));
  P.__r = 0;
}
function S(n3, l5, u4, t4, i4, o4, r4, f4, e4, c4, s5) {
  var a4, p5, y4, d5, w4, _5 = t4 && t4.__k || v, g3 = l5.length;
  for (u4.__d = e4, $(u4, l5, _5), e4 = u4.__d, a4 = 0; a4 < g3; a4++) null != (y4 = u4.__k[a4]) && (p5 = -1 === y4.__i ? h : _5[y4.__i] || h, y4.__i = a4, O(n3, y4, p5, i4, o4, r4, f4, e4, c4, s5), d5 = y4.__e, y4.ref && p5.ref != y4.ref && (p5.ref && N(p5.ref, null, y4), s5.push(y4.ref, y4.__c || d5, y4)), null == w4 && null != d5 && (w4 = d5), 65536 & y4.__u || p5.__k === y4.__k ? e4 = I(y4, e4, n3) : "function" == typeof y4.type && void 0 !== y4.__d ? e4 = y4.__d : d5 && (e4 = d5.nextSibling), y4.__d = void 0, y4.__u &= -196609);
  u4.__d = e4, u4.__e = w4;
}
function $(n3, l5, u4) {
  var t4, i4, o4, r4, f4, e4 = l5.length, c4 = u4.length, s5 = c4, a4 = 0;
  for (n3.__k = [], t4 = 0; t4 < e4; t4++) null != (i4 = l5[t4]) && "boolean" != typeof i4 && "function" != typeof i4 ? (r4 = t4 + a4, (i4 = n3.__k[t4] = "string" == typeof i4 || "number" == typeof i4 || "bigint" == typeof i4 || i4.constructor == String ? g(null, i4, null, null, null) : y(i4) ? g(b, { children: i4 }, null, null, null) : void 0 === i4.constructor && i4.__b > 0 ? g(i4.type, i4.props, i4.key, i4.ref ? i4.ref : null, i4.__v) : i4).__ = n3, i4.__b = n3.__b + 1, o4 = null, -1 !== (f4 = i4.__i = L(i4, u4, r4, s5)) && (s5--, (o4 = u4[f4]) && (o4.__u |= 131072)), null == o4 || null === o4.__v ? (-1 == f4 && a4--, "function" != typeof i4.type && (i4.__u |= 65536)) : f4 !== r4 && (f4 == r4 - 1 ? a4-- : f4 == r4 + 1 ? a4++ : (f4 > r4 ? a4-- : a4++, i4.__u |= 65536))) : i4 = n3.__k[t4] = null;
  if (s5) for (t4 = 0; t4 < c4; t4++) null != (o4 = u4[t4]) && 0 == (131072 & o4.__u) && (o4.__e == n3.__d && (n3.__d = x(o4)), V(o4, o4));
}
function I(n3, l5, u4) {
  var t4, i4;
  if ("function" == typeof n3.type) {
    for (t4 = n3.__k, i4 = 0; t4 && i4 < t4.length; i4++) t4[i4] && (t4[i4].__ = n3, l5 = I(t4[i4], l5, u4));
    return l5;
  }
  n3.__e != l5 && (l5 && n3.type && !u4.contains(l5) && (l5 = x(n3)), u4.insertBefore(n3.__e, l5 || null), l5 = n3.__e);
  do {
    l5 = l5 && l5.nextSibling;
  } while (null != l5 && 8 === l5.nodeType);
  return l5;
}
function L(n3, l5, u4, t4) {
  var i4 = n3.key, o4 = n3.type, r4 = u4 - 1, f4 = u4 + 1, e4 = l5[u4];
  if (null === e4 || e4 && i4 == e4.key && o4 === e4.type && 0 == (131072 & e4.__u)) return u4;
  if (t4 > (null != e4 && 0 == (131072 & e4.__u) ? 1 : 0)) for (; r4 >= 0 || f4 < l5.length; ) {
    if (r4 >= 0) {
      if ((e4 = l5[r4]) && 0 == (131072 & e4.__u) && i4 == e4.key && o4 === e4.type) return r4;
      r4--;
    }
    if (f4 < l5.length) {
      if ((e4 = l5[f4]) && 0 == (131072 & e4.__u) && i4 == e4.key && o4 === e4.type) return f4;
      f4++;
    }
  }
  return -1;
}
function T(n3, l5, u4) {
  "-" === l5[0] ? n3.setProperty(l5, null == u4 ? "" : u4) : n3[l5] = null == u4 ? "" : "number" != typeof u4 || p.test(l5) ? u4 : u4 + "px";
}
function A(n3, l5, u4, t4, i4) {
  var o4;
  n: if ("style" === l5) if ("string" == typeof u4) n3.style.cssText = u4;
  else {
    if ("string" == typeof t4 && (n3.style.cssText = t4 = ""), t4) for (l5 in t4) u4 && l5 in u4 || T(n3.style, l5, "");
    if (u4) for (l5 in u4) t4 && u4[l5] === t4[l5] || T(n3.style, l5, u4[l5]);
  }
  else if ("o" === l5[0] && "n" === l5[1]) o4 = l5 !== (l5 = l5.replace(/(PointerCapture)$|Capture$/i, "$1")), l5 = l5.toLowerCase() in n3 || "onFocusOut" === l5 || "onFocusIn" === l5 ? l5.toLowerCase().slice(2) : l5.slice(2), n3.l || (n3.l = {}), n3.l[l5 + o4] = u4, u4 ? t4 ? u4.u = t4.u : (u4.u = e, n3.addEventListener(l5, o4 ? s : c, o4)) : n3.removeEventListener(l5, o4 ? s : c, o4);
  else {
    if ("http://www.w3.org/2000/svg" == i4) l5 = l5.replace(/xlink(H|:h)/, "h").replace(/sName$/, "s");
    else if ("width" != l5 && "height" != l5 && "href" != l5 && "list" != l5 && "form" != l5 && "tabIndex" != l5 && "download" != l5 && "rowSpan" != l5 && "colSpan" != l5 && "role" != l5 && "popover" != l5 && l5 in n3) try {
      n3[l5] = null == u4 ? "" : u4;
      break n;
    } catch (n4) {
    }
    "function" == typeof u4 || (null == u4 || false === u4 && "-" !== l5[4] ? n3.removeAttribute(l5) : n3.setAttribute(l5, "popover" == l5 && 1 == u4 ? "" : u4));
  }
}
function F(n3) {
  return function(u4) {
    if (this.l) {
      var t4 = this.l[u4.type + n3];
      if (null == u4.t) u4.t = e++;
      else if (u4.t < t4.u) return;
      return t4(l.event ? l.event(u4) : u4);
    }
  };
}
function O(n3, u4, t4, i4, o4, r4, f4, e4, c4, s5) {
  var a4, h4, v5, p5, w4, _5, g3, m2, x3, C3, M2, P2, $2, I2, H, L2, T3 = u4.type;
  if (void 0 !== u4.constructor) return null;
  128 & t4.__u && (c4 = !!(32 & t4.__u), r4 = [e4 = u4.__e = t4.__e]), (a4 = l.__b) && a4(u4);
  n: if ("function" == typeof T3) try {
    if (m2 = u4.props, x3 = "prototype" in T3 && T3.prototype.render, C3 = (a4 = T3.contextType) && i4[a4.__c], M2 = a4 ? C3 ? C3.props.value : a4.__ : i4, t4.__c ? g3 = (h4 = u4.__c = t4.__c).__ = h4.__E : (x3 ? u4.__c = h4 = new T3(m2, M2) : (u4.__c = h4 = new k(m2, M2), h4.constructor = T3, h4.render = q), C3 && C3.sub(h4), h4.props = m2, h4.state || (h4.state = {}), h4.context = M2, h4.__n = i4, v5 = h4.__d = true, h4.__h = [], h4._sb = []), x3 && null == h4.__s && (h4.__s = h4.state), x3 && null != T3.getDerivedStateFromProps && (h4.__s == h4.state && (h4.__s = d({}, h4.__s)), d(h4.__s, T3.getDerivedStateFromProps(m2, h4.__s))), p5 = h4.props, w4 = h4.state, h4.__v = u4, v5) x3 && null == T3.getDerivedStateFromProps && null != h4.componentWillMount && h4.componentWillMount(), x3 && null != h4.componentDidMount && h4.__h.push(h4.componentDidMount);
    else {
      if (x3 && null == T3.getDerivedStateFromProps && m2 !== p5 && null != h4.componentWillReceiveProps && h4.componentWillReceiveProps(m2, M2), !h4.__e && (null != h4.shouldComponentUpdate && false === h4.shouldComponentUpdate(m2, h4.__s, M2) || u4.__v === t4.__v)) {
        for (u4.__v !== t4.__v && (h4.props = m2, h4.state = h4.__s, h4.__d = false), u4.__e = t4.__e, u4.__k = t4.__k, u4.__k.some(function(n4) {
          n4 && (n4.__ = u4);
        }), P2 = 0; P2 < h4._sb.length; P2++) h4.__h.push(h4._sb[P2]);
        h4._sb = [], h4.__h.length && f4.push(h4);
        break n;
      }
      null != h4.componentWillUpdate && h4.componentWillUpdate(m2, h4.__s, M2), x3 && null != h4.componentDidUpdate && h4.__h.push(function() {
        h4.componentDidUpdate(p5, w4, _5);
      });
    }
    if (h4.context = M2, h4.props = m2, h4.__P = n3, h4.__e = false, $2 = l.__r, I2 = 0, x3) {
      for (h4.state = h4.__s, h4.__d = false, $2 && $2(u4), a4 = h4.render(h4.props, h4.state, h4.context), H = 0; H < h4._sb.length; H++) h4.__h.push(h4._sb[H]);
      h4._sb = [];
    } else do {
      h4.__d = false, $2 && $2(u4), a4 = h4.render(h4.props, h4.state, h4.context), h4.state = h4.__s;
    } while (h4.__d && ++I2 < 25);
    h4.state = h4.__s, null != h4.getChildContext && (i4 = d(d({}, i4), h4.getChildContext())), x3 && !v5 && null != h4.getSnapshotBeforeUpdate && (_5 = h4.getSnapshotBeforeUpdate(p5, w4)), S(n3, y(L2 = null != a4 && a4.type === b && null == a4.key ? a4.props.children : a4) ? L2 : [L2], u4, t4, i4, o4, r4, f4, e4, c4, s5), h4.base = u4.__e, u4.__u &= -161, h4.__h.length && f4.push(h4), g3 && (h4.__E = h4.__ = null);
  } catch (n4) {
    if (u4.__v = null, c4 || null != r4) {
      for (u4.__u |= c4 ? 160 : 32; e4 && 8 === e4.nodeType && e4.nextSibling; ) e4 = e4.nextSibling;
      r4[r4.indexOf(e4)] = null, u4.__e = e4;
    } else u4.__e = t4.__e, u4.__k = t4.__k;
    l.__e(n4, u4, t4);
  }
  else null == r4 && u4.__v === t4.__v ? (u4.__k = t4.__k, u4.__e = t4.__e) : u4.__e = z(t4.__e, u4, t4, i4, o4, r4, f4, c4, s5);
  (a4 = l.diffed) && a4(u4);
}
function j(n3, u4, t4) {
  u4.__d = void 0;
  for (var i4 = 0; i4 < t4.length; i4++) N(t4[i4], t4[++i4], t4[++i4]);
  l.__c && l.__c(u4, n3), n3.some(function(u5) {
    try {
      n3 = u5.__h, u5.__h = [], n3.some(function(n4) {
        n4.call(u5);
      });
    } catch (n4) {
      l.__e(n4, u5.__v);
    }
  });
}
function z(u4, t4, i4, o4, r4, f4, e4, c4, s5) {
  var a4, v5, p5, d5, _5, g3, m2, b3 = i4.props, k3 = t4.props, C3 = t4.type;
  if ("svg" === C3 ? r4 = "http://www.w3.org/2000/svg" : "math" === C3 ? r4 = "http://www.w3.org/1998/Math/MathML" : r4 || (r4 = "http://www.w3.org/1999/xhtml"), null != f4) {
    for (a4 = 0; a4 < f4.length; a4++) if ((_5 = f4[a4]) && "setAttribute" in _5 == !!C3 && (C3 ? _5.localName === C3 : 3 === _5.nodeType)) {
      u4 = _5, f4[a4] = null;
      break;
    }
  }
  if (null == u4) {
    if (null === C3) return document.createTextNode(k3);
    u4 = document.createElementNS(r4, C3, k3.is && k3), c4 && (l.__m && l.__m(t4, f4), c4 = false), f4 = null;
  }
  if (null === C3) b3 === k3 || c4 && u4.data === k3 || (u4.data = k3);
  else {
    if (f4 = f4 && n.call(u4.childNodes), b3 = i4.props || h, !c4 && null != f4) for (b3 = {}, a4 = 0; a4 < u4.attributes.length; a4++) b3[(_5 = u4.attributes[a4]).name] = _5.value;
    for (a4 in b3) if (_5 = b3[a4], "children" == a4) ;
    else if ("dangerouslySetInnerHTML" == a4) p5 = _5;
    else if (!(a4 in k3)) {
      if ("value" == a4 && "defaultValue" in k3 || "checked" == a4 && "defaultChecked" in k3) continue;
      A(u4, a4, null, _5, r4);
    }
    for (a4 in k3) _5 = k3[a4], "children" == a4 ? d5 = _5 : "dangerouslySetInnerHTML" == a4 ? v5 = _5 : "value" == a4 ? g3 = _5 : "checked" == a4 ? m2 = _5 : c4 && "function" != typeof _5 || b3[a4] === _5 || A(u4, a4, _5, b3[a4], r4);
    if (v5) c4 || p5 && (v5.__html === p5.__html || v5.__html === u4.innerHTML) || (u4.innerHTML = v5.__html), t4.__k = [];
    else if (p5 && (u4.innerHTML = ""), S(u4, y(d5) ? d5 : [d5], t4, i4, o4, "foreignObject" === C3 ? "http://www.w3.org/1999/xhtml" : r4, f4, e4, f4 ? f4[0] : i4.__k && x(i4, 0), c4, s5), null != f4) for (a4 = f4.length; a4--; ) w(f4[a4]);
    c4 || (a4 = "value", "progress" === C3 && null == g3 ? u4.removeAttribute("value") : void 0 !== g3 && (g3 !== u4[a4] || "progress" === C3 && !g3 || "option" === C3 && g3 !== b3[a4]) && A(u4, a4, g3, b3[a4], r4), a4 = "checked", void 0 !== m2 && m2 !== u4[a4] && A(u4, a4, m2, b3[a4], r4));
  }
  return u4;
}
function N(n3, u4, t4) {
  try {
    if ("function" == typeof n3) {
      var i4 = "function" == typeof n3.__u;
      i4 && n3.__u(), i4 && null == u4 || (n3.__u = n3(u4));
    } else n3.current = u4;
  } catch (n4) {
    l.__e(n4, t4);
  }
}
function V(n3, u4, t4) {
  var i4, o4;
  if (l.unmount && l.unmount(n3), (i4 = n3.ref) && (i4.current && i4.current !== n3.__e || N(i4, null, u4)), null != (i4 = n3.__c)) {
    if (i4.componentWillUnmount) try {
      i4.componentWillUnmount();
    } catch (n4) {
      l.__e(n4, u4);
    }
    i4.base = i4.__P = null;
  }
  if (i4 = n3.__k) for (o4 = 0; o4 < i4.length; o4++) i4[o4] && V(i4[o4], u4, t4 || "function" != typeof n3.type);
  t4 || w(n3.__e), n3.__c = n3.__ = n3.__e = n3.__d = void 0;
}
function q(n3, l5, u4) {
  return this.constructor(n3, u4);
}
function B(u4, t4, i4) {
  var o4, r4, f4, e4;
  l.__ && l.__(u4, t4), r4 = (o4 = "function" == typeof i4) ? null : i4 && i4.__k || t4.__k, f4 = [], e4 = [], O(t4, u4 = (!o4 && i4 || t4).__k = _(b, null, [u4]), r4 || h, h, t4.namespaceURI, !o4 && i4 ? [i4] : r4 ? null : t4.firstChild ? n.call(t4.childNodes) : null, f4, !o4 && i4 ? i4 : r4 ? r4.__e : t4.firstChild, o4, e4), j(f4, u4, e4);
}
function D(n3, l5) {
  B(n3, l5, D);
}
function E(l5, u4, t4) {
  var i4, o4, r4, f4, e4 = d({}, l5.props);
  for (r4 in l5.type && l5.type.defaultProps && (f4 = l5.type.defaultProps), u4) "key" == r4 ? i4 = u4[r4] : "ref" == r4 ? o4 = u4[r4] : e4[r4] = void 0 === u4[r4] && void 0 !== f4 ? f4[r4] : u4[r4];
  return arguments.length > 2 && (e4.children = arguments.length > 3 ? n.call(arguments, 2) : t4), g(l5.type, e4, i4 || l5.key, o4 || l5.ref, null);
}
function G(n3, l5) {
  var u4 = { __c: l5 = "__cC" + a++, __: n3, Consumer: function(n4, l6) {
    return n4.children(l6);
  }, Provider: function(n4) {
    var u5, t4;
    return this.getChildContext || (u5 = [], (t4 = {})[l5] = this, this.getChildContext = function() {
      return t4;
    }, this.componentWillUnmount = function() {
      u5 = null;
    }, this.shouldComponentUpdate = function(n5) {
      this.props.value !== n5.value && u5.some(function(n6) {
        n6.__e = true, M(n6);
      });
    }, this.sub = function(n5) {
      u5.push(n5);
      var l6 = n5.componentWillUnmount;
      n5.componentWillUnmount = function() {
        u5 && u5.splice(u5.indexOf(n5), 1), l6 && l6.call(n5);
      };
    }), n4.children;
  } };
  return u4.Provider.__ = u4.Consumer.contextType = u4;
}
n = v.slice, l = { __e: function(n3, l5, u4, t4) {
  for (var i4, o4, r4; l5 = l5.__; ) if ((i4 = l5.__c) && !i4.__) try {
    if ((o4 = i4.constructor) && null != o4.getDerivedStateFromError && (i4.setState(o4.getDerivedStateFromError(n3)), r4 = i4.__d), null != i4.componentDidCatch && (i4.componentDidCatch(n3, t4 || {}), r4 = i4.__d), r4) return i4.__E = i4;
  } catch (l6) {
    n3 = l6;
  }
  throw n3;
} }, u = 0, t = function(n3) {
  return null != n3 && null == n3.constructor;
}, k.prototype.setState = function(n3, l5) {
  var u4;
  u4 = null != this.__s && this.__s !== this.state ? this.__s : this.__s = d({}, this.state), "function" == typeof n3 && (n3 = n3(d({}, u4), this.props)), n3 && d(u4, n3), null != n3 && this.__v && (l5 && this._sb.push(l5), M(this));
}, k.prototype.forceUpdate = function(n3) {
  this.__v && (this.__e = true, n3 && this.__h.push(n3), M(this));
}, k.prototype.render = b, i = [], r = "function" == typeof Promise ? Promise.prototype.then.bind(Promise.resolve()) : setTimeout, f = function(n3, l5) {
  return n3.__v.__b - l5.__v.__b;
}, P.__r = 0, e = 0, c = F(false), s = F(true), a = 0;

// node_modules/preact/hooks/dist/hooks.module.js
var t2;
var r2;
var u2;
var i2;
var o2 = 0;
var f2 = [];
var c2 = l;
var e2 = c2.__b;
var a2 = c2.__r;
var v2 = c2.diffed;
var l2 = c2.__c;
var m = c2.unmount;
var s2 = c2.__;
function d2(n3, t4) {
  c2.__h && c2.__h(r2, n3, o2 || t4), o2 = 0;
  var u4 = r2.__H || (r2.__H = { __: [], __h: [] });
  return n3 >= u4.__.length && u4.__.push({}), u4.__[n3];
}
function h2(n3) {
  return o2 = 1, p2(D2, n3);
}
function p2(n3, u4, i4) {
  var o4 = d2(t2++, 2);
  if (o4.t = n3, !o4.__c && (o4.__ = [i4 ? i4(u4) : D2(void 0, u4), function(n4) {
    var t4 = o4.__N ? o4.__N[0] : o4.__[0], r4 = o4.t(t4, n4);
    t4 !== r4 && (o4.__N = [r4, o4.__[1]], o4.__c.setState({}));
  }], o4.__c = r2, !r2.u)) {
    var f4 = function(n4, t4, r4) {
      if (!o4.__c.__H) return true;
      var u5 = o4.__c.__H.__.filter(function(n5) {
        return !!n5.__c;
      });
      if (u5.every(function(n5) {
        return !n5.__N;
      })) return !c4 || c4.call(this, n4, t4, r4);
      var i5 = false;
      return u5.forEach(function(n5) {
        if (n5.__N) {
          var t5 = n5.__[0];
          n5.__ = n5.__N, n5.__N = void 0, t5 !== n5.__[0] && (i5 = true);
        }
      }), !(!i5 && o4.__c.props === n4) && (!c4 || c4.call(this, n4, t4, r4));
    };
    r2.u = true;
    var c4 = r2.shouldComponentUpdate, e4 = r2.componentWillUpdate;
    r2.componentWillUpdate = function(n4, t4, r4) {
      if (this.__e) {
        var u5 = c4;
        c4 = void 0, f4(n4, t4, r4), c4 = u5;
      }
      e4 && e4.call(this, n4, t4, r4);
    }, r2.shouldComponentUpdate = f4;
  }
  return o4.__N || o4.__;
}
function y2(n3, u4) {
  var i4 = d2(t2++, 3);
  !c2.__s && C2(i4.__H, u4) && (i4.__ = n3, i4.i = u4, r2.__H.__h.push(i4));
}
function _2(n3, u4) {
  var i4 = d2(t2++, 4);
  !c2.__s && C2(i4.__H, u4) && (i4.__ = n3, i4.i = u4, r2.__h.push(i4));
}
function A2(n3) {
  return o2 = 5, T2(function() {
    return { current: n3 };
  }, []);
}
function T2(n3, r4) {
  var u4 = d2(t2++, 7);
  return C2(u4.__H, r4) && (u4.__ = n3(), u4.__H = r4, u4.__h = n3), u4.__;
}
function q2(n3, t4) {
  return o2 = 8, T2(function() {
    return n3;
  }, t4);
}
function x2(n3) {
  var u4 = r2.context[n3.__c], i4 = d2(t2++, 9);
  return i4.c = n3, u4 ? (null == i4.__ && (i4.__ = true, u4.sub(r2)), u4.props.value) : n3.__;
}
function j2() {
  for (var n3; n3 = f2.shift(); ) if (n3.__P && n3.__H) try {
    n3.__H.__h.forEach(z2), n3.__H.__h.forEach(B2), n3.__H.__h = [];
  } catch (t4) {
    n3.__H.__h = [], c2.__e(t4, n3.__v);
  }
}
c2.__b = function(n3) {
  r2 = null, e2 && e2(n3);
}, c2.__ = function(n3, t4) {
  n3 && t4.__k && t4.__k.__m && (n3.__m = t4.__k.__m), s2 && s2(n3, t4);
}, c2.__r = function(n3) {
  a2 && a2(n3), t2 = 0;
  var i4 = (r2 = n3.__c).__H;
  i4 && (u2 === r2 ? (i4.__h = [], r2.__h = [], i4.__.forEach(function(n4) {
    n4.__N && (n4.__ = n4.__N), n4.i = n4.__N = void 0;
  })) : (i4.__h.forEach(z2), i4.__h.forEach(B2), i4.__h = [], t2 = 0)), u2 = r2;
}, c2.diffed = function(n3) {
  v2 && v2(n3);
  var t4 = n3.__c;
  t4 && t4.__H && (t4.__H.__h.length && (1 !== f2.push(t4) && i2 === c2.requestAnimationFrame || ((i2 = c2.requestAnimationFrame) || w2)(j2)), t4.__H.__.forEach(function(n4) {
    n4.i && (n4.__H = n4.i), n4.i = void 0;
  })), u2 = r2 = null;
}, c2.__c = function(n3, t4) {
  t4.some(function(n4) {
    try {
      n4.__h.forEach(z2), n4.__h = n4.__h.filter(function(n5) {
        return !n5.__ || B2(n5);
      });
    } catch (r4) {
      t4.some(function(n5) {
        n5.__h && (n5.__h = []);
      }), t4 = [], c2.__e(r4, n4.__v);
    }
  }), l2 && l2(n3, t4);
}, c2.unmount = function(n3) {
  m && m(n3);
  var t4, r4 = n3.__c;
  r4 && r4.__H && (r4.__H.__.forEach(function(n4) {
    try {
      z2(n4);
    } catch (n5) {
      t4 = n5;
    }
  }), r4.__H = void 0, t4 && c2.__e(t4, r4.__v));
};
var k2 = "function" == typeof requestAnimationFrame;
function w2(n3) {
  var t4, r4 = function() {
    clearTimeout(u4), k2 && cancelAnimationFrame(t4), setTimeout(n3);
  }, u4 = setTimeout(r4, 100);
  k2 && (t4 = requestAnimationFrame(r4));
}
function z2(n3) {
  var t4 = r2, u4 = n3.__c;
  "function" == typeof u4 && (n3.__c = void 0, u4()), r2 = t4;
}
function B2(n3) {
  var t4 = r2;
  n3.__c = n3.__(), r2 = t4;
}
function C2(n3, t4) {
  return !n3 || n3.length !== t4.length || t4.some(function(t5, r4) {
    return t5 !== n3[r4];
  });
}
function D2(n3, t4) {
  return "function" == typeof t4 ? t4(n3) : t4;
}

// node_modules/@preact/signals-core/dist/signals-core.module.js
var i3 = Symbol.for("preact-signals");
function t3() {
  if (!(s3 > 1)) {
    var i4, t4 = false;
    while (void 0 !== h3) {
      var r4 = h3;
      h3 = void 0;
      f3++;
      while (void 0 !== r4) {
        var o4 = r4.o;
        r4.o = void 0;
        r4.f &= -3;
        if (!(8 & r4.f) && c3(r4)) try {
          r4.c();
        } catch (r5) {
          if (!t4) {
            i4 = r5;
            t4 = true;
          }
        }
        r4 = o4;
      }
    }
    f3 = 0;
    s3--;
    if (t4) throw i4;
  } else s3--;
}
function r3(i4) {
  if (s3 > 0) return i4();
  s3++;
  try {
    return i4();
  } finally {
    t3();
  }
}
var o3 = void 0;
var h3 = void 0;
var s3 = 0;
var f3 = 0;
var v3 = 0;
function e3(i4) {
  if (void 0 !== o3) {
    var t4 = i4.n;
    if (void 0 === t4 || t4.t !== o3) {
      t4 = { i: 0, S: i4, p: o3.s, n: void 0, t: o3, e: void 0, x: void 0, r: t4 };
      if (void 0 !== o3.s) o3.s.n = t4;
      o3.s = t4;
      i4.n = t4;
      if (32 & o3.f) i4.S(t4);
      return t4;
    } else if (-1 === t4.i) {
      t4.i = 0;
      if (void 0 !== t4.n) {
        t4.n.p = t4.p;
        if (void 0 !== t4.p) t4.p.n = t4.n;
        t4.p = o3.s;
        t4.n = void 0;
        o3.s.n = t4;
        o3.s = t4;
      }
      return t4;
    }
  }
}
function u3(i4) {
  this.v = i4;
  this.i = 0;
  this.n = void 0;
  this.t = void 0;
}
u3.prototype.brand = i3;
u3.prototype.h = function() {
  return true;
};
u3.prototype.S = function(i4) {
  if (this.t !== i4 && void 0 === i4.e) {
    i4.x = this.t;
    if (void 0 !== this.t) this.t.e = i4;
    this.t = i4;
  }
};
u3.prototype.U = function(i4) {
  if (void 0 !== this.t) {
    var t4 = i4.e, r4 = i4.x;
    if (void 0 !== t4) {
      t4.x = r4;
      i4.e = void 0;
    }
    if (void 0 !== r4) {
      r4.e = t4;
      i4.x = void 0;
    }
    if (i4 === this.t) this.t = r4;
  }
};
u3.prototype.subscribe = function(i4) {
  var t4 = this;
  return E2(function() {
    var r4 = t4.value, n3 = o3;
    o3 = void 0;
    try {
      i4(r4);
    } finally {
      o3 = n3;
    }
  });
};
u3.prototype.valueOf = function() {
  return this.value;
};
u3.prototype.toString = function() {
  return this.value + "";
};
u3.prototype.toJSON = function() {
  return this.value;
};
u3.prototype.peek = function() {
  var i4 = o3;
  o3 = void 0;
  try {
    return this.value;
  } finally {
    o3 = i4;
  }
};
Object.defineProperty(u3.prototype, "value", { get: function() {
  var i4 = e3(this);
  if (void 0 !== i4) i4.i = this.i;
  return this.v;
}, set: function(i4) {
  if (i4 !== this.v) {
    if (f3 > 100) throw new Error("Cycle detected");
    this.v = i4;
    this.i++;
    v3++;
    s3++;
    try {
      for (var r4 = this.t; void 0 !== r4; r4 = r4.x) r4.t.N();
    } finally {
      t3();
    }
  }
} });
function d3(i4) {
  return new u3(i4);
}
function c3(i4) {
  for (var t4 = i4.s; void 0 !== t4; t4 = t4.n) if (t4.S.i !== t4.i || !t4.S.h() || t4.S.i !== t4.i) return true;
  return false;
}
function a3(i4) {
  for (var t4 = i4.s; void 0 !== t4; t4 = t4.n) {
    var r4 = t4.S.n;
    if (void 0 !== r4) t4.r = r4;
    t4.S.n = t4;
    t4.i = -1;
    if (void 0 === t4.n) {
      i4.s = t4;
      break;
    }
  }
}
function l3(i4) {
  var t4 = i4.s, r4 = void 0;
  while (void 0 !== t4) {
    var o4 = t4.p;
    if (-1 === t4.i) {
      t4.S.U(t4);
      if (void 0 !== o4) o4.n = t4.n;
      if (void 0 !== t4.n) t4.n.p = o4;
    } else r4 = t4;
    t4.S.n = t4.r;
    if (void 0 !== t4.r) t4.r = void 0;
    t4 = o4;
  }
  i4.s = r4;
}
function y3(i4) {
  u3.call(this, void 0);
  this.x = i4;
  this.s = void 0;
  this.g = v3 - 1;
  this.f = 4;
}
(y3.prototype = new u3()).h = function() {
  this.f &= -3;
  if (1 & this.f) return false;
  if (32 == (36 & this.f)) return true;
  this.f &= -5;
  if (this.g === v3) return true;
  this.g = v3;
  this.f |= 1;
  if (this.i > 0 && !c3(this)) {
    this.f &= -2;
    return true;
  }
  var i4 = o3;
  try {
    a3(this);
    o3 = this;
    var t4 = this.x();
    if (16 & this.f || this.v !== t4 || 0 === this.i) {
      this.v = t4;
      this.f &= -17;
      this.i++;
    }
  } catch (i5) {
    this.v = i5;
    this.f |= 16;
    this.i++;
  }
  o3 = i4;
  l3(this);
  this.f &= -2;
  return true;
};
y3.prototype.S = function(i4) {
  if (void 0 === this.t) {
    this.f |= 36;
    for (var t4 = this.s; void 0 !== t4; t4 = t4.n) t4.S.S(t4);
  }
  u3.prototype.S.call(this, i4);
};
y3.prototype.U = function(i4) {
  if (void 0 !== this.t) {
    u3.prototype.U.call(this, i4);
    if (void 0 === this.t) {
      this.f &= -33;
      for (var t4 = this.s; void 0 !== t4; t4 = t4.n) t4.S.U(t4);
    }
  }
};
y3.prototype.N = function() {
  if (!(2 & this.f)) {
    this.f |= 6;
    for (var i4 = this.t; void 0 !== i4; i4 = i4.x) i4.t.N();
  }
};
Object.defineProperty(y3.prototype, "value", { get: function() {
  if (1 & this.f) throw new Error("Cycle detected");
  var i4 = e3(this);
  this.h();
  if (void 0 !== i4) i4.i = this.i;
  if (16 & this.f) throw this.v;
  return this.v;
} });
function w3(i4) {
  return new y3(i4);
}
function _3(i4) {
  var r4 = i4.u;
  i4.u = void 0;
  if ("function" == typeof r4) {
    s3++;
    var n3 = o3;
    o3 = void 0;
    try {
      r4();
    } catch (t4) {
      i4.f &= -2;
      i4.f |= 8;
      g2(i4);
      throw t4;
    } finally {
      o3 = n3;
      t3();
    }
  }
}
function g2(i4) {
  for (var t4 = i4.s; void 0 !== t4; t4 = t4.n) t4.S.U(t4);
  i4.x = void 0;
  i4.s = void 0;
  _3(i4);
}
function p3(i4) {
  if (o3 !== this) throw new Error("Out-of-order effect");
  l3(this);
  o3 = i4;
  this.f &= -2;
  if (8 & this.f) g2(this);
  t3();
}
function b2(i4) {
  this.x = i4;
  this.u = void 0;
  this.s = void 0;
  this.o = void 0;
  this.f = 32;
}
b2.prototype.c = function() {
  var i4 = this.S();
  try {
    if (8 & this.f) return;
    if (void 0 === this.x) return;
    var t4 = this.x();
    if ("function" == typeof t4) this.u = t4;
  } finally {
    i4();
  }
};
b2.prototype.S = function() {
  if (1 & this.f) throw new Error("Cycle detected");
  this.f |= 1;
  this.f &= -9;
  _3(this);
  a3(this);
  s3++;
  var i4 = o3;
  o3 = this;
  return p3.bind(this, i4);
};
b2.prototype.N = function() {
  if (!(2 & this.f)) {
    this.f |= 2;
    this.o = h3;
    h3 = this;
  }
};
b2.prototype.d = function() {
  this.f |= 8;
  if (!(1 & this.f)) g2(this);
};
function E2(i4) {
  var t4 = new b2(i4);
  try {
    t4.c();
  } catch (i5) {
    t4.d();
    throw i5;
  }
  return t4.d.bind(t4);
}

// node_modules/@preact/signals/dist/signals.module.js
var v4;
var s4;
function l4(n3, i4) {
  l[n3] = i4.bind(null, l[n3] || function() {
  });
}
function d4(n3) {
  if (s4) s4();
  s4 = n3 && n3.S();
}
function p4(n3) {
  var r4 = this, f4 = n3.data, o4 = useSignal(f4);
  o4.value = f4;
  var e4 = T2(function() {
    var n4 = r4.__v;
    while (n4 = n4.__) if (n4.__c) {
      n4.__c.__$f |= 4;
      break;
    }
    r4.__$u.c = function() {
      var n5;
      if (!t(e4.peek()) && 3 === (null == (n5 = r4.base) ? void 0 : n5.nodeType)) r4.base.data = e4.peek();
      else {
        r4.__$f |= 1;
        r4.setState({});
      }
    };
    return w3(function() {
      var n5 = o4.value.value;
      return 0 === n5 ? 0 : true === n5 ? "" : n5 || "";
    });
  }, []);
  return e4.value;
}
p4.displayName = "_st";
Object.defineProperties(u3.prototype, { constructor: { configurable: true, value: void 0 }, type: { configurable: true, value: p4 }, props: { configurable: true, get: function() {
  return { data: this };
} }, __b: { configurable: true, value: 1 } });
l4("__b", function(n3, r4) {
  if ("string" == typeof r4.type) {
    var i4, t4 = r4.props;
    for (var f4 in t4) if ("children" !== f4) {
      var o4 = t4[f4];
      if (o4 instanceof u3) {
        if (!i4) r4.__np = i4 = {};
        i4[f4] = o4;
        t4[f4] = o4.peek();
      }
    }
  }
  n3(r4);
});
l4("__r", function(n3, r4) {
  d4();
  var i4, t4 = r4.__c;
  if (t4) {
    t4.__$f &= -2;
    if (void 0 === (i4 = t4.__$u)) t4.__$u = i4 = (function(n4) {
      var r5;
      E2(function() {
        r5 = this;
      });
      r5.c = function() {
        t4.__$f |= 1;
        t4.setState({});
      };
      return r5;
    })();
  }
  v4 = t4;
  d4(i4);
  n3(r4);
});
l4("__e", function(n3, r4, i4, t4) {
  d4();
  v4 = void 0;
  n3(r4, i4, t4);
});
l4("diffed", function(n3, r4) {
  d4();
  v4 = void 0;
  var i4;
  if ("string" == typeof r4.type && (i4 = r4.__e)) {
    var t4 = r4.__np, f4 = r4.props;
    if (t4) {
      var o4 = i4.U;
      if (o4) for (var e4 in o4) {
        var u4 = o4[e4];
        if (void 0 !== u4 && !(e4 in t4)) {
          u4.d();
          o4[e4] = void 0;
        }
      }
      else i4.U = o4 = {};
      for (var a4 in t4) {
        var c4 = o4[a4], s5 = t4[a4];
        if (void 0 === c4) {
          c4 = _4(i4, a4, s5, f4);
          o4[a4] = c4;
        } else c4.o(s5, f4);
      }
    }
  }
  n3(r4);
});
function _4(n3, r4, i4, t4) {
  var f4 = r4 in n3 && void 0 === n3.ownerSVGElement, o4 = d3(i4);
  return { o: function(n4, r5) {
    o4.value = n4;
    t4 = r5;
  }, d: E2(function() {
    var i5 = o4.value.value;
    if (t4[r4] !== i5) {
      t4[r4] = i5;
      if (f4) n3[r4] = i5;
      else if (i5) n3.setAttribute(r4, i5);
      else n3.removeAttribute(r4);
    }
  }) };
}
l4("unmount", function(n3, r4) {
  if ("string" == typeof r4.type) {
    var i4 = r4.__e;
    if (i4) {
      var t4 = i4.U;
      if (t4) {
        i4.U = void 0;
        for (var f4 in t4) {
          var o4 = t4[f4];
          if (o4) o4.d();
        }
      }
    }
  } else {
    var e4 = r4.__c;
    if (e4) {
      var u4 = e4.__$u;
      if (u4) {
        e4.__$u = void 0;
        u4.d();
      }
    }
  }
  n3(r4);
});
l4("__h", function(n3, r4, i4, t4) {
  if (t4 < 3 || 9 === t4) r4.__$f |= 2;
  n3(r4, i4, t4);
});
k.prototype.shouldComponentUpdate = function(n3, r4) {
  var i4 = this.__$u;
  if (!(i4 && void 0 !== i4.s || 4 & this.__$f)) return true;
  if (3 & this.__$f) return true;
  for (var t4 in r4) return true;
  for (var f4 in n3) if ("__source" !== f4 && n3[f4] !== this.props[f4]) return true;
  for (var o4 in this.props) if (!(o4 in n3)) return true;
  return false;
};
function useSignal(n3) {
  return T2(function() {
    return d3(n3);
  }, []);
}

// packages/interactivity/build-module/namespaces.js
var namespaceStack = [];
var getNamespace = () => namespaceStack.slice(-1)[0];
var setNamespace = (namespace) => {
  namespaceStack.push(namespace);
};
var resetNamespace = () => {
  namespaceStack.pop();
};

// packages/interactivity/build-module/scopes.js
var scopeStack = [];
var getScope = () => scopeStack.slice(-1)[0];
var setScope = (scope) => {
  scopeStack.push(scope);
};
var resetScope = () => {
  scopeStack.pop();
};
var getContext = (namespace) => {
  const scope = getScope();
  if (false) {
    if (!scope) {
      throwNotInScope("getContext");
    }
  }
  return scope.context[namespace || getNamespace()];
};
var getElement = () => {
  const scope = getScope();
  let deepReadOnlyOptions = {};
  if (false) {
    if (!scope) {
      throwNotInScope("getElement");
    }
    deepReadOnlyOptions = {
      errorMessage: "Don't mutate the attributes from `getElement`, use `data-wp-bind` to modify the attributes of an element instead."
    };
  }
  const { ref, attributes } = scope;
  return Object.freeze({
    ref: ref.current,
    attributes: deepReadOnly(attributes, deepReadOnlyOptions)
  });
};
var navigationContextSignal = d3(0);
function getServerContext(namespace) {
  const scope = getScope();
  if (false) {
    if (!scope) {
      throwNotInScope("getServerContext");
    }
  }
  getServerContext.subscribe = navigationContextSignal.value;
  return deepClone(scope.serverContext[namespace || getNamespace()]);
}
getServerContext.subscribe = 0;

// packages/interactivity/build-module/utils.js
var afterNextFrame = (callback) => {
  return new Promise((resolve2) => {
    const done = () => {
      clearTimeout(timeout);
      window.cancelAnimationFrame(raf);
      setTimeout(() => {
        callback();
        resolve2();
      });
    };
    const timeout = setTimeout(done, 100);
    const raf = window.requestAnimationFrame(done);
  });
};
var splitTask = typeof window.scheduler?.yield === "function" ? window.scheduler.yield.bind(window.scheduler) : () => {
  return new Promise((resolve2) => {
    setTimeout(resolve2, 0);
  });
};
function createFlusher(compute, notify) {
  let flush = () => void 0;
  const dispose = E2(function() {
    flush = this.c.bind(this);
    this.x = compute;
    this.c = notify;
    return compute();
  });
  return { flush, dispose };
}
function useSignalEffect(callback) {
  y2(() => {
    let eff = null;
    let isExecuting = false;
    const notify = async () => {
      if (eff && !isExecuting) {
        isExecuting = true;
        await afterNextFrame(eff.flush);
        isExecuting = false;
      }
    };
    eff = createFlusher(callback, notify);
    return eff.dispose;
  }, []);
}
function withScope(func) {
  const scope = getScope();
  const ns = getNamespace();
  let wrapped;
  if (func?.constructor?.name === "GeneratorFunction") {
    wrapped = async (...args) => {
      const gen = func(...args);
      let value;
      let it;
      let error;
      while (true) {
        setNamespace(ns);
        setScope(scope);
        try {
          it = error ? gen.throw(error) : gen.next(value);
          error = void 0;
        } catch (e4) {
          throw e4;
        } finally {
          resetScope();
          resetNamespace();
        }
        try {
          value = await it.value;
        } catch (e4) {
          error = e4;
        }
        if (it.done) {
          if (error) {
            throw error;
          } else {
            break;
          }
        }
      }
      return value;
    };
  } else {
    wrapped = (...args) => {
      setNamespace(ns);
      setScope(scope);
      try {
        return func(...args);
      } finally {
        resetNamespace();
        resetScope();
      }
    };
  }
  const syncAware = func;
  if (syncAware.sync) {
    const syncAwareWrapped = wrapped;
    syncAwareWrapped.sync = true;
    return syncAwareWrapped;
  }
  return wrapped;
}
function useWatch(callback) {
  useSignalEffect(withScope(callback));
}
function useInit(callback) {
  y2(withScope(callback), []);
}
function useEffect(callback, inputs) {
  y2(withScope(callback), inputs);
}
function useLayoutEffect(callback, inputs) {
  _2(withScope(callback), inputs);
}
function useCallback(callback, inputs) {
  return q2(withScope(callback), inputs);
}
function useMemo(factory, inputs) {
  return T2(withScope(factory), inputs);
}
var createRootFragment = (parent, replaceNode) => {
  replaceNode = [].concat(replaceNode);
  const sibling = replaceNode[replaceNode.length - 1].nextSibling;
  function insert(child, root) {
    parent.insertBefore(child, root || sibling);
  }
  return parent.__k = {
    nodeType: 1,
    parentNode: parent,
    firstChild: replaceNode[0],
    childNodes: replaceNode,
    insertBefore: insert,
    appendChild: insert,
    removeChild(c4) {
      parent.removeChild(c4);
    },
    contains(c4) {
      parent.contains(c4);
    }
  };
};
function kebabToCamelCase(str) {
  return str.replace(/^-+|-+$/g, "").toLowerCase().replace(/-([a-z])/g, function(_match, group1) {
    return group1.toUpperCase();
  });
}
var warn = (message) => {
  if (false) {
    if (logged.has(message)) {
      return;
    }
    console.warn(message);
    try {
      throw Error(message);
    } catch (e4) {
    }
    logged.add(message);
  }
};
var isPlainObject = (candidate) => Boolean(
  candidate && typeof candidate === "object" && candidate.constructor === Object
);
function withSyncEvent(callback) {
  const syncAware = callback;
  syncAware.sync = true;
  return syncAware;
}
var readOnlyMap = /* @__PURE__ */ new WeakMap();
var createDeepReadOnlyHandlers = (errorMessage) => {
  const handleError = () => {
    if (false) {
      warn(errorMessage);
    }
    return false;
  };
  return {
    get(target, prop) {
      const value = target[prop];
      if (value && typeof value === "object") {
        return deepReadOnly(value, { errorMessage });
      }
      return value;
    },
    set: handleError,
    deleteProperty: handleError,
    defineProperty: handleError
  };
};
function deepReadOnly(obj, options) {
  const errorMessage = options?.errorMessage ?? "Cannot modify read-only object";
  if (!readOnlyMap.has(obj)) {
    const handlers = createDeepReadOnlyHandlers(errorMessage);
    readOnlyMap.set(obj, new Proxy(obj, handlers));
  }
  return readOnlyMap.get(obj);
}
var navigationSignal = d3(0);
function deepClone(source) {
  if (isPlainObject(source)) {
    return Object.fromEntries(
      Object.entries(source).map(([key, value]) => [
        key,
        deepClone(value)
      ])
    );
  }
  if (Array.isArray(source)) {
    return source.map((i4) => deepClone(i4));
  }
  return source;
}

// packages/interactivity/build-module/proxies/registry.js
var objToProxy = /* @__PURE__ */ new WeakMap();
var proxyToObj = /* @__PURE__ */ new WeakMap();
var proxyToNs = /* @__PURE__ */ new WeakMap();
var supported = /* @__PURE__ */ new Set([Object, Array]);
var createProxy = (namespace, obj, handlers) => {
  if (!shouldProxy(obj)) {
    throw Error("This object cannot be proxified.");
  }
  if (!objToProxy.has(obj)) {
    const proxy = new Proxy(obj, handlers);
    objToProxy.set(obj, proxy);
    proxyToObj.set(proxy, obj);
    proxyToNs.set(proxy, namespace);
  }
  return objToProxy.get(obj);
};
var getProxyFromObject = (obj) => objToProxy.get(obj);
var getNamespaceFromProxy = (proxy) => proxyToNs.get(proxy);
var shouldProxy = (candidate) => {
  if (typeof candidate !== "object" || candidate === null) {
    return false;
  }
  return !proxyToNs.has(candidate) && supported.has(candidate.constructor);
};
var getObjectFromProxy = (proxy) => proxyToObj.get(proxy);

// packages/interactivity/build-module/proxies/signals.js
var NO_SCOPE = {};
var PropSignal = class {
  /**
   * Proxy that holds the property this PropSignal is associated with.
   */
  owner;
  /**
   * Relation of computeds by scope. These computeds are read-only signals
   * that depend on whether the property is a value or a getter and,
   * therefore, can return different values depending on the scope in which
   * the getter is accessed.
   */
  computedsByScope;
  /**
   * Signal with the value assigned to the related property.
   */
  valueSignal;
  /**
   * Signal with the getter assigned to the related property.
   */
  getterSignal;
  /**
   * Pending getter to be consolidated.
   */
  pendingGetter;
  /**
   * Structure that manages reactivity for a property in a state object, using
   * signals to keep track of property value or getter modifications.
   *
   * @param owner Proxy that holds the property this instance is associated
   *              with.
   */
  constructor(owner) {
    this.owner = owner;
    this.computedsByScope = /* @__PURE__ */ new WeakMap();
  }
  /**
   * Changes the internal value. If a getter was set before, it is set to
   * `undefined`.
   *
   * @param value New value.
   */
  setValue(value) {
    this.update({ value });
  }
  /**
   * Changes the internal getter. If a value was set before, it is set to
   * `undefined`.
   *
   * @param getter New getter.
   */
  setGetter(getter) {
    this.update({ get: getter });
  }
  /**
   * Changes the internal getter asynchronously.
   *
   * The update is made in a microtask, which prevents issues with getters
   * accessing the state, and ensures the update occurs before any render.
   *
   * @param getter New getter.
   */
  setPendingGetter(getter) {
    this.pendingGetter = getter;
    queueMicrotask(() => this.consolidateGetter());
  }
  /**
   * Consolidate the pending value of the getter.
   */
  consolidateGetter() {
    const getter = this.pendingGetter;
    if (getter) {
      this.pendingGetter = void 0;
      this.update({ get: getter });
    }
  }
  /**
   * Returns the computed that holds the result of evaluating the prop in the
   * current scope.
   *
   * These computeds are read-only signals that depend on whether the property
   * is a value or a getter and, therefore, can return different values
   * depending on the scope in which the getter is accessed.
   *
   * @return Computed that depends on the scope.
   */
  getComputed() {
    const scope = getScope() || NO_SCOPE;
    if (!this.valueSignal && !this.getterSignal) {
      this.update({});
    }
    if (this.pendingGetter) {
      this.consolidateGetter();
    }
    if (!this.computedsByScope.has(scope)) {
      const callback = () => {
        const getter = this.getterSignal?.value;
        return getter ? getter.call(this.owner) : this.valueSignal?.value;
      };
      setNamespace(getNamespaceFromProxy(this.owner));
      this.computedsByScope.set(
        scope,
        w3(withScope(callback))
      );
      resetNamespace();
    }
    return this.computedsByScope.get(scope);
  }
  /**
   *  Updates the internal signals for the value and the getter of the
   *  corresponding prop.
   *
   * @param param0
   * @param param0.get   New getter.
   * @param param0.value New value.
   */
  update({ get, value }) {
    if (!this.valueSignal) {
      this.valueSignal = d3(value);
      this.getterSignal = d3(get);
    } else if (value !== this.valueSignal.peek() || get !== this.getterSignal.peek()) {
      r3(() => {
        this.valueSignal.value = value;
        this.getterSignal.value = get;
      });
    }
  }
};

// packages/interactivity/build-module/proxies/state.js
var wellKnownSymbols = new Set(
  Object.getOwnPropertyNames(Symbol).map((key) => Symbol[key]).filter((value) => typeof value === "symbol")
);
var proxyToProps = /* @__PURE__ */ new WeakMap();
var hasPropSignal = (proxy, key) => proxyToProps.has(proxy) && proxyToProps.get(proxy).has(key);
var getPropSignal = (proxy, key, initial) => {
  if (!proxyToProps.has(proxy)) {
    proxyToProps.set(proxy, /* @__PURE__ */ new Map());
  }
  key = typeof key === "number" ? `${key}` : key;
  const props = proxyToProps.get(proxy);
  if (!props.has(key)) {
    const ns = getNamespaceFromProxy(proxy);
    const prop = new PropSignal(proxy);
    props.set(key, prop);
    if (initial) {
      const { get, value } = initial;
      if (get) {
        prop.setGetter(get);
      } else {
        prop.setValue(
          shouldProxy(value) ? proxifyState(ns, value) : value
        );
      }
    }
  }
  return props.get(key);
};
var objToIterable = /* @__PURE__ */ new WeakMap();
var peeking = false;
var PENDING_GETTER = Symbol("PENDING_GETTER");
var stateHandlers = {
  get(target, key, receiver) {
    if (peeking || !target.hasOwnProperty(key) && key in target || typeof key === "symbol" && wellKnownSymbols.has(key)) {
      return Reflect.get(target, key, receiver);
    }
    const desc = Object.getOwnPropertyDescriptor(target, key);
    const prop = getPropSignal(receiver, key, desc);
    const result = prop.getComputed().value;
    if (result === PENDING_GETTER) {
      throw PENDING_GETTER;
    }
    if (typeof result === "function") {
      const ns = getNamespaceFromProxy(receiver);
      return (...args) => {
        setNamespace(ns);
        try {
          return result.call(receiver, ...args);
        } finally {
          resetNamespace();
        }
      };
    }
    return result;
  },
  set(target, key, value, receiver) {
    setNamespace(getNamespaceFromProxy(receiver));
    try {
      return Reflect.set(target, key, value, receiver);
    } finally {
      resetNamespace();
    }
  },
  defineProperty(target, key, desc) {
    const isNew = !(key in target);
    const result = Reflect.defineProperty(target, key, desc);
    if (result) {
      const receiver = getProxyFromObject(target);
      const prop = getPropSignal(receiver, key);
      const { get, value } = desc;
      if (get) {
        prop.setGetter(get);
      } else {
        const ns = getNamespaceFromProxy(receiver);
        prop.setValue(
          shouldProxy(value) ? proxifyState(ns, value) : value
        );
      }
      if (isNew && objToIterable.has(target)) {
        objToIterable.get(target).value++;
      }
      if (Array.isArray(target) && proxyToProps.get(receiver)?.has("length")) {
        const length = getPropSignal(receiver, "length");
        length.setValue(target.length);
      }
    }
    return result;
  },
  deleteProperty(target, key) {
    const result = Reflect.deleteProperty(target, key);
    if (result) {
      const prop = getPropSignal(getProxyFromObject(target), key);
      prop.setValue(void 0);
      if (objToIterable.has(target)) {
        objToIterable.get(target).value++;
      }
    }
    return result;
  },
  ownKeys(target) {
    if (!objToIterable.has(target)) {
      objToIterable.set(target, d3(0));
    }
    objToIterable._ = objToIterable.get(target).value;
    return Reflect.ownKeys(target);
  }
};
var proxifyState = (namespace, obj) => {
  return createProxy(namespace, obj, stateHandlers);
};
var peek = (obj, key) => {
  peeking = true;
  try {
    return obj[key];
  } finally {
    peeking = false;
  }
};
var deepMergeRecursive = (target, source, override = true) => {
  if (!(isPlainObject(target) && isPlainObject(source))) {
    return;
  }
  let hasNewKeys = false;
  for (const key in source) {
    const isNew = !(key in target);
    hasNewKeys = hasNewKeys || isNew;
    const desc = Object.getOwnPropertyDescriptor(source, key);
    const proxy = getProxyFromObject(target);
    const propSignal = !!proxy && hasPropSignal(proxy, key) && getPropSignal(proxy, key);
    if (typeof desc.get === "function" || typeof desc.set === "function") {
      if (override || isNew) {
        Object.defineProperty(target, key, {
          ...desc,
          configurable: true,
          enumerable: true
        });
        if (desc.get && propSignal) {
          propSignal.setPendingGetter(desc.get);
        }
      }
    } else if (isPlainObject(source[key])) {
      const targetValue = Object.getOwnPropertyDescriptor(target, key)?.value;
      if (isNew || override && !isPlainObject(targetValue)) {
        target[key] = {};
        if (propSignal) {
          const ns = getNamespaceFromProxy(proxy);
          propSignal.setValue(
            proxifyState(ns, target[key])
          );
        }
        deepMergeRecursive(target[key], source[key], override);
      } else if (isPlainObject(targetValue)) {
        deepMergeRecursive(target[key], source[key], override);
      }
    } else if (override || isNew) {
      Object.defineProperty(target, key, desc);
      if (propSignal) {
        const { value } = desc;
        const ns = getNamespaceFromProxy(proxy);
        propSignal.setValue(
          shouldProxy(value) ? proxifyState(ns, value) : value
        );
      }
    }
  }
  if (hasNewKeys && objToIterable.has(target)) {
    objToIterable.get(target).value++;
  }
};
var deepMerge = (target, source, override = true) => r3(
  () => deepMergeRecursive(
    getObjectFromProxy(target) || target,
    source,
    override
  )
);

// packages/interactivity/build-module/proxies/store.js
var storeRoots = /* @__PURE__ */ new WeakSet();
var storeHandlers = {
  get: (target, key, receiver) => {
    const result = Reflect.get(target, key);
    const ns = getNamespaceFromProxy(receiver);
    if (typeof result === "undefined" && storeRoots.has(receiver)) {
      const obj = {};
      Reflect.set(target, key, obj);
      return proxifyStore(ns, obj, false);
    }
    if (typeof result === "function") {
      setNamespace(ns);
      const scoped = withScope(result);
      resetNamespace();
      return scoped;
    }
    if (isPlainObject(result) && shouldProxy(result)) {
      return proxifyStore(ns, result, false);
    }
    return result;
  }
};
var proxifyStore = (namespace, obj, isRoot = true) => {
  const proxy = createProxy(namespace, obj, storeHandlers);
  if (proxy && isRoot) {
    storeRoots.add(proxy);
  }
  return proxy;
};

// packages/interactivity/build-module/proxies/context.js
var contextObjectToProxy = /* @__PURE__ */ new WeakMap();
var contextObjectToFallback = /* @__PURE__ */ new WeakMap();
var contextProxies = /* @__PURE__ */ new WeakSet();
var descriptor = Reflect.getOwnPropertyDescriptor;
var contextHandlers = {
  get: (target, key) => {
    const fallback = contextObjectToFallback.get(target);
    const currentProp = target[key];
    return key in target ? currentProp : fallback[key];
  },
  set: (target, key, value) => {
    const fallback = contextObjectToFallback.get(target);
    const obj = key in target || !(key in fallback) ? target : fallback;
    obj[key] = value;
    return true;
  },
  ownKeys: (target) => [
    .../* @__PURE__ */ new Set([
      ...Object.keys(contextObjectToFallback.get(target)),
      ...Object.keys(target)
    ])
  ],
  getOwnPropertyDescriptor: (target, key) => descriptor(target, key) || descriptor(contextObjectToFallback.get(target), key),
  has: (target, key) => Reflect.has(target, key) || Reflect.has(contextObjectToFallback.get(target), key)
};
var proxifyContext = (current, inherited = {}) => {
  if (contextProxies.has(current)) {
    throw Error("This object cannot be proxified.");
  }
  contextObjectToFallback.set(current, inherited);
  if (!contextObjectToProxy.has(current)) {
    const proxy = new Proxy(current, contextHandlers);
    contextObjectToProxy.set(current, proxy);
    contextProxies.add(proxy);
  }
  return contextObjectToProxy.get(current);
};

// packages/interactivity/build-module/store.js
var stores = /* @__PURE__ */ new Map();
var rawStores = /* @__PURE__ */ new Map();
var storeLocks = /* @__PURE__ */ new Map();
var storeConfigs = /* @__PURE__ */ new Map();
var serverStates = /* @__PURE__ */ new Map();
var getConfig = (namespace) => storeConfigs.get(namespace || getNamespace()) || {};
function getServerState(namespace) {
  const ns = namespace || getNamespace();
  if (!serverStates.has(ns)) {
    serverStates.set(ns, {});
  }
  getServerState.subscribe = navigationSignal.value;
  return deepClone(serverStates.get(ns));
}
getServerState.subscribe = 0;
var universalUnlock = "I acknowledge that using a private store means my plugin will inevitably break on the next store release.";
function store(namespace, { state = {}, ...block } = {}, { lock = false } = {}) {
  if (!stores.has(namespace)) {
    if (lock !== universalUnlock) {
      storeLocks.set(namespace, lock);
    }
    const rawStore = {
      state: proxifyState(
        namespace,
        isPlainObject(state) ? state : {}
      ),
      ...block
    };
    const proxifiedStore = proxifyStore(namespace, rawStore);
    rawStores.set(namespace, rawStore);
    stores.set(namespace, proxifiedStore);
  } else {
    if (lock !== universalUnlock && !storeLocks.has(namespace)) {
      storeLocks.set(namespace, lock);
    } else {
      const storeLock = storeLocks.get(namespace);
      const isLockValid = lock === universalUnlock || lock !== true && lock === storeLock;
      if (!isLockValid) {
        if (!storeLock) {
          throw Error("Cannot lock a public store");
        } else {
          throw Error(
            "Cannot unlock a private store with an invalid lock code"
          );
        }
      }
    }
    const target = rawStores.get(namespace);
    deepMerge(target, block);
    deepMerge(target.state, state);
  }
  return stores.get(namespace);
}
var parseServerData = (dom = document) => {
  const jsonDataScriptTag = (
    // Preferred Script Module data passing form
    dom.getElementById(
      "wp-script-module-data-@wordpress/interactivity"
    ) ?? // Legacy form
    dom.getElementById("wp-interactivity-data")
  );
  if (jsonDataScriptTag?.textContent) {
    try {
      return JSON.parse(jsonDataScriptTag.textContent);
    } catch {
    }
  }
  return {};
};
var populateServerData = (data2) => {
  serverStates.clear();
  storeConfigs.clear();
  if (isPlainObject(data2?.state)) {
    Object.entries(data2.state).forEach(([namespace, state]) => {
      const st = store(namespace, {}, { lock: universalUnlock });
      deepMerge(st.state, state, false);
      serverStates.set(namespace, state);
    });
  }
  if (isPlainObject(data2?.config)) {
    Object.entries(data2.config).forEach(([namespace, config]) => {
      storeConfigs.set(namespace, config);
    });
  }
  if (isPlainObject(data2?.derivedStateClosures)) {
    Object.entries(data2.derivedStateClosures).forEach(
      ([namespace, paths]) => {
        const st = store(
          namespace,
          {},
          { lock: universalUnlock }
        );
        paths.forEach((path) => {
          const pathParts = path.split(".");
          const prop = pathParts.splice(-1, 1)[0];
          const parent = pathParts.reduce(
            (prev, key) => peek(prev, key),
            st
          );
          const desc = Object.getOwnPropertyDescriptor(
            parent,
            prop
          );
          if (isPlainObject(desc?.value)) {
            parent[prop] = PENDING_GETTER;
          }
        });
      }
    );
  }
};
var data = parseServerData();
populateServerData(data);

// packages/interactivity/build-module/hooks.js
function isNonDefaultDirectiveSuffix(entry) {
  return entry.suffix !== null;
}
function isDefaultDirectiveSuffix(entry) {
  return entry.suffix === null;
}
var context = G({ client: {}, server: {} });
var directiveCallbacks = {};
var directivePriorities = {};
var directive = (name, callback, { priority = 10 } = {}) => {
  directiveCallbacks[name] = callback;
  directivePriorities[name] = priority;
};
var resolve = (path, namespace) => {
  if (!namespace) {
    warn(
      `Namespace missing for "${path}". The value for that path won't be resolved.`
    );
    return;
  }
  let resolvedStore = stores.get(namespace);
  if (typeof resolvedStore === "undefined") {
    resolvedStore = store(
      namespace,
      {},
      {
        lock: universalUnlock
      }
    );
  }
  const current = {
    ...resolvedStore,
    context: getScope().context[namespace]
  };
  try {
    const pathParts = path.split(".");
    return pathParts.reduce((acc, key) => acc[key], current);
  } catch (e4) {
    if (e4 === PENDING_GETTER) {
      return PENDING_GETTER;
    }
  }
};
var getEvaluate = ({ scope }) => (
  // TODO: When removing the temporarily remaining `value( ...args )` call below, remove the `...args` parameter too.
  ((entry, ...args) => {
    let { value: path, namespace } = entry;
    if (typeof path !== "string") {
      throw new Error("The `value` prop should be a string path");
    }
    const hasNegationOperator = path[0] === "!" && !!(path = path.slice(1));
    setScope(scope);
    const value = resolve(path, namespace);
    if (typeof value === "function") {
      if (hasNegationOperator) {
        warn(
          "Using a function with a negation operator is deprecated and will stop working in Retraceur 6.9. Please use derived state instead."
        );
        const functionResult = !value(...args);
        resetScope();
        return functionResult;
      }
      resetScope();
      const wrappedFunction = (...functionArgs) => {
        setScope(scope);
        const functionResult = value(...functionArgs);
        resetScope();
        return functionResult;
      };
      if (value.sync) {
        const syncAwareFunction = wrappedFunction;
        syncAwareFunction.sync = true;
      }
      return wrappedFunction;
    }
    const result = value;
    resetScope();
    return hasNegationOperator && value !== PENDING_GETTER ? !result : result;
  })
);
var getPriorityLevels = (directives) => {
  const byPriority = Object.keys(directives).reduce((obj, name) => {
    if (directiveCallbacks[name]) {
      const priority = directivePriorities[name];
      (obj[priority] = obj[priority] || []).push(name);
    }
    return obj;
  }, {});
  return Object.entries(byPriority).sort(([p1], [p22]) => parseInt(p1) - parseInt(p22)).map(([, arr]) => arr);
};
var Directives = ({
  directives,
  priorityLevels: [currentPriorityLevel, ...nextPriorityLevels],
  element,
  originalProps,
  previousScope
}) => {
  const scope = A2({}).current;
  scope.evaluate = q2(getEvaluate({ scope }), []);
  const { client, server } = x2(context);
  scope.context = client;
  scope.serverContext = server;
  scope.ref = previousScope?.ref || A2(null);
  element = E(element, { ref: scope.ref });
  scope.attributes = element.props;
  const children = nextPriorityLevels.length > 0 ? _(Directives, {
    directives,
    priorityLevels: nextPriorityLevels,
    element,
    originalProps,
    previousScope: scope
  }) : element;
  const props = { ...originalProps, children };
  const directiveArgs = {
    directives,
    props,
    element,
    context,
    evaluate: scope.evaluate
  };
  setScope(scope);
  for (const directiveName of currentPriorityLevel) {
    const wrapper = directiveCallbacks[directiveName]?.(directiveArgs);
    if (wrapper !== void 0) {
      props.children = wrapper;
    }
  }
  resetScope();
  return props.children;
};
var old = l.vnode;
l.vnode = (vnode) => {
  if (vnode.props.__directives) {
    const props = vnode.props;
    const directives = props.__directives;
    if (directives.key) {
      vnode.key = directives.key.find(isDefaultDirectiveSuffix).value;
    }
    delete props.__directives;
    const priorityLevels = getPriorityLevels(directives);
    if (priorityLevels.length > 0) {
      vnode.props = {
        directives,
        priorityLevels,
        originalProps: props,
        type: vnode.type,
        element: _(vnode.type, props),
        top: true
      };
      vnode.type = Directives;
    }
  }
  if (old) {
    old(vnode);
  }
};

// packages/interactivity/build-module/directives.js
function wrapEventAsync(event) {
  const handler = {
    get(target, prop, receiver) {
      const value = target[prop];
      switch (prop) {
        case "currentTarget":
          if (false) {
            warn(
              `Accessing the synchronous event.${prop} property in a store action without wrapping it in withSyncEvent() is deprecated and will stop working in Retraceur 4.0. Please wrap the store action in withSyncEvent().`
            );
          }
          break;
        case "preventDefault":
        case "stopImmediatePropagation":
        case "stopPropagation":
          if (false) {
            warn(
              `Using the synchronous event.${prop}() function in a store action without wrapping it in withSyncEvent() is deprecated and will stop working in Retraceur 4.0. Please wrap the store action in withSyncEvent().`
            );
          }
          break;
      }
      if (value instanceof Function) {
        return function(...args) {
          return value.apply(
            this === receiver ? target : this,
            args
          );
        };
      }
      return value;
    }
  };
  return new Proxy(event, handler);
}
var newRule = /(?:([\u0080-\uFFFF\w-%@]+) *:? *([^{;]+?);|([^;}{]*?) *{)|(}\s*)/g;
var ruleClean = /\/\*[^]*?\*\/|  +/g;
var ruleNewline = /\n+/g;
var empty = " ";
var cssStringToObject = (val) => {
  const tree = [{}];
  let block, left;
  while (block = newRule.exec(val.replace(ruleClean, ""))) {
    if (block[4]) {
      tree.shift();
    } else if (block[3]) {
      left = block[3].replace(ruleNewline, empty).trim();
      tree.unshift(tree[0][left] = tree[0][left] || {});
    } else {
      tree[0][block[1]] = block[2].replace(ruleNewline, empty).trim();
    }
  }
  return tree[0];
};
var getGlobalEventDirective = (type) => {
  return ({ directives, evaluate }) => {
    directives[`on-${type}`].filter(isNonDefaultDirectiveSuffix).forEach((entry) => {
      const suffixParts = entry.suffix.split("--", 2);
      const eventName = suffixParts[0];
      if (false) {
        if (suffixParts[1]) {
          warnUniqueIdWithTwoHyphens(
            `on-${type}`,
            suffixParts[0],
            suffixParts[1]
          );
        }
      }
      useInit(() => {
        const cb = (event) => {
          const result = evaluate(entry);
          if (typeof result === "function") {
            if (!result?.sync) {
              event = wrapEventAsync(event);
            }
            result(event);
          }
        };
        const globalVar = type === "window" ? window : document;
        globalVar.addEventListener(eventName, cb);
        return () => globalVar.removeEventListener(eventName, cb);
      });
    });
  };
};
var evaluateItemKey = (inheritedValue, namespace, item, itemProp, eachKey) => {
  const clientContextWithItem = {
    ...inheritedValue.client,
    [namespace]: {
      ...inheritedValue.client[namespace],
      [itemProp]: item
    }
  };
  const scope = {
    ...getScope(),
    context: clientContextWithItem,
    serverContext: inheritedValue.server
  };
  return eachKey ? getEvaluate({ scope })(eachKey) : item;
};
var useItemContexts = function* (inheritedValue, namespace, items, itemProp, eachKey) {
  const { current: itemContexts } = A2(/* @__PURE__ */ new Map());
  for (const item of items) {
    const key = evaluateItemKey(
      inheritedValue,
      namespace,
      item,
      itemProp,
      eachKey
    );
    if (!itemContexts.has(key)) {
      itemContexts.set(
        key,
        proxifyContext(
          proxifyState(namespace, {
            // Inits the item prop in the context to shadow it in case
            // it was inherited from the parent context. The actual
            // value is set in the `wp-each` directive later on.
            [itemProp]: void 0
          }),
          inheritedValue.client[namespace]
        )
      );
    }
    yield [item, itemContexts.get(key), key];
  }
};
var getGlobalAsyncEventDirective = (type) => {
  return ({ directives, evaluate }) => {
    directives[`on-async-${type}`].filter(isNonDefaultDirectiveSuffix).forEach((entry) => {
      if (false) {
        warnWithSyncEvent(`on-async-${type}`, `on-${type}`);
      }
      const eventName = entry.suffix.split("--", 1)[0];
      useInit(() => {
        const cb = async (event) => {
          await splitTask();
          const result = evaluate(entry);
          if (typeof result === "function") {
            result(event);
          }
        };
        const globalVar = type === "window" ? window : document;
        globalVar.addEventListener(eventName, cb, {
          passive: true
        });
        return () => globalVar.removeEventListener(eventName, cb);
      });
    });
  };
};
var routerRegions = /* @__PURE__ */ new Map();
var directives_default = () => {
  directive(
    "context",
    ({
      directives: { context: context2 },
      props: { children },
      context: inheritedContext
    }) => {
      const entries = context2.filter(isDefaultDirectiveSuffix).reverse();
      if (!entries.length) {
        if (false) {
          warn(
            "The usage of data-wp-context--unique-id (two hyphens) is not supported. To add a unique ID to the directive, please use data-wp-context---unique-id (three hyphens) instead."
          );
        }
        return;
      }
      const { Provider } = inheritedContext;
      const { client: inheritedClient, server: inheritedServer } = x2(inheritedContext);
      const client = A2({});
      const server = {};
      const result = {
        client: { ...inheritedClient },
        server: { ...inheritedServer }
      };
      const namespaces2 = /* @__PURE__ */ new Set();
      entries.forEach(({ value, namespace, uniqueId }) => {
        if (!isPlainObject(value)) {
          if (false) {
            warn(
              `The value of data-wp-context${uniqueId ? `---${uniqueId}` : ""} on the ${namespace} namespace must be a valid stringified JSON object.`
            );
          }
          return;
        }
        if (!client.current[namespace]) {
          client.current[namespace] = proxifyState(namespace, {});
        }
        deepMerge(
          client.current[namespace],
          deepClone(value),
          false
        );
        server[namespace] = value;
        namespaces2.add(namespace);
      });
      namespaces2.forEach((namespace) => {
        result.client[namespace] = proxifyContext(
          client.current[namespace],
          inheritedClient[namespace]
        );
        result.server[namespace] = proxifyContext(
          server[namespace],
          inheritedServer[namespace]
        );
      });
      return _(Provider, { value: result }, children);
    },
    { priority: 5 }
  );
  directive("watch", ({ directives: { watch }, evaluate }) => {
    watch.forEach((entry) => {
      if (false) {
        if (entry.suffix) {
          warnUniqueIdWithTwoHyphens("watch", entry.suffix);
        }
      }
      useWatch(() => {
        let start;
        if (true) {
          if (false) {
            start = performance.now();
          }
        }
        let result = evaluate(entry);
        if (typeof result === "function") {
          result = result();
        }
        if (true) {
          if (false) {
            performance.measure(
              `interactivity api watch ${entry.namespace}`,
              {
                start,
                end: performance.now(),
                detail: {
                  devtools: {
                    track: `IA: watch ${entry.namespace}`
                  }
                }
              }
            );
          }
        }
        return result;
      });
    });
  });
  directive("init", ({ directives: { init: init2 }, evaluate }) => {
    init2.forEach((entry) => {
      if (false) {
        if (entry.suffix) {
          warnUniqueIdWithTwoHyphens("init", entry.suffix);
        }
      }
      useInit(() => {
        let start;
        if (true) {
          if (false) {
            start = performance.now();
          }
        }
        let result = evaluate(entry);
        if (typeof result === "function") {
          result = result();
        }
        if (true) {
          if (false) {
            performance.measure(
              `interactivity api init ${entry.namespace}`,
              {
                // eslint-disable-next-line no-undef
                start,
                end: performance.now(),
                detail: {
                  devtools: {
                    track: `IA: init ${entry.namespace}`
                  }
                }
              }
            );
          }
        }
        return result;
      });
    });
  });
  directive("on", ({ directives: { on }, element, evaluate }) => {
    const events = /* @__PURE__ */ new Map();
    on.filter(isNonDefaultDirectiveSuffix).forEach((entry) => {
      const suffixParts = entry.suffix.split("--", 2);
      if (false) {
        if (suffixParts[1]) {
          warnUniqueIdWithTwoHyphens(
            "on",
            suffixParts[0],
            suffixParts[1]
          );
        }
      }
      if (!events.has(suffixParts[0])) {
        events.set(suffixParts[0], /* @__PURE__ */ new Set());
      }
      events.get(suffixParts[0]).add(entry);
    });
    events.forEach((entries, eventType) => {
      const existingHandler = element.props[`on${eventType}`];
      element.props[`on${eventType}`] = (event) => {
        if (existingHandler) {
          existingHandler(event);
        }
        entries.forEach((entry) => {
          let start;
          if (true) {
            if (false) {
              start = performance.now();
            }
          }
          const result = evaluate(entry);
          if (typeof result === "function") {
            if (!result?.sync) {
              event = wrapEventAsync(event);
            }
            result(event);
          }
          if (true) {
            if (false) {
              performance.measure(
                `interactivity api on ${entry.namespace}`,
                {
                  // eslint-disable-next-line no-undef
                  start,
                  end: performance.now(),
                  detail: {
                    devtools: {
                      track: `IA: on ${entry.namespace}`
                    }
                  }
                }
              );
            }
          }
        });
      };
    });
  });
  directive(
    "on-async",
    ({ directives: { "on-async": onAsync }, element, evaluate }) => {
      if (false) {
        warnWithSyncEvent("on-async", "on");
      }
      const events = /* @__PURE__ */ new Map();
      onAsync.filter(isNonDefaultDirectiveSuffix).forEach((entry) => {
        const event = entry.suffix.split("--", 1)[0];
        if (!events.has(event)) {
          events.set(event, /* @__PURE__ */ new Set());
        }
        events.get(event).add(entry);
      });
      events.forEach((entries, eventType) => {
        const existingHandler = element.props[`on${eventType}`];
        element.props[`on${eventType}`] = (event) => {
          if (existingHandler) {
            existingHandler(event);
          }
          entries.forEach(async (entry) => {
            await splitTask();
            const result = evaluate(entry);
            if (typeof result === "function") {
              result(event);
            }
          });
        };
      });
    }
  );
  directive("on-window", getGlobalEventDirective("window"));
  directive("on-document", getGlobalEventDirective("document"));
  directive("on-async-window", getGlobalAsyncEventDirective("window"));
  directive(
    "on-async-document",
    getGlobalAsyncEventDirective("document")
  );
  directive(
    "class",
    ({ directives: { class: classNames }, element, evaluate }) => {
      classNames.filter(isNonDefaultDirectiveSuffix).forEach((entry) => {
        const className = entry.uniqueId ? `${entry.suffix}---${entry.uniqueId}` : entry.suffix;
        let result = evaluate(entry);
        if (result === PENDING_GETTER) {
          return;
        }
        if (typeof result === "function") {
          result = result();
        }
        const currentClass = element.props.class || "";
        const classFinder = new RegExp(
          `(^|\\s)${className}(\\s|$)`,
          "g"
        );
        if (!result) {
          element.props.class = currentClass.replace(classFinder, " ").trim();
        } else if (!classFinder.test(currentClass)) {
          element.props.class = currentClass ? `${currentClass} ${className}` : className;
        }
        useInit(() => {
          if (!result) {
            element.ref.current.classList.remove(className);
          } else {
            element.ref.current.classList.add(className);
          }
        });
      });
    }
  );
  directive("style", ({ directives: { style }, element, evaluate }) => {
    style.filter(isNonDefaultDirectiveSuffix).forEach((entry) => {
      if (entry.uniqueId) {
        if (false) {
          warnUniqueIdNotSupported("style", entry.uniqueId);
        }
        return;
      }
      const styleProp = entry.suffix;
      let result = evaluate(entry);
      if (result === PENDING_GETTER) {
        return;
      }
      if (typeof result === "function") {
        result = result();
      }
      element.props.style = element.props.style || {};
      if (typeof element.props.style === "string") {
        element.props.style = cssStringToObject(element.props.style);
      }
      if (!result) {
        delete element.props.style[styleProp];
      } else {
        element.props.style[styleProp] = result;
      }
      useInit(() => {
        if (!result) {
          element.ref.current.style.removeProperty(styleProp);
        } else {
          element.ref.current.style.setProperty(styleProp, result);
        }
      });
    });
  });
  directive("bind", ({ directives: { bind }, element, evaluate }) => {
    bind.filter(isNonDefaultDirectiveSuffix).forEach((entry) => {
      if (entry.uniqueId) {
        if (false) {
          warnUniqueIdNotSupported("bind", entry.uniqueId);
        }
        return;
      }
      const attribute = entry.suffix;
      let result = evaluate(entry);
      if (result === PENDING_GETTER) {
        return;
      }
      if (typeof result === "function") {
        result = result();
      }
      element.props[attribute] = result;
      useInit(() => {
        const el = element.ref.current;
        if (attribute === "style") {
          if (typeof result === "string") {
            el.style.cssText = result;
          }
          return;
        } else if (attribute !== "width" && attribute !== "height" && attribute !== "href" && attribute !== "list" && attribute !== "form" && /*
        * The value for `tabindex` follows the parsing rules for an
        * integer. If that fails, or if the attribute isn't present, then
        * the browsers should "follow platform conventions to determine if
        * the element should be considered as a focusable area",
        * practically meaning that most elements get a default of `-1` (not
        * focusable), but several also get a default of `0` (focusable in
        * order after all elements with a positive `tabindex` value).
        *
        * @see https://html.spec.whatwg.org/#tabindex-value
        */
        attribute !== "tabIndex" && attribute !== "download" && attribute !== "rowSpan" && attribute !== "colSpan" && attribute !== "role" && attribute in el) {
          try {
            el[attribute] = result === null || result === void 0 ? "" : result;
            return;
          } catch (err) {
          }
        }
        if (result !== null && result !== void 0 && (result !== false || attribute[4] === "-")) {
          el.setAttribute(attribute, result);
        } else {
          el.removeAttribute(attribute);
        }
      });
    });
  });
  directive(
    "ignore",
    ({
      element: {
        type: Type,
        props: { innerHTML, ...rest }
      }
    }) => {
      if (false) {
        warn(
          "The data-wp-ignore directive is deprecated and will be removed in version 7.0."
        );
      }
      const cached = T2(() => innerHTML, []);
      return _(Type, {
        dangerouslySetInnerHTML: { __html: cached },
        ...rest
      });
    }
  );
  directive("text", ({ directives: { text }, element, evaluate }) => {
    const entries = text.filter(isDefaultDirectiveSuffix);
    if (!entries.length) {
      if (false) {
        warn(
          "The usage of data-wp-text--suffix is not supported. Please use data-wp-text instead."
        );
      }
      return;
    }
    entries.forEach((entry) => {
      if (entry.uniqueId) {
        if (false) {
          warnUniqueIdNotSupported("text", entry.uniqueId);
        }
        return;
      }
      try {
        let result = evaluate(entry);
        if (result === PENDING_GETTER) {
          return;
        }
        if (typeof result === "function") {
          result = result();
        }
        element.props.children = typeof result === "object" ? null : result.toString();
      } catch (e4) {
        element.props.children = null;
      }
    });
  });
  directive("run", ({ directives: { run }, evaluate }) => {
    run.forEach((entry) => {
      if (false) {
        if (entry.suffix) {
          warnUniqueIdWithTwoHyphens("run", entry.suffix);
        }
      }
      let result = evaluate(entry);
      if (typeof result === "function") {
        result = result();
      }
      return result;
    });
  });
  directive(
    "each",
    ({
      directives: { each, "each-key": eachKey },
      context: inheritedContext,
      element,
      evaluate
    }) => {
      if (element.type !== "template") {
        if (false) {
          warn(
            "The data-wp-each directive can only be used on <template> elements."
          );
        }
        return;
      }
      const { Provider } = inheritedContext;
      const inheritedValue = x2(inheritedContext);
      const [entry] = each;
      const { namespace, suffix, uniqueId } = entry;
      if (each.length > 1) {
        if (false) {
          warn(
            "The usage of multiple data-wp-each directives on the same element is not supported. Please pick only one."
          );
        }
        return;
      }
      if (uniqueId) {
        if (false) {
          warnUniqueIdNotSupported("each", uniqueId);
        }
        return;
      }
      let iterable = evaluate(entry);
      if (iterable === PENDING_GETTER) {
        return;
      }
      if (typeof iterable === "function") {
        iterable = iterable();
      }
      if (typeof iterable?.[Symbol.iterator] !== "function") {
        return;
      }
      const itemProp = suffix ? kebabToCamelCase(suffix) : "item";
      const result = [];
      const itemContexts = useItemContexts(
        inheritedValue,
        namespace,
        iterable,
        itemProp,
        eachKey?.[0]
      );
      for (const [item, itemContext, key] of itemContexts) {
        const mergedContext = {
          client: {
            ...inheritedValue.client,
            [namespace]: itemContext
          },
          server: { ...inheritedValue.server }
        };
        mergedContext.client[namespace][itemProp] = item;
        result.push(
          _(
            Provider,
            { value: mergedContext, key },
            element.props.content
          )
        );
      }
      return result;
    },
    { priority: 20 }
  );
  directive(
    "each-child",
    ({ directives: { "each-child": eachChild }, element, evaluate }) => {
      const entry = eachChild.find(isDefaultDirectiveSuffix);
      if (!entry) {
        return;
      }
      const iterable = evaluate(entry);
      return iterable === PENDING_GETTER ? element : null;
    },
    { priority: 1 }
  );
  directive(
    "router-region",
    ({ directives: { "router-region": routerRegion } }) => {
      const entry = routerRegion.find(isDefaultDirectiveSuffix);
      if (!entry) {
        return;
      }
      if (entry.suffix) {
        if (false) {
          warn(
            `Suffixes for the data-wp-router-region directive are not supported. Ignoring the directive with suffix "${entry.suffix}".`
          );
        }
        return;
      }
      if (entry.uniqueId) {
        if (false) {
          warnUniqueIdNotSupported("router-region", entry.uniqueId);
        }
        return;
      }
      const regionId = typeof entry.value === "string" ? entry.value : entry.value.id;
      if (!routerRegions.has(regionId)) {
        routerRegions.set(regionId, d3());
      }
      const vdom = routerRegions.get(regionId).value;
      _2(() => {
        if (vdom && typeof vdom.type !== "string") {
          navigationContextSignal.value = navigationContextSignal.peek() + 1;
        }
      }, [vdom]);
      if (vdom && typeof vdom.type !== "string") {
        const previousScope = getScope();
        return E(vdom, { previousScope });
      }
      return vdom;
    },
    { priority: 1 }
  );
};

// packages/interactivity/build-module/vdom.js
var directivePrefix = `data-wp-`;
var namespaces = [];
var currentNamespace = () => namespaces[namespaces.length - 1] ?? null;
var isObject = (item) => Boolean(item && typeof item === "object" && item.constructor === Object);
var invalidCharsRegex = /[^a-z0-9-_]/i;
function parseDirectiveName(directiveName) {
  const name = directiveName.substring(8);
  if (invalidCharsRegex.test(name)) {
    return null;
  }
  const suffixIndex = name.indexOf("--");
  if (suffixIndex === -1) {
    return { prefix: name, suffix: null, uniqueId: null };
  }
  const prefix = name.substring(0, suffixIndex);
  const remaining = name.substring(suffixIndex);
  if (remaining.startsWith("---") && remaining[3] !== "-") {
    return {
      prefix,
      suffix: null,
      uniqueId: remaining.substring(3) || null
    };
  }
  let suffix = remaining.substring(2);
  const uniqueIdIndex = suffix.indexOf("---");
  if (uniqueIdIndex !== -1 && suffix.substring(uniqueIdIndex)[3] !== "-") {
    const uniqueId = suffix.substring(uniqueIdIndex + 3) || null;
    suffix = suffix.substring(0, uniqueIdIndex) || null;
    return { prefix, suffix, uniqueId };
  }
  return { prefix, suffix: suffix || null, uniqueId: null };
}
var nsPathRegExp = /^([\w_\/-]+)::(.+)$/;
var hydratedIslands = /* @__PURE__ */ new WeakSet();
function toVdom(root) {
  const nodesToRemove = /* @__PURE__ */ new Set();
  const nodesToReplace = /* @__PURE__ */ new Set();
  const treeWalker = document.createTreeWalker(
    root,
    205
    // TEXT + CDATA_SECTION + COMMENT + PROCESSING_INSTRUCTION + ELEMENT
  );
  function walk(node) {
    const { nodeType } = node;
    if (nodeType === 3) {
      return node.data;
    }
    if (nodeType === 4) {
      nodesToReplace.add(node);
      return node.nodeValue;
    }
    if (nodeType === 8 || nodeType === 7) {
      nodesToRemove.add(node);
      return null;
    }
    const elementNode = node;
    const { attributes } = elementNode;
    const localName = elementNode.localName;
    const props = {};
    const children = [];
    const directives = [];
    let ignore = false;
    let island = false;
    for (let i4 = 0; i4 < attributes.length; i4++) {
      const attributeName = attributes[i4].name;
      const attributeValue = attributes[i4].value;
      if (attributeName[directivePrefix.length] && attributeName.slice(0, directivePrefix.length) === directivePrefix) {
        if (attributeName === "data-wp-ignore") {
          ignore = true;
        } else {
          const regexResult = nsPathRegExp.exec(attributeValue);
          const namespace = regexResult?.[1] ?? null;
          let value = regexResult?.[2] ?? attributeValue;
          try {
            const parsedValue = JSON.parse(value);
            value = isObject(parsedValue) ? parsedValue : value;
          } catch {
          }
          if (attributeName === "data-wp-interactive") {
            island = true;
            const islandNamespace = (
              // eslint-disable-next-line no-nested-ternary
              typeof value === "string" ? value : typeof value?.namespace === "string" ? value.namespace : null
            );
            namespaces.push(islandNamespace);
          } else {
            directives.push([attributeName, namespace, value]);
          }
        }
      } else if (attributeName === "ref") {
        continue;
      }
      props[attributeName] = attributeValue;
    }
    if (ignore && !island) {
      return [
        _(localName, {
          ...props,
          innerHTML: elementNode.innerHTML,
          __directives: { ignore: true }
        })
      ];
    }
    if (island) {
      hydratedIslands.add(elementNode);
    }
    if (directives.length) {
      props.__directives = directives.reduce((obj, [name, ns, value]) => {
        const directiveParsed = parseDirectiveName(name);
        if (directiveParsed === null) {
          if (false) {
            warn(`Found malformed directive name: ${name}.`);
          }
          return obj;
        }
        const { prefix, suffix, uniqueId } = directiveParsed;
        obj[prefix] = obj[prefix] || [];
        obj[prefix].push({
          namespace: ns ?? currentNamespace(),
          value,
          suffix,
          uniqueId
        });
        return obj;
      }, {});
      for (const prefix in props.__directives) {
        props.__directives[prefix].sort(
          (a4, b3) => {
            const aSuffix = a4.suffix ?? "";
            const bSuffix = b3.suffix ?? "";
            if (aSuffix !== bSuffix) {
              return aSuffix < bSuffix ? -1 : 1;
            }
            const aId = a4.uniqueId ?? "";
            const bId = b3.uniqueId ?? "";
            return +(aId > bId) - +(aId < bId);
          }
        );
      }
    }
    if (props.__directives?.["each-child"]) {
      props.dangerouslySetInnerHTML = {
        __html: elementNode.innerHTML
      };
    } else if (localName === "template") {
      props.content = [
        ...elementNode.content.childNodes
      ].map((childNode) => toVdom(childNode));
    } else {
      let child = treeWalker.firstChild();
      if (child) {
        while (child) {
          const vnode = walk(child);
          if (vnode) {
            children.push(vnode);
          }
          child = treeWalker.nextSibling();
        }
        treeWalker.parentNode();
      }
    }
    if (island) {
      namespaces.pop();
    }
    return _(localName, props, children);
  }
  const vdom = walk(treeWalker.currentNode);
  nodesToRemove.forEach(
    (node) => node.remove()
  );
  nodesToReplace.forEach(
    (node) => node.replaceWith(
      new window.Text(node.nodeValue ?? "")
    )
  );
  return vdom;
}

// packages/interactivity/build-module/init.js
var regionRootFragments = /* @__PURE__ */ new WeakMap();
var getRegionRootFragment = (regions) => {
  const region = Array.isArray(regions) ? regions[0] : regions;
  if (!region.parentElement) {
    throw Error("The passed region should be an element with a parent.");
  }
  if (!regionRootFragments.has(region)) {
    regionRootFragments.set(
      region,
      createRootFragment(region.parentElement, regions)
    );
  }
  return regionRootFragments.get(region);
};
var initialVdom = /* @__PURE__ */ new WeakMap();
var init = async () => {
  const nodes = document.querySelectorAll(`[data-wp-interactive]`);
  await new Promise((resolve2) => {
    setTimeout(resolve2, 0);
  });
  for (const node of nodes) {
    if (!hydratedIslands.has(node)) {
      await splitTask();
      const fragment = getRegionRootFragment(node);
      const vdom = toVdom(node);
      initialVdom.set(node, vdom);
      await splitTask();
      D(vdom, fragment);
    }
  }
};

// packages/interactivity/build-module/index.js
var requiredConsent = "I acknowledge that using private APIs means my theme or plugin will inevitably break in the next version of Retraceur.";
var privateApis = (lock) => {
  if (lock === requiredConsent) {
    return {
      getRegionRootFragment,
      initialVdom,
      toVdom,
      directive,
      getNamespace,
      h: _,
      cloneElement: E,
      render: B,
      proxifyState,
      parseServerData,
      populateServerData,
      batch: r3,
      routerRegions,
      deepReadOnly,
      navigationSignal
    };
  }
  throw new Error("Forbidden access.");
};
directives_default();
init();
export {
  getConfig,
  getContext,
  getElement,
  getServerContext,
  getServerState,
  privateApis,
  splitTask,
  store,
  useCallback,
  useEffect,
  useInit,
  useLayoutEffect,
  useMemo,
  A2 as useRef,
  h2 as useState,
  useWatch,
  withScope,
  withSyncEvent
};
//# sourceMappingURL=index.js.map
