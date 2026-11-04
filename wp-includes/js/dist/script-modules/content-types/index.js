var __create = Object.create;
var __defProp = Object.defineProperty;
var __getOwnPropDesc = Object.getOwnPropertyDescriptor;
var __getOwnPropNames = Object.getOwnPropertyNames;
var __getProtoOf = Object.getPrototypeOf;
var __hasOwnProp = Object.prototype.hasOwnProperty;
var __commonJS = (cb, mod) => function __require() {
  return mod || (0, cb[__getOwnPropNames(cb)[0]])((mod = { exports: {} }).exports, mod), mod.exports;
};
var __export = (target, all) => {
  for (var name in all)
    __defProp(target, name, { get: all[name], enumerable: true });
};
var __copyProps = (to, from, except, desc) => {
  if (from && typeof from === "object" || typeof from === "function") {
    for (let key of __getOwnPropNames(from))
      if (!__hasOwnProp.call(to, key) && key !== except)
        __defProp(to, key, { get: () => from[key], enumerable: !(desc = __getOwnPropDesc(from, key)) || desc.enumerable });
  }
  return to;
};
var __toESM = (mod, isNodeMode, target) => (target = mod != null ? __create(__getProtoOf(mod)) : {}, __copyProps(
  // If the importer is in node compatibility mode or this is not an ESM
  // file that has been converted to a CommonJS file using a Babel-
  // compatible transform (i.e. "__esModule" has not been set), then set
  // "default" to the CommonJS "module.exports" for node compatibility.
  isNodeMode || !mod || !mod.__esModule ? __defProp(target, "default", { value: mod, enumerable: true }) : target,
  mod
));

// package-external:@wordpress/i18n
var require_i18n = __commonJS({
  "package-external:@wordpress/i18n"(exports, module) {
    module.exports = window.wp.i18n;
  }
});

// package-external:@wordpress/element
var require_element = __commonJS({
  "package-external:@wordpress/element"(exports, module) {
    module.exports = window.wp.element;
  }
});

// vendor-external:react
var require_react = __commonJS({
  "vendor-external:react"(exports, module) {
    module.exports = window.React;
  }
});

// vendor-external:react/jsx-runtime
var require_jsx_runtime = __commonJS({
  "vendor-external:react/jsx-runtime"(exports, module) {
    module.exports = window.ReactJSXRuntime;
  }
});

// vendor-external:react-dom
var require_react_dom = __commonJS({
  "vendor-external:react-dom"(exports, module) {
    module.exports = window.ReactDOM;
  }
});

// node_modules/use-sync-external-store/cjs/use-sync-external-store-shim.development.js
var require_use_sync_external_store_shim_development = __commonJS({
  "node_modules/use-sync-external-store/cjs/use-sync-external-store-shim.development.js"(exports) {
    "use strict";
    (function() {
      function is(x, y) {
        return x === y && (0 !== x || 1 / x === 1 / y) || x !== x && y !== y;
      }
      function useSyncExternalStore$2(subscribe, getSnapshot) {
        didWarnOld18Alpha || void 0 === React75.startTransition || (didWarnOld18Alpha = true, console.error(
          "You are using an outdated, pre-release alpha of React 18 that does not support useSyncExternalStore. The use-sync-external-store shim will not work correctly. Upgrade to a newer pre-release."
        ));
        var value = getSnapshot();
        if (!didWarnUncachedGetSnapshot) {
          var cachedValue = getSnapshot();
          objectIs(value, cachedValue) || (console.error(
            "The result of getSnapshot should be cached to avoid an infinite loop"
          ), didWarnUncachedGetSnapshot = true);
        }
        cachedValue = useState23({
          inst: { value, getSnapshot }
        });
        var inst = cachedValue[0].inst, forceUpdate = cachedValue[1];
        useLayoutEffect3(
          function() {
            inst.value = value;
            inst.getSnapshot = getSnapshot;
            checkIfSnapshotChanged(inst) && forceUpdate({ inst });
          },
          [subscribe, value, getSnapshot]
        );
        useEffect20(
          function() {
            checkIfSnapshotChanged(inst) && forceUpdate({ inst });
            return subscribe(function() {
              checkIfSnapshotChanged(inst) && forceUpdate({ inst });
            });
          },
          [subscribe]
        );
        useDebugValue2(value);
        return value;
      }
      function checkIfSnapshotChanged(inst) {
        var latestGetSnapshot = inst.getSnapshot;
        inst = inst.value;
        try {
          var nextValue = latestGetSnapshot();
          return !objectIs(inst, nextValue);
        } catch (error2) {
          return true;
        }
      }
      function useSyncExternalStore$1(subscribe, getSnapshot) {
        return getSnapshot();
      }
      "undefined" !== typeof __REACT_DEVTOOLS_GLOBAL_HOOK__ && "function" === typeof __REACT_DEVTOOLS_GLOBAL_HOOK__.registerInternalModuleStart && __REACT_DEVTOOLS_GLOBAL_HOOK__.registerInternalModuleStart(Error());
      var React75 = require_react(), objectIs = "function" === typeof Object.is ? Object.is : is, useState23 = React75.useState, useEffect20 = React75.useEffect, useLayoutEffect3 = React75.useLayoutEffect, useDebugValue2 = React75.useDebugValue, didWarnOld18Alpha = false, didWarnUncachedGetSnapshot = false, shim = "undefined" === typeof window || "undefined" === typeof window.document || "undefined" === typeof window.document.createElement ? useSyncExternalStore$1 : useSyncExternalStore$2;
      exports.useSyncExternalStore = void 0 !== React75.useSyncExternalStore ? React75.useSyncExternalStore : shim;
      "undefined" !== typeof __REACT_DEVTOOLS_GLOBAL_HOOK__ && "function" === typeof __REACT_DEVTOOLS_GLOBAL_HOOK__.registerInternalModuleStop && __REACT_DEVTOOLS_GLOBAL_HOOK__.registerInternalModuleStop(Error());
    })();
  }
});

// node_modules/use-sync-external-store/shim/index.js
var require_shim = __commonJS({
  "node_modules/use-sync-external-store/shim/index.js"(exports, module) {
    "use strict";
    if (false) {
      module.exports = null;
    } else {
      module.exports = require_use_sync_external_store_shim_development();
    }
  }
});

// node_modules/use-sync-external-store/cjs/use-sync-external-store-shim/with-selector.development.js
var require_with_selector_development = __commonJS({
  "node_modules/use-sync-external-store/cjs/use-sync-external-store-shim/with-selector.development.js"(exports) {
    "use strict";
    (function() {
      function is(x, y) {
        return x === y && (0 !== x || 1 / x === 1 / y) || x !== x && y !== y;
      }
      "undefined" !== typeof __REACT_DEVTOOLS_GLOBAL_HOOK__ && "function" === typeof __REACT_DEVTOOLS_GLOBAL_HOOK__.registerInternalModuleStart && __REACT_DEVTOOLS_GLOBAL_HOOK__.registerInternalModuleStart(Error());
      var React75 = require_react(), shim = require_shim(), objectIs = "function" === typeof Object.is ? Object.is : is, useSyncExternalStore2 = shim.useSyncExternalStore, useRef30 = React75.useRef, useEffect20 = React75.useEffect, useMemo36 = React75.useMemo, useDebugValue2 = React75.useDebugValue;
      exports.useSyncExternalStoreWithSelector = function(subscribe, getSnapshot, getServerSnapshot, selector, isEqual) {
        var instRef = useRef30(null);
        if (null === instRef.current) {
          var inst = { hasValue: false, value: null };
          instRef.current = inst;
        } else inst = instRef.current;
        instRef = useMemo36(
          function() {
            function memoizedSelector(nextSnapshot) {
              if (!hasMemo) {
                hasMemo = true;
                memoizedSnapshot = nextSnapshot;
                nextSnapshot = selector(nextSnapshot);
                if (void 0 !== isEqual && inst.hasValue) {
                  var currentSelection = inst.value;
                  if (isEqual(currentSelection, nextSnapshot))
                    return memoizedSelection = currentSelection;
                }
                return memoizedSelection = nextSnapshot;
              }
              currentSelection = memoizedSelection;
              if (objectIs(memoizedSnapshot, nextSnapshot))
                return currentSelection;
              var nextSelection = selector(nextSnapshot);
              if (void 0 !== isEqual && isEqual(currentSelection, nextSelection))
                return memoizedSnapshot = nextSnapshot, currentSelection;
              memoizedSnapshot = nextSnapshot;
              return memoizedSelection = nextSelection;
            }
            var hasMemo = false, memoizedSnapshot, memoizedSelection, maybeGetServerSnapshot = void 0 === getServerSnapshot ? null : getServerSnapshot;
            return [
              function() {
                return memoizedSelector(getSnapshot());
              },
              null === maybeGetServerSnapshot ? void 0 : function() {
                return memoizedSelector(maybeGetServerSnapshot());
              }
            ];
          },
          [getSnapshot, getServerSnapshot, selector, isEqual]
        );
        var value = useSyncExternalStore2(subscribe, instRef[0], instRef[1]);
        useEffect20(
          function() {
            inst.hasValue = true;
            inst.value = value;
          },
          [value]
        );
        useDebugValue2(value);
        return value;
      };
      "undefined" !== typeof __REACT_DEVTOOLS_GLOBAL_HOOK__ && "function" === typeof __REACT_DEVTOOLS_GLOBAL_HOOK__.registerInternalModuleStop && __REACT_DEVTOOLS_GLOBAL_HOOK__.registerInternalModuleStop(Error());
    })();
  }
});

// node_modules/use-sync-external-store/shim/with-selector.js
var require_with_selector = __commonJS({
  "node_modules/use-sync-external-store/shim/with-selector.js"(exports, module) {
    "use strict";
    if (false) {
      module.exports = null;
    } else {
      module.exports = require_with_selector_development();
    }
  }
});

// package-external:@wordpress/primitives
var require_primitives = __commonJS({
  "package-external:@wordpress/primitives"(exports, module) {
    module.exports = window.wp.primitives;
  }
});

// package-external:@wordpress/compose
var require_compose = __commonJS({
  "package-external:@wordpress/compose"(exports, module) {
    module.exports = window.wp.compose;
  }
});

// package-external:@wordpress/theme
var require_theme = __commonJS({
  "package-external:@wordpress/theme"(exports, module) {
    module.exports = window.wp.theme;
  }
});

// package-external:@wordpress/private-apis
var require_private_apis = __commonJS({
  "package-external:@wordpress/private-apis"(exports, module) {
    module.exports = window.wp.privateApis;
  }
});

// package-external:@wordpress/components
var require_components = __commonJS({
  "package-external:@wordpress/components"(exports, module) {
    module.exports = window.wp.components;
  }
});

// package-external:@wordpress/dataviews
var require_dataviews = __commonJS({
  "package-external:@wordpress/dataviews"(exports, module) {
    module.exports = window.wp.dataviews;
  }
});

// package-external:@wordpress/core-data
var require_core_data = __commonJS({
  "package-external:@wordpress/core-data"(exports, module) {
    module.exports = window.wp.coreData;
  }
});

// package-external:@wordpress/data
var require_data = __commonJS({
  "package-external:@wordpress/data"(exports, module) {
    module.exports = window.wp.data;
  }
});

// package-external:@wordpress/preferences
var require_preferences = __commonJS({
  "package-external:@wordpress/preferences"(exports, module) {
    module.exports = window.wp.preferences;
  }
});

// package-external:@wordpress/notices
var require_notices = __commonJS({
  "package-external:@wordpress/notices"(exports, module) {
    module.exports = window.wp.notices;
  }
});

// package-external:@wordpress/is-shallow-equal
var require_is_shallow_equal = __commonJS({
  "package-external:@wordpress/is-shallow-equal"(exports, module) {
    module.exports = window.wp.isShallowEqual;
  }
});

// package-external:@wordpress/url
var require_url = __commonJS({
  "package-external:@wordpress/url"(exports, module) {
    module.exports = window.wp.url;
  }
});

// packages/admin-ui/build-module/breadcrumbs/index.mjs
var import_i18n4 = __toESM(require_i18n(), 1);
import { Link as RouterLink } from "@wordpress/route";

// node_modules/clsx/dist/clsx.mjs
function r(e) {
  var t, f, n = "";
  if ("string" == typeof e || "number" == typeof e) n += e;
  else if ("object" == typeof e) if (Array.isArray(e)) {
    var o = e.length;
    for (t = 0; t < o; t++) e[t] && (f = r(e[t])) && (n && (n += " "), n += f);
  } else for (f in e) e[f] && (n && (n += " "), n += f);
  return n;
}
function clsx() {
  for (var e, t, f = 0, n = "", o = arguments.length; f < o; f++) (e = arguments[f]) && (t = r(e)) && (n && (n += " "), n += t);
  return n;
}
var clsx_default = clsx;

// packages/ui/build-module/badge/badge.mjs
var import_element13 = __toESM(require_element(), 1);

// node_modules/@base-ui/utils/error.mjs
var set;
if (true) {
  set = /* @__PURE__ */ new Set();
}
function error(...messages) {
  if (true) {
    const messageKey = messages.join(" ");
    if (!set.has(messageKey)) {
      set.add(messageKey);
      console.error(`Base UI: ${messageKey}`);
    }
  }
}

// node_modules/@base-ui/utils/safeReact.mjs
var React = __toESM(require_react(), 1);
var SafeReact = {
  ...React
};

// node_modules/@base-ui/utils/useRefWithInit.mjs
var React2 = __toESM(require_react(), 1);
var UNINITIALIZED = {};
function useRefWithInit(init, initArg) {
  const ref = React2.useRef(UNINITIALIZED);
  if (ref.current === UNINITIALIZED) {
    ref.current = init(initArg);
  }
  return ref;
}

// node_modules/@base-ui/utils/useStableCallback.mjs
var useInsertionEffect = SafeReact.useInsertionEffect;
var useSafeInsertionEffect = (
  // React 17 doesn't have useInsertionEffect.
  useInsertionEffect && // Preact replaces useInsertionEffect with useLayoutEffect and fires too late.
  useInsertionEffect !== SafeReact.useLayoutEffect ? useInsertionEffect : (fn) => fn()
);
function useStableCallback(callback) {
  const stable = useRefWithInit(createStableCallback).current;
  stable.next = callback;
  useSafeInsertionEffect(stable.effect);
  return stable.trampoline;
}
function createStableCallback() {
  const stable = {
    next: void 0,
    callback: assertNotCalled,
    trampoline: (...args) => stable.callback?.(...args),
    effect: () => {
      stable.callback = stable.next;
    }
  };
  return stable;
}
function assertNotCalled() {
  if (true) {
    throw (
      /* minify-error-disabled */
      new Error("Base UI: Cannot call an event handler while rendering.")
    );
  }
}

// node_modules/@base-ui/utils/useIsoLayoutEffect.mjs
var React3 = __toESM(require_react(), 1);
var noop = () => {
};
var useIsoLayoutEffect = typeof document !== "undefined" ? React3.useLayoutEffect : noop;

// node_modules/@base-ui/utils/warn.mjs
var set2;
if (true) {
  set2 = /* @__PURE__ */ new Set();
}
function warn(...messages) {
  if (true) {
    const messageKey = messages.join(" ");
    if (!set2.has(messageKey)) {
      set2.add(messageKey);
      console.warn(`Base UI: ${messageKey}`);
    }
  }
}

// node_modules/@base-ui/react/internals/direction-context/DirectionContext.mjs
var React4 = __toESM(require_react(), 1);
var DirectionContext = /* @__PURE__ */ React4.createContext(void 0);
if (true) DirectionContext.displayName = "DirectionContext";
function useDirection() {
  const context = React4.useContext(DirectionContext);
  return context?.direction ?? "ltr";
}

// node_modules/@base-ui/react/internals/useRenderElement.mjs
var React7 = __toESM(require_react(), 1);

// node_modules/@base-ui/utils/useMergedRefs.mjs
function useMergedRefs(a, b, c, d) {
  const forkRef = useRefWithInit(createForkRef).current;
  if (didChange(forkRef, a, b, c, d)) {
    update(forkRef, [a, b, c, d]);
  }
  return forkRef.callback;
}
function useMergedRefsN(refs) {
  const forkRef = useRefWithInit(createForkRef).current;
  if (didChangeN(forkRef, refs)) {
    update(forkRef, refs);
  }
  return forkRef.callback;
}
function createForkRef() {
  return {
    callback: null,
    cleanup: null,
    refs: []
  };
}
function didChange(forkRef, a, b, c, d) {
  return forkRef.refs[0] !== a || forkRef.refs[1] !== b || forkRef.refs[2] !== c || forkRef.refs[3] !== d;
}
function didChangeN(forkRef, newRefs) {
  return forkRef.refs.length !== newRefs.length || forkRef.refs.some((ref, index2) => ref !== newRefs[index2]);
}
function update(forkRef, refs) {
  forkRef.refs = refs;
  if (refs.every((ref) => ref == null)) {
    forkRef.callback = null;
    return;
  }
  forkRef.callback = (instance) => {
    if (forkRef.cleanup) {
      forkRef.cleanup();
      forkRef.cleanup = null;
    }
    if (instance != null) {
      const cleanupCallbacks = Array(refs.length).fill(null);
      for (let i = 0; i < refs.length; i += 1) {
        const ref = refs[i];
        if (ref == null) {
          continue;
        }
        switch (typeof ref) {
          case "function": {
            const refCleanup = ref(instance);
            if (typeof refCleanup === "function") {
              cleanupCallbacks[i] = refCleanup;
            }
            break;
          }
          case "object": {
            ref.current = instance;
            break;
          }
          default:
        }
      }
      forkRef.cleanup = () => {
        for (let i = 0; i < refs.length; i += 1) {
          const ref = refs[i];
          if (ref == null) {
            continue;
          }
          switch (typeof ref) {
            case "function": {
              const cleanupCallback = cleanupCallbacks[i];
              if (typeof cleanupCallback === "function") {
                cleanupCallback();
              } else {
                ref(null);
              }
              break;
            }
            case "object": {
              ref.current = null;
              break;
            }
            default:
          }
        }
      };
    }
  };
}

// node_modules/@base-ui/utils/getReactElementRef.mjs
var React6 = __toESM(require_react(), 1);

// node_modules/@base-ui/utils/reactVersion.mjs
var React5 = __toESM(require_react(), 1);
var majorVersion = parseInt(React5.version, 10);
function isReactVersionAtLeast(reactVersionToCheck) {
  return majorVersion >= reactVersionToCheck;
}

// node_modules/@base-ui/utils/getReactElementRef.mjs
function getReactElementRef(element) {
  if (!/* @__PURE__ */ React6.isValidElement(element)) {
    return null;
  }
  const reactElement = element;
  const propsWithRef = reactElement.props;
  return (isReactVersionAtLeast(19) ? propsWithRef?.ref : reactElement.ref) ?? null;
}

// node_modules/@base-ui/utils/mergeObjects.mjs
function mergeObjects(a, b) {
  if (a && !b) {
    return a;
  }
  if (!a && b) {
    return b;
  }
  if (a || b) {
    return {
      ...a,
      ...b
    };
  }
  return void 0;
}

// node_modules/@base-ui/utils/empty.mjs
function NOOP() {
}
var EMPTY_ARRAY = Object.freeze([]);
var EMPTY_OBJECT = Object.freeze({});

// node_modules/@base-ui/react/internals/getStateAttributesProps.mjs
function getStateAttributesProps(state, customMapping) {
  const props = {};
  for (const key in state) {
    const value = state[key];
    if (customMapping?.hasOwnProperty(key)) {
      const customProps = customMapping[key](value);
      if (customProps != null) {
        Object.assign(props, customProps);
      }
      continue;
    }
    if (value === true) {
      props[`data-${key.toLowerCase()}`] = "";
    } else if (value) {
      props[`data-${key.toLowerCase()}`] = value.toString();
    }
  }
  return props;
}

// node_modules/@base-ui/react/utils/resolveClassName.mjs
function resolveClassName(className, state) {
  return typeof className === "function" ? className(state) : className;
}

// node_modules/@base-ui/react/utils/resolveStyle.mjs
function resolveStyle(style, state) {
  return typeof style === "function" ? style(state) : style;
}

// node_modules/@base-ui/react/merge-props/mergeProps.mjs
var EMPTY_PROPS = {};
function mergeProps(a, b, c, d, e) {
  if (!c && !d && !e && !a) {
    return createInitialMergedProps(b);
  }
  let merged = createInitialMergedProps(a);
  if (b) {
    merged = mergeInto(merged, b);
  }
  if (c) {
    merged = mergeInto(merged, c);
  }
  if (d) {
    merged = mergeInto(merged, d);
  }
  if (e) {
    merged = mergeInto(merged, e);
  }
  return merged;
}
function mergePropsN(props) {
  if (props.length === 0) {
    return EMPTY_PROPS;
  }
  if (props.length === 1) {
    return createInitialMergedProps(props[0]);
  }
  let merged = createInitialMergedProps(props[0]);
  for (let i = 1; i < props.length; i += 1) {
    merged = mergeInto(merged, props[i]);
  }
  return merged;
}
function createInitialMergedProps(inputProps) {
  if (isPropsGetter(inputProps)) {
    return {
      ...resolvePropsGetter(inputProps, EMPTY_PROPS)
    };
  }
  return copyInitialProps(inputProps);
}
function mergeInto(merged, inputProps) {
  if (isPropsGetter(inputProps)) {
    return resolvePropsGetter(inputProps, merged);
  }
  return mutablyMergeInto(merged, inputProps);
}
function copyInitialProps(inputProps) {
  const copiedProps = {
    ...inputProps
  };
  for (const propName in copiedProps) {
    const propValue = copiedProps[propName];
    if (isEventHandler(propName, propValue)) {
      copiedProps[propName] = wrapEventHandler(propValue);
    }
  }
  return copiedProps;
}
function mutablyMergeInto(mergedProps, externalProps) {
  if (!externalProps) {
    return mergedProps;
  }
  for (const propName in externalProps) {
    const externalPropValue = externalProps[propName];
    switch (propName) {
      case "style": {
        mergedProps[propName] = mergeObjects(mergedProps.style, externalPropValue);
        break;
      }
      case "className": {
        mergedProps[propName] = mergeClassNames(mergedProps.className, externalPropValue);
        break;
      }
      default: {
        if (isEventHandler(propName, externalPropValue)) {
          mergedProps[propName] = mergeEventHandlers(mergedProps[propName], externalPropValue);
        } else {
          mergedProps[propName] = externalPropValue;
        }
      }
    }
  }
  return mergedProps;
}
function isEventHandler(key, value) {
  const code0 = key.charCodeAt(0);
  const code1 = key.charCodeAt(1);
  const code2 = key.charCodeAt(2);
  return code0 === 111 && code1 === 110 && code2 >= 65 && code2 <= 90 && (typeof value === "function" || typeof value === "undefined");
}
function isPropsGetter(inputProps) {
  return typeof inputProps === "function";
}
function resolvePropsGetter(inputProps, previousProps) {
  if (isPropsGetter(inputProps)) {
    return inputProps(previousProps);
  }
  return inputProps ?? EMPTY_PROPS;
}
function mergeEventHandlers(ourHandler, theirHandler) {
  if (!theirHandler) {
    return ourHandler;
  }
  if (!ourHandler) {
    return wrapEventHandler(theirHandler);
  }
  return (...args) => {
    const event = args[0];
    if (isSyntheticEvent(event)) {
      const baseUIEvent = event;
      makeEventPreventable(baseUIEvent);
      const result2 = theirHandler(...args);
      if (!baseUIEvent.baseUIHandlerPrevented) {
        ourHandler?.(...args);
      }
      return result2;
    }
    const result = theirHandler(...args);
    ourHandler?.(...args);
    return result;
  };
}
function wrapEventHandler(handler) {
  if (!handler) {
    return handler;
  }
  return (...args) => {
    const event = args[0];
    if (isSyntheticEvent(event)) {
      makeEventPreventable(event);
    }
    return handler(...args);
  };
}
function makeEventPreventable(event) {
  event.preventBaseUIHandler = () => {
    event.baseUIHandlerPrevented = true;
  };
  return event;
}
function mergeClassNames(ourClassName, theirClassName) {
  if (theirClassName) {
    if (ourClassName) {
      return theirClassName + " " + ourClassName;
    }
    return theirClassName;
  }
  return ourClassName;
}
function isSyntheticEvent(event) {
  return event != null && typeof event === "object" && "nativeEvent" in event;
}

// node_modules/@base-ui/react/internals/useRenderElement.mjs
var import_react = __toESM(require_react(), 1);
function useRenderElement(element, componentProps, params = {}) {
  const renderProp = componentProps.render;
  const outProps = useRenderElementProps(componentProps, params);
  if (params.enabled === false) {
    return null;
  }
  const state = params.state ?? EMPTY_OBJECT;
  return evaluateRenderProp(element, renderProp, outProps, state);
}
function useRenderElementProps(componentProps, params = {}) {
  const {
    className: classNameProp,
    style: styleProp,
    render: renderProp
  } = componentProps;
  const {
    state = EMPTY_OBJECT,
    ref,
    props,
    stateAttributesMapping: stateAttributesMapping6,
    enabled = true
  } = params;
  const className = enabled ? resolveClassName(classNameProp, state) : void 0;
  const style = enabled ? resolveStyle(styleProp, state) : void 0;
  const stateProps = enabled ? getStateAttributesProps(state, stateAttributesMapping6) : EMPTY_OBJECT;
  const resolvedProps = enabled && props ? resolveRenderFunctionProps(props) : void 0;
  const outProps = enabled ? mergeObjects(stateProps, resolvedProps) ?? {} : EMPTY_OBJECT;
  if (typeof document !== "undefined") {
    if (!enabled) {
      useMergedRefs(null, null);
    } else if (Array.isArray(ref)) {
      outProps.ref = useMergedRefsN([outProps.ref, getReactElementRef(renderProp), ...ref]);
    } else {
      outProps.ref = useMergedRefs(outProps.ref, getReactElementRef(renderProp), ref);
    }
  }
  if (!enabled) {
    return EMPTY_OBJECT;
  }
  if (className !== void 0) {
    outProps.className = mergeClassNames(outProps.className, className);
  }
  if (style !== void 0) {
    outProps.style = mergeObjects(outProps.style, style);
  }
  return outProps;
}
function resolveRenderFunctionProps(props) {
  if (Array.isArray(props)) {
    return mergePropsN(props);
  }
  return mergeProps(void 0, props);
}
var REACT_LAZY_TYPE = /* @__PURE__ */ Symbol.for("react.lazy");
var COMPONENT_IDENTIFIER_PATTERN = /^[A-Z][A-Za-z0-9$]*$/;
var LOWERCASE_CHARACTER_PATTERN = /[a-z]/;
function evaluateRenderProp(element, render, props, state) {
  if (render) {
    if (typeof render === "function") {
      if (true) {
        warnIfRenderPropLooksLikeComponent(render);
      }
      return render(props, state);
    }
    const mergedProps = mergeProps(props, render.props);
    mergedProps.ref = props.ref;
    let newElement = render;
    if (newElement?.$$typeof === REACT_LAZY_TYPE) {
      const children = React7.Children.toArray(render);
      newElement = children[0];
    }
    if (true) {
      if (!/* @__PURE__ */ React7.isValidElement(newElement)) {
        throw new Error(["Base UI: The `render` prop was provided an invalid React element as `React.isValidElement(render)` is `false`.", "A valid React element must be provided to the `render` prop because it is cloned with props to replace the default element.", "https://base-ui.com/r/invalid-render-prop"].join("\n"));
      }
    }
    return /* @__PURE__ */ React7.cloneElement(newElement, mergedProps);
  }
  if (element) {
    if (typeof element === "string") {
      return renderTag(element, props);
    }
  }
  throw new Error(true ? "Base UI: Render element or function are not defined." : formatErrorMessage_default(8));
}
function warnIfRenderPropLooksLikeComponent(renderFn) {
  const functionName = renderFn.name;
  if (functionName.length === 0) {
    return;
  }
  if (!COMPONENT_IDENTIFIER_PATTERN.test(functionName)) {
    return;
  }
  if (!LOWERCASE_CHARACTER_PATTERN.test(functionName)) {
    return;
  }
  warn(`The \`render\` prop received a function named \`${functionName}\` that starts with an uppercase letter.`, "This usually means a React component was passed directly as `render={Component}`.", "Base UI calls `render` as a plain function, which can break the Rules of Hooks during reconciliation.", "If this is an intentional render callback, rename it to start with a lowercase letter.", "Use `render={<Component />}` or `render={(props) => <Component {...props} />}` instead.", "https://base-ui.com/r/invalid-render-prop");
}
function renderTag(Tag, props) {
  if (Tag === "button") {
    return /* @__PURE__ */ (0, import_react.createElement)("button", {
      type: "button",
      ...props,
      key: props.key
    });
  }
  if (Tag === "img") {
    return /* @__PURE__ */ (0, import_react.createElement)("img", {
      alt: "",
      ...props,
      key: props.key
    });
  }
  return /* @__PURE__ */ React7.createElement(Tag, props);
}

// node_modules/@base-ui/utils/useId.mjs
var React8 = __toESM(require_react(), 1);
var globalId = 0;
function useGlobalId(idOverride, prefix = "mui") {
  const [defaultId, setDefaultId] = React8.useState(idOverride);
  const id = idOverride || defaultId;
  React8.useEffect(() => {
    if (defaultId == null) {
      globalId += 1;
      setDefaultId(`${prefix}-${globalId}`);
    }
  }, [defaultId, prefix]);
  return id;
}
var maybeReactUseId = SafeReact.useId;
function useId(idOverride, prefix) {
  if (maybeReactUseId !== void 0) {
    const reactId = maybeReactUseId();
    return idOverride ?? (prefix ? `${prefix}-${reactId}` : reactId);
  }
  return useGlobalId(idOverride, prefix);
}

// node_modules/@base-ui/react/internals/useBaseUiId.mjs
function useBaseUiId(idOverride) {
  return useId(idOverride, "base-ui");
}

// node_modules/@base-ui/react/internals/reason-parts.mjs
var reason_parts_exports = {};
__export(reason_parts_exports, {
  cancelOpen: () => cancelOpen,
  chipRemovePress: () => chipRemovePress,
  clearPress: () => clearPress,
  closePress: () => closePress,
  closeWatcher: () => closeWatcher,
  decrementPress: () => decrementPress,
  disabled: () => disabled,
  drag: () => drag,
  escapeKey: () => escapeKey,
  focusOut: () => focusOut,
  imperativeAction: () => imperativeAction,
  incrementPress: () => incrementPress,
  initial: () => initial,
  inputBlur: () => inputBlur,
  inputChange: () => inputChange,
  inputClear: () => inputClear,
  inputPaste: () => inputPaste,
  inputPress: () => inputPress,
  itemPress: () => itemPress,
  keyboard: () => keyboard,
  linkPress: () => linkPress,
  listNavigation: () => listNavigation,
  missing: () => missing,
  none: () => none,
  outsidePress: () => outsidePress,
  pointer: () => pointer,
  scrub: () => scrub,
  siblingOpen: () => siblingOpen,
  swipe: () => swipe,
  trackPress: () => trackPress,
  triggerFocus: () => triggerFocus,
  triggerHover: () => triggerHover,
  triggerPress: () => triggerPress,
  wheel: () => wheel,
  windowResize: () => windowResize
});
var none = "none";
var triggerPress = "trigger-press";
var triggerHover = "trigger-hover";
var triggerFocus = "trigger-focus";
var outsidePress = "outside-press";
var itemPress = "item-press";
var closePress = "close-press";
var linkPress = "link-press";
var clearPress = "clear-press";
var chipRemovePress = "chip-remove-press";
var trackPress = "track-press";
var incrementPress = "increment-press";
var decrementPress = "decrement-press";
var inputChange = "input-change";
var inputClear = "input-clear";
var inputBlur = "input-blur";
var inputPaste = "input-paste";
var inputPress = "input-press";
var focusOut = "focus-out";
var escapeKey = "escape-key";
var closeWatcher = "close-watcher";
var listNavigation = "list-navigation";
var keyboard = "keyboard";
var pointer = "pointer";
var drag = "drag";
var wheel = "wheel";
var scrub = "scrub";
var cancelOpen = "cancel-open";
var siblingOpen = "sibling-open";
var disabled = "disabled";
var missing = "missing";
var initial = "initial";
var imperativeAction = "imperative-action";
var swipe = "swipe";
var windowResize = "window-resize";

// node_modules/@base-ui/react/internals/createBaseUIEventDetails.mjs
function createChangeEventDetails(reason, event, trigger, customProperties) {
  let canceled = false;
  let allowPropagation = false;
  const custom = customProperties ?? EMPTY_OBJECT;
  const details = {
    reason,
    event: event ?? new Event("base-ui"),
    cancel() {
      canceled = true;
    },
    allowPropagation() {
      allowPropagation = true;
    },
    get isCanceled() {
      return canceled;
    },
    get isPropagationAllowed() {
      return allowPropagation;
    },
    trigger,
    ...custom
  };
  return details;
}

// node_modules/@base-ui/react/internals/useTransitionStatus.mjs
var React10 = __toESM(require_react(), 1);

// node_modules/@base-ui/utils/useOnMount.mjs
var React9 = __toESM(require_react(), 1);
var EMPTY = [];
function useOnMount(fn) {
  React9.useEffect(fn, EMPTY);
}

// node_modules/@base-ui/utils/useAnimationFrame.mjs
var EMPTY2 = null;
var LAST_RAF = globalThis.requestAnimationFrame;
var Scheduler = class {
  /* This implementation uses an array as a backing data-structure for frame callbacks.
   * It allows `O(1)` callback cancelling by inserting a `null` in the array, though it
   * never calls the native `cancelAnimationFrame` if there are no frames left. This can
   * be much more efficient if there is a call pattern that alterns as
   * "request-cancel-request-cancel-…".
   * But in the case of "request-request-…-cancel-cancel-…", it leaves the final animation
   * frame to run anyway. We turn that frame into a `O(1)` no-op via `callbacksCount`. */
  callbacks = [];
  callbacksCount = 0;
  nextId = 1;
  startId = 1;
  isScheduled = false;
  tick = (timestamp) => {
    this.isScheduled = false;
    const currentCallbacks = this.callbacks;
    const currentCallbacksCount = this.callbacksCount;
    this.callbacks = [];
    this.callbacksCount = 0;
    this.startId = this.nextId;
    if (currentCallbacksCount > 0) {
      for (let i = 0; i < currentCallbacks.length; i += 1) {
        currentCallbacks[i]?.(timestamp);
      }
    }
  };
  request(fn) {
    const id = this.nextId;
    this.nextId += 1;
    this.callbacks.push(fn);
    this.callbacksCount += 1;
    const didRAFChange = LAST_RAF !== requestAnimationFrame && (LAST_RAF = requestAnimationFrame, true);
    if (!this.isScheduled || didRAFChange) {
      requestAnimationFrame(this.tick);
      this.isScheduled = true;
    }
    return id;
  }
  cancel(id) {
    const index2 = id - this.startId;
    if (index2 < 0 || index2 >= this.callbacks.length) {
      return;
    }
    this.callbacks[index2] = null;
    this.callbacksCount -= 1;
  }
};
var scheduler = new Scheduler();
var AnimationFrame = class _AnimationFrame {
  static create() {
    return new _AnimationFrame();
  }
  static request(fn) {
    return scheduler.request(fn);
  }
  static cancel(id) {
    return scheduler.cancel(id);
  }
  currentId = EMPTY2;
  /**
   * Executes `fn` after `delay`, clearing any previously scheduled call.
   */
  request(fn) {
    this.cancel();
    this.currentId = scheduler.request(() => {
      this.currentId = EMPTY2;
      fn();
    });
  }
  cancel = () => {
    if (this.currentId !== EMPTY2) {
      scheduler.cancel(this.currentId);
      this.currentId = EMPTY2;
    }
  };
  disposeEffect = () => {
    return this.cancel;
  };
};
function useAnimationFrame() {
  const timeout = useRefWithInit(AnimationFrame.create).current;
  useOnMount(timeout.disposeEffect);
  return timeout;
}

// node_modules/@base-ui/react/internals/useTransitionStatus.mjs
function useTransitionStatus(open, enableIdleState = false, deferEndingState = false) {
  const [transitionStatus, setTransitionStatus] = React10.useState(open && enableIdleState ? "idle" : void 0);
  const [mounted, setMounted] = React10.useState(open);
  if (open && !mounted) {
    setMounted(true);
    setTransitionStatus("starting");
  }
  if (!open && mounted && transitionStatus !== "ending" && !deferEndingState) {
    setTransitionStatus("ending");
  }
  if (!open && !mounted && transitionStatus === "ending") {
    setTransitionStatus(void 0);
  }
  useIsoLayoutEffect(() => {
    if (!open && mounted && transitionStatus !== "ending" && deferEndingState) {
      const frame = AnimationFrame.request(() => {
        setTransitionStatus("ending");
      });
      return () => {
        AnimationFrame.cancel(frame);
      };
    }
    return void 0;
  }, [open, mounted, transitionStatus, deferEndingState]);
  useIsoLayoutEffect(() => {
    if (!open || enableIdleState) {
      return void 0;
    }
    const frame = AnimationFrame.request(() => {
      setTransitionStatus(void 0);
    });
    return () => {
      AnimationFrame.cancel(frame);
    };
  }, [enableIdleState, open]);
  useIsoLayoutEffect(() => {
    if (!open || !enableIdleState) {
      return void 0;
    }
    if (open && mounted && transitionStatus !== "idle") {
      setTransitionStatus("starting");
    }
    const frame = AnimationFrame.request(() => {
      setTransitionStatus("idle");
    });
    return () => {
      AnimationFrame.cancel(frame);
    };
  }, [enableIdleState, open, mounted, transitionStatus]);
  return {
    mounted,
    setMounted,
    transitionStatus
  };
}

// node_modules/@base-ui/react/internals/stateAttributesMapping.mjs
var TransitionStatusDataAttributes = /* @__PURE__ */ (function(TransitionStatusDataAttributes2) {
  TransitionStatusDataAttributes2["startingStyle"] = "data-starting-style";
  TransitionStatusDataAttributes2["endingStyle"] = "data-ending-style";
  return TransitionStatusDataAttributes2;
})({});
var STARTING_HOOK = {
  [TransitionStatusDataAttributes.startingStyle]: ""
};
var ENDING_HOOK = {
  [TransitionStatusDataAttributes.endingStyle]: ""
};
var transitionStatusMapping = {
  transitionStatus(value) {
    if (value === "starting") {
      return STARTING_HOOK;
    }
    if (value === "ending") {
      return ENDING_HOOK;
    }
    return null;
  }
};

// node_modules/@base-ui/react/internals/use-button/useButton.mjs
var React13 = __toESM(require_react(), 1);

// node_modules/@floating-ui/utils/dist/floating-ui.utils.dom.mjs
function hasWindow() {
  return typeof window !== "undefined";
}
function getNodeName(node) {
  if (isNode(node)) {
    return (node.nodeName || "").toLowerCase();
  }
  return "#document";
}
function getWindow(node) {
  var _node$ownerDocument;
  return (node == null || (_node$ownerDocument = node.ownerDocument) == null ? void 0 : _node$ownerDocument.defaultView) || window;
}
function getDocumentElement(node) {
  var _ref;
  return (_ref = (isNode(node) ? node.ownerDocument : node.document) || window.document) == null ? void 0 : _ref.documentElement;
}
function isNode(value) {
  if (!hasWindow()) {
    return false;
  }
  return value instanceof Node || value instanceof getWindow(value).Node;
}
function isElement(value) {
  if (!hasWindow()) {
    return false;
  }
  return value instanceof Element || value instanceof getWindow(value).Element;
}
function isHTMLElement(value) {
  if (!hasWindow()) {
    return false;
  }
  return value instanceof HTMLElement || value instanceof getWindow(value).HTMLElement;
}
function isShadowRoot(value) {
  if (!hasWindow() || typeof ShadowRoot === "undefined") {
    return false;
  }
  return value instanceof ShadowRoot || value instanceof getWindow(value).ShadowRoot;
}
function isOverflowElement(element) {
  const {
    overflow,
    overflowX,
    overflowY,
    display
  } = getComputedStyle2(element);
  return /auto|scroll|overlay|hidden|clip/.test(overflow + overflowY + overflowX) && display !== "inline" && display !== "contents";
}
function isTableElement(element) {
  return /^(table|td|th)$/.test(getNodeName(element));
}
function isTopLayer(element) {
  try {
    if (element.matches(":popover-open")) {
      return true;
    }
  } catch (_e) {
  }
  try {
    return element.matches(":modal");
  } catch (_e) {
    return false;
  }
}
var willChangeRe = /transform|translate|scale|rotate|perspective|filter/;
var containRe = /paint|layout|strict|content/;
var isNotNone = (value) => !!value && value !== "none";
var isWebKitValue;
function isContainingBlock(elementOrCss) {
  const css = isElement(elementOrCss) ? getComputedStyle2(elementOrCss) : elementOrCss;
  return isNotNone(css.transform) || isNotNone(css.translate) || isNotNone(css.scale) || isNotNone(css.rotate) || isNotNone(css.perspective) || !isWebKit() && (isNotNone(css.backdropFilter) || isNotNone(css.filter)) || willChangeRe.test(css.willChange || "") || containRe.test(css.contain || "");
}
function getContainingBlock(element) {
  let currentNode = getParentNode(element);
  while (isHTMLElement(currentNode) && !isLastTraversableNode(currentNode)) {
    if (isContainingBlock(currentNode)) {
      return currentNode;
    } else if (isTopLayer(currentNode)) {
      return null;
    }
    currentNode = getParentNode(currentNode);
  }
  return null;
}
function isWebKit() {
  if (isWebKitValue == null) {
    isWebKitValue = typeof CSS !== "undefined" && CSS.supports && CSS.supports("-webkit-backdrop-filter", "none");
  }
  return isWebKitValue;
}
function isLastTraversableNode(node) {
  return /^(html|body|#document)$/.test(getNodeName(node));
}
function getComputedStyle2(element) {
  return getWindow(element).getComputedStyle(element);
}
function getNodeScroll(element) {
  if (isElement(element)) {
    return {
      scrollLeft: element.scrollLeft,
      scrollTop: element.scrollTop
    };
  }
  return {
    scrollLeft: element.scrollX,
    scrollTop: element.scrollY
  };
}
function getParentNode(node) {
  if (getNodeName(node) === "html") {
    return node;
  }
  const result = (
    // Step into the shadow DOM of the parent of a slotted node.
    node.assignedSlot || // DOM Element detected.
    node.parentNode || // ShadowRoot detected.
    isShadowRoot(node) && node.host || // Fallback.
    getDocumentElement(node)
  );
  return isShadowRoot(result) ? result.host : result;
}
function getNearestOverflowAncestor(node) {
  const parentNode = getParentNode(node);
  if (isLastTraversableNode(parentNode)) {
    return node.ownerDocument ? node.ownerDocument.body : node.body;
  }
  if (isHTMLElement(parentNode) && isOverflowElement(parentNode)) {
    return parentNode;
  }
  return getNearestOverflowAncestor(parentNode);
}
function getOverflowAncestors(node, list, traverseIframes) {
  var _node$ownerDocument2;
  if (list === void 0) {
    list = [];
  }
  if (traverseIframes === void 0) {
    traverseIframes = true;
  }
  const scrollableAncestor = getNearestOverflowAncestor(node);
  const isBody = scrollableAncestor === ((_node$ownerDocument2 = node.ownerDocument) == null ? void 0 : _node$ownerDocument2.body);
  const win = getWindow(scrollableAncestor);
  if (isBody) {
    const frameElement = getFrameElement(win);
    return list.concat(win, win.visualViewport || [], isOverflowElement(scrollableAncestor) ? scrollableAncestor : [], frameElement && traverseIframes ? getOverflowAncestors(frameElement) : []);
  } else {
    return list.concat(scrollableAncestor, getOverflowAncestors(scrollableAncestor, [], traverseIframes));
  }
}
function getFrameElement(win) {
  return win.parent && Object.getPrototypeOf(win.parent) ? win.frameElement : null;
}

// node_modules/@base-ui/react/internals/composite/root/CompositeRootContext.mjs
var React11 = __toESM(require_react(), 1);
var CompositeRootContext = /* @__PURE__ */ React11.createContext(void 0);
if (true) CompositeRootContext.displayName = "CompositeRootContext";
function useCompositeRootContext(optional = false) {
  const context = React11.useContext(CompositeRootContext);
  if (context === void 0 && !optional) {
    throw new Error(true ? "Base UI: CompositeRootContext is missing. Composite parts must be placed within <Composite.Root>." : formatErrorMessage_default(16));
  }
  return context;
}

// node_modules/@base-ui/react/utils/useFocusableWhenDisabled.mjs
var React12 = __toESM(require_react(), 1);
function useFocusableWhenDisabled(parameters) {
  const {
    focusableWhenDisabled,
    disabled: disabled2,
    composite = false,
    tabIndex: tabIndexProp = 0,
    isNativeButton
  } = parameters;
  const isFocusableComposite = composite && focusableWhenDisabled !== false;
  const isNonFocusableComposite = composite && focusableWhenDisabled === false;
  const props = React12.useMemo(() => {
    const additionalProps = {
      // allow Tabbing away from focusableWhenDisabled elements
      onKeyDown(event) {
        if (disabled2 && focusableWhenDisabled && event.key !== "Tab") {
          event.preventDefault();
        }
      }
    };
    if (!composite) {
      additionalProps.tabIndex = tabIndexProp;
      if (!isNativeButton && disabled2) {
        additionalProps.tabIndex = focusableWhenDisabled ? tabIndexProp : -1;
      }
    }
    if (isNativeButton && (focusableWhenDisabled || isFocusableComposite) || !isNativeButton && disabled2) {
      additionalProps["aria-disabled"] = disabled2;
    }
    if (isNativeButton && (!focusableWhenDisabled || isNonFocusableComposite)) {
      additionalProps.disabled = disabled2;
    }
    return additionalProps;
  }, [composite, disabled2, focusableWhenDisabled, isFocusableComposite, isNonFocusableComposite, isNativeButton, tabIndexProp]);
  return {
    props
  };
}

// node_modules/@base-ui/react/internals/use-button/useButton.mjs
function useButton(parameters = {}) {
  const {
    disabled: disabled2 = false,
    focusableWhenDisabled,
    tabIndex = 0,
    native: isNativeButton = true,
    composite: compositeProp
  } = parameters;
  const elementRef = React13.useRef(null);
  const compositeRootContext = useCompositeRootContext(true);
  const isCompositeItem = compositeProp ?? compositeRootContext !== void 0;
  const {
    props: focusableWhenDisabledProps
  } = useFocusableWhenDisabled({
    focusableWhenDisabled,
    disabled: disabled2,
    composite: isCompositeItem,
    tabIndex,
    isNativeButton
  });
  if (true) {
    React13.useEffect(() => {
      if (!elementRef.current) {
        return;
      }
      const isButtonTag = isButtonElement(elementRef.current);
      if (isNativeButton) {
        if (!isButtonTag) {
          const ownerStackMessage = SafeReact.captureOwnerStack?.() || "";
          const message = "A component that acts as a button expected a native <button> because the `nativeButton` prop is true. Rendering a non-<button> removes native button semantics, which can impact forms and accessibility. Use a real <button> in the `render` prop, or set `nativeButton` to `false`.";
          error(`${message}${ownerStackMessage}`);
        }
      } else if (isButtonTag) {
        const ownerStackMessage = SafeReact.captureOwnerStack?.() || "";
        const message = "A component that acts as a button expected a non-<button> because the `nativeButton` prop is false. Rendering a <button> keeps native behavior while Base UI applies non-native attributes and handlers, which can add unintended extra attributes (such as `role` or `aria-disabled`). Use a non-<button> in the `render` prop, or set `nativeButton` to `true`.";
        error(`${message}${ownerStackMessage}`);
      }
    }, [isNativeButton]);
  }
  const updateDisabled = React13.useCallback(() => {
    const element = elementRef.current;
    if (!isButtonElement(element)) {
      return;
    }
    if (isCompositeItem && disabled2 && focusableWhenDisabledProps.disabled === void 0 && element.disabled) {
      element.disabled = false;
    }
  }, [disabled2, focusableWhenDisabledProps.disabled, isCompositeItem]);
  useIsoLayoutEffect(updateDisabled, [updateDisabled]);
  const getButtonProps = React13.useCallback((externalProps = {}) => {
    const {
      onClick: externalOnClick,
      onMouseDown: externalOnMouseDown,
      onKeyUp: externalOnKeyUp,
      onKeyDown: externalOnKeyDown,
      onPointerDown: externalOnPointerDown,
      ...otherExternalProps
    } = externalProps;
    return mergeProps({
      onClick(event) {
        if (disabled2) {
          event.preventDefault();
          return;
        }
        externalOnClick?.(event);
      },
      onMouseDown(event) {
        if (!disabled2) {
          externalOnMouseDown?.(event);
        }
      },
      onKeyDown(event) {
        if (disabled2) {
          return;
        }
        makeEventPreventable(event);
        externalOnKeyDown?.(event);
        if (event.baseUIHandlerPrevented) {
          return;
        }
        const isCurrentTarget = event.target === event.currentTarget;
        const currentTarget = event.currentTarget;
        const isButton = isButtonElement(currentTarget);
        const isLink = !isNativeButton && isValidLinkElement(currentTarget);
        const shouldClick = isCurrentTarget && (isNativeButton ? isButton : !isLink);
        const isEnterKey = event.key === "Enter";
        const isSpaceKey = event.key === " ";
        const role = currentTarget.getAttribute("role");
        const isTextNavigationRole = role?.startsWith("menuitem") || role === "option" || role === "gridcell";
        if (isCurrentTarget && isCompositeItem && isSpaceKey) {
          if (event.defaultPrevented && isTextNavigationRole) {
            return;
          }
          event.preventDefault();
          if (isLink || isNativeButton && isButton) {
            currentTarget.click();
            event.preventBaseUIHandler();
          } else if (shouldClick) {
            externalOnClick?.(event);
            event.preventBaseUIHandler();
          }
          return;
        }
        if (shouldClick) {
          if (!isNativeButton && (isSpaceKey || isEnterKey)) {
            event.preventDefault();
          }
          if (!isNativeButton && isEnterKey) {
            externalOnClick?.(event);
          }
        }
      },
      onKeyUp(event) {
        if (disabled2) {
          return;
        }
        makeEventPreventable(event);
        externalOnKeyUp?.(event);
        if (event.target === event.currentTarget && isNativeButton && isCompositeItem && isButtonElement(event.currentTarget) && event.key === " ") {
          event.preventDefault();
          return;
        }
        if (event.baseUIHandlerPrevented) {
          return;
        }
        if (event.target === event.currentTarget && !isNativeButton && !isCompositeItem && event.key === " ") {
          externalOnClick?.(event);
        }
      },
      onPointerDown(event) {
        if (disabled2) {
          event.preventDefault();
          return;
        }
        externalOnPointerDown?.(event);
      }
    }, isNativeButton ? {
      type: "button"
    } : {
      role: "button"
    }, focusableWhenDisabledProps, otherExternalProps);
  }, [disabled2, focusableWhenDisabledProps, isCompositeItem, isNativeButton]);
  const buttonRef = useStableCallback((element) => {
    elementRef.current = element;
    updateDisabled();
  });
  return {
    getButtonProps,
    buttonRef
  };
}
function isButtonElement(elem) {
  return isHTMLElement(elem) && elem.tagName === "BUTTON";
}
function isValidLinkElement(elem) {
  return Boolean(elem?.tagName === "A" && elem?.href);
}

// node_modules/@base-ui/utils/addEventListener.mjs
function addEventListener(target, type, listener, options) {
  target.addEventListener(type, listener, options);
  return () => {
    target.removeEventListener(type, listener, options);
  };
}

// node_modules/@base-ui/utils/useValueAsRef.mjs
function useValueAsRef(value) {
  const latest = useRefWithInit(createLatestRef, value).current;
  latest.next = value;
  useIsoLayoutEffect(latest.effect);
  return latest;
}
function createLatestRef(value) {
  const latest = {
    current: value,
    next: value,
    effect: () => {
      latest.current = latest.next;
    }
  };
  return latest;
}

// node_modules/@base-ui/utils/owner.mjs
function ownerDocument(node) {
  return node?.ownerDocument || document;
}

// node_modules/@base-ui/react/internals/useOpenChangeComplete.mjs
var React14 = __toESM(require_react(), 1);

// node_modules/@base-ui/react/internals/useAnimationsFinished.mjs
var ReactDOM = __toESM(require_react_dom(), 1);

// node_modules/@base-ui/react/utils/resolveRef.mjs
function resolveRef(maybeRef) {
  if (maybeRef == null) {
    return maybeRef;
  }
  return "current" in maybeRef ? maybeRef.current : maybeRef;
}

// node_modules/@base-ui/react/internals/useAnimationsFinished.mjs
function useAnimationsFinished(elementOrRef, waitForStartingStyleRemoved = false, treatAbortedAsFinished = true) {
  const frame = useAnimationFrame();
  return useStableCallback((fnToExecute, signal = null) => {
    frame.cancel();
    const element = resolveRef(elementOrRef);
    if (element == null) {
      return;
    }
    const resolvedElement = element;
    const done = () => {
      ReactDOM.flushSync(fnToExecute);
    };
    if (typeof resolvedElement.getAnimations !== "function" || globalThis.BASE_UI_ANIMATIONS_DISABLED) {
      fnToExecute();
      return;
    }
    function exec() {
      Promise.all(resolvedElement.getAnimations().map((animation) => animation.finished)).then(() => {
        if (!signal?.aborted) {
          done();
        }
      }).catch(() => {
        if (treatAbortedAsFinished) {
          if (!signal?.aborted) {
            done();
          }
          return;
        }
        const currentAnimations = resolvedElement.getAnimations();
        if (!signal?.aborted && currentAnimations.length > 0 && currentAnimations.some((animation) => animation.pending || animation.playState !== "finished")) {
          exec();
        }
      });
    }
    if (waitForStartingStyleRemoved) {
      const startingStyleAttribute = TransitionStatusDataAttributes.startingStyle;
      if (!resolvedElement.hasAttribute(startingStyleAttribute)) {
        frame.request(exec);
        return;
      }
      const attributeObserver = new MutationObserver(() => {
        if (!resolvedElement.hasAttribute(startingStyleAttribute)) {
          attributeObserver.disconnect();
          exec();
        }
      });
      attributeObserver.observe(resolvedElement, {
        attributes: true,
        attributeFilter: [startingStyleAttribute]
      });
      signal?.addEventListener("abort", () => attributeObserver.disconnect(), {
        once: true
      });
      return;
    }
    frame.request(exec);
  });
}

// node_modules/@base-ui/react/internals/useOpenChangeComplete.mjs
function useOpenChangeComplete(parameters) {
  const {
    enabled = true,
    open,
    ref,
    onComplete: onCompleteParam
  } = parameters;
  const onComplete = useStableCallback(onCompleteParam);
  const runOnceAnimationsFinish = useAnimationsFinished(ref, open, false);
  React14.useEffect(() => {
    if (!enabled) {
      return void 0;
    }
    const abortController = new AbortController();
    runOnceAnimationsFinish(onComplete, abortController.signal);
    return () => {
      abortController.abort();
    };
  }, [enabled, open, onComplete, runOnceAnimationsFinish]);
}

// node_modules/@base-ui/utils/useOnFirstRender.mjs
var React15 = __toESM(require_react(), 1);
function useOnFirstRender(fn) {
  const ref = React15.useRef(true);
  if (ref.current) {
    ref.current = false;
    fn();
  }
}

// node_modules/@base-ui/utils/platform/parts.mjs
var parts_exports = {};
__export(parts_exports, {
  engine: () => engine_exports,
  env: () => env_exports,
  os: () => os_exports,
  screenReader: () => screen_reader_exports
});

// node_modules/@base-ui/utils/platform/os.mjs
var os_exports = {};
__export(os_exports, {
  android: () => android,
  apple: () => apple,
  ios: () => ios,
  linux: () => linux,
  mac: () => mac,
  windows: () => windows
});

// node_modules/@base-ui/utils/platform/shared.mjs
function readRawData() {
  if (typeof navigator === "undefined") {
    return {
      userAgent: "",
      platform: "",
      maxTouchPoints: 0
    };
  }
  if (true) {
    const uaData = navigator.userAgentData;
    if (uaData && Array.isArray(uaData.brands)) {
      return {
        userAgent: uaData.brands.map(({
          brand,
          version: version2
        }) => `${brand}/${version2}`).join(" "),
        platform: uaData.platform ?? navigator.platform ?? "",
        maxTouchPoints: navigator.maxTouchPoints ?? 0
      };
    }
  }
  return {
    userAgent: navigator.userAgent,
    platform: navigator.platform ?? "",
    maxTouchPoints: navigator.maxTouchPoints ?? 0
  };
}
var {
  userAgent,
  platform,
  maxTouchPoints
} = readRawData();
var lowerUserAgent = userAgent.toLowerCase();
var lowerPlatform = platform.toLowerCase();

// node_modules/@base-ui/utils/platform/os.mjs
var ios = /^i(os$|p)/.test(lowerPlatform) || lowerPlatform === "macintel" && maxTouchPoints > 1;
var ANDROID_STRING = "android";
var android = lowerPlatform === ANDROID_STRING || lowerUserAgent.includes(ANDROID_STRING);
var mac = !ios && lowerPlatform.startsWith("mac");
var windows = lowerPlatform.startsWith("win");
var linux = !android && /^(linux|chrome os)/.test(lowerPlatform);
var apple = mac || ios;

// node_modules/@base-ui/utils/platform/engine.mjs
var engine_exports = {};
__export(engine_exports, {
  blink: () => blink,
  gecko: () => gecko,
  webkit: () => webkit
});
var webkit = typeof CSS !== "undefined" && !!CSS.supports?.("-webkit-backdrop-filter:none");
var gecko = !webkit && lowerUserAgent.includes("firefox");
var blink = !webkit && lowerUserAgent.includes("chrom");

// node_modules/@base-ui/utils/platform/screen-reader.mjs
var screen_reader_exports = {};
__export(screen_reader_exports, {
  voiceOver: () => voiceOver
});
var voiceOver = apple;

// node_modules/@base-ui/utils/platform/env.mjs
var env_exports = {};
__export(env_exports, {
  jsdom: () => jsdom
});
var jsdom = /jsdom|happydom/.test(lowerUserAgent);

// node_modules/@base-ui/utils/useTimeout.mjs
var EMPTY3 = 0;
var Timeout = class _Timeout {
  static create() {
    return new _Timeout();
  }
  currentId = EMPTY3;
  /**
   * Executes `fn` after `delay`, clearing any previously scheduled call.
   */
  start(delay, fn) {
    this.clear();
    this.currentId = setTimeout(() => {
      this.currentId = EMPTY3;
      fn();
    }, delay);
  }
  isStarted() {
    return this.currentId !== EMPTY3;
  }
  clear = () => {
    if (this.currentId !== EMPTY3) {
      clearTimeout(this.currentId);
      this.currentId = EMPTY3;
    }
  };
  disposeEffect = () => {
    return this.clear;
  };
};
function useTimeout() {
  const timeout = useRefWithInit(Timeout.create).current;
  useOnMount(timeout.disposeEffect);
  return timeout;
}

// node_modules/@base-ui/utils/useScrollLock.mjs
var originalHtmlStyles = {};
var originalBodyStyles = {};
var originalHtmlScrollBehavior = "";
function hasInsetScrollbars(referenceElement) {
  if (typeof document === "undefined") {
    return false;
  }
  const doc = ownerDocument(referenceElement);
  const win = getWindow(doc);
  return win.innerWidth - doc.documentElement.clientWidth > 0;
}
function supportsStableScrollbarGutter(referenceElement) {
  const supported = typeof CSS !== "undefined" && CSS.supports && CSS.supports("scrollbar-gutter", "stable");
  if (!supported || typeof document === "undefined") {
    return false;
  }
  const doc = ownerDocument(referenceElement);
  const html = doc.documentElement;
  const body = doc.body;
  const scrollContainer = isOverflowElement(html) ? html : body;
  const originalScrollContainerOverflowY = scrollContainer.style.overflowY;
  const originalHtmlStyleGutter = html.style.scrollbarGutter;
  html.style.scrollbarGutter = "stable";
  scrollContainer.style.overflowY = "scroll";
  const before = scrollContainer.offsetWidth;
  scrollContainer.style.overflowY = "hidden";
  const after = scrollContainer.offsetWidth;
  scrollContainer.style.overflowY = originalScrollContainerOverflowY;
  html.style.scrollbarGutter = originalHtmlStyleGutter;
  return before === after;
}
function preventScrollOverlayScrollbars(referenceElement) {
  const doc = ownerDocument(referenceElement);
  const html = doc.documentElement;
  const body = doc.body;
  const elementToLock = isOverflowElement(html) ? html : body;
  const originalElementToLockStyles = {
    overflowY: elementToLock.style.overflowY,
    overflowX: elementToLock.style.overflowX
  };
  Object.assign(elementToLock.style, {
    overflowY: "hidden",
    overflowX: "hidden"
  });
  return () => {
    Object.assign(elementToLock.style, originalElementToLockStyles);
  };
}
function preventScrollInsetScrollbars(referenceElement) {
  const doc = ownerDocument(referenceElement);
  const html = doc.documentElement;
  const body = doc.body;
  const win = getWindow(html);
  let scrollTop = 0;
  let scrollLeft = 0;
  let updateGutterOnly = false;
  const resizeFrame = AnimationFrame.create();
  if (parts_exports.engine.webkit && (win.visualViewport?.scale ?? 1) !== 1) {
    return () => {
    };
  }
  function lockScroll() {
    const htmlStyles = win.getComputedStyle(html);
    const bodyStyles = win.getComputedStyle(body);
    const htmlScrollbarGutterValue = htmlStyles.scrollbarGutter || "";
    const hasBothEdges = htmlScrollbarGutterValue.includes("both-edges");
    const scrollbarGutterValue = hasBothEdges ? "stable both-edges" : "stable";
    scrollTop = html.scrollTop;
    scrollLeft = html.scrollLeft;
    originalHtmlStyles = {
      scrollbarGutter: html.style.scrollbarGutter,
      overflowY: html.style.overflowY,
      overflowX: html.style.overflowX
    };
    originalHtmlScrollBehavior = html.style.scrollBehavior;
    originalBodyStyles = {
      position: body.style.position,
      height: body.style.height,
      width: body.style.width,
      boxSizing: body.style.boxSizing,
      overflowY: body.style.overflowY,
      overflowX: body.style.overflowX,
      scrollBehavior: body.style.scrollBehavior
    };
    const isScrollableY = html.scrollHeight > html.clientHeight;
    const isScrollableX = html.scrollWidth > html.clientWidth;
    const hasConstantOverflowY = htmlStyles.overflowY === "scroll" || bodyStyles.overflowY === "scroll";
    const hasConstantOverflowX = htmlStyles.overflowX === "scroll" || bodyStyles.overflowX === "scroll";
    const scrollbarWidth = Math.max(0, win.innerWidth - body.clientWidth);
    const scrollbarHeight = Math.max(0, win.innerHeight - body.clientHeight);
    const marginY = parseFloat(bodyStyles.marginTop) + parseFloat(bodyStyles.marginBottom);
    const marginX = parseFloat(bodyStyles.marginLeft) + parseFloat(bodyStyles.marginRight);
    const elementToLock = isOverflowElement(html) ? html : body;
    updateGutterOnly = supportsStableScrollbarGutter(referenceElement);
    if (updateGutterOnly) {
      html.style.scrollbarGutter = scrollbarGutterValue;
      elementToLock.style.overflowY = "hidden";
      elementToLock.style.overflowX = "hidden";
      return;
    }
    Object.assign(html.style, {
      scrollbarGutter: scrollbarGutterValue,
      overflowY: "hidden",
      overflowX: "hidden"
    });
    if (isScrollableY || hasConstantOverflowY) {
      html.style.overflowY = "scroll";
    }
    if (isScrollableX || hasConstantOverflowX) {
      html.style.overflowX = "scroll";
    }
    Object.assign(body.style, {
      position: "relative",
      height: marginY || scrollbarHeight ? `calc(100dvh - ${marginY + scrollbarHeight}px)` : "100dvh",
      width: marginX || scrollbarWidth ? `calc(100vw - ${marginX + scrollbarWidth}px)` : "100vw",
      boxSizing: "border-box",
      overflow: "hidden",
      scrollBehavior: "unset"
    });
    body.scrollTop = scrollTop;
    body.scrollLeft = scrollLeft;
    html.setAttribute("data-base-ui-scroll-locked", "");
    html.style.scrollBehavior = "unset";
  }
  function cleanup() {
    Object.assign(html.style, originalHtmlStyles);
    Object.assign(body.style, originalBodyStyles);
    if (!updateGutterOnly) {
      html.scrollTop = scrollTop;
      html.scrollLeft = scrollLeft;
      html.removeAttribute("data-base-ui-scroll-locked");
      html.style.scrollBehavior = originalHtmlScrollBehavior;
    }
  }
  function handleResize() {
    cleanup();
    resizeFrame.request(lockScroll);
  }
  lockScroll();
  const unsubscribeResize = addEventListener(win, "resize", handleResize);
  return () => {
    resizeFrame.cancel();
    cleanup();
    if (typeof win.removeEventListener === "function") {
      unsubscribeResize();
    }
  };
}
var ScrollLocker = class {
  lockCount = 0;
  restore = null;
  timeoutLock = Timeout.create();
  timeoutUnlock = Timeout.create();
  acquire(referenceElement) {
    this.lockCount += 1;
    if (this.lockCount === 1 && this.restore === null) {
      this.timeoutLock.start(0, () => this.lock(referenceElement));
    }
    return this.release;
  }
  release = () => {
    this.lockCount -= 1;
    if (this.lockCount === 0 && this.restore) {
      this.timeoutUnlock.start(0, this.unlock);
    }
  };
  unlock = () => {
    if (this.lockCount === 0 && this.restore) {
      this.restore?.();
      this.restore = null;
    }
  };
  lock(referenceElement) {
    if (this.lockCount === 0 || this.restore !== null) {
      return;
    }
    const doc = ownerDocument(referenceElement);
    const html = doc.documentElement;
    const htmlOverflowY = getWindow(html).getComputedStyle(html).overflowY;
    if (htmlOverflowY === "hidden" || htmlOverflowY === "clip") {
      this.restore = NOOP;
      return;
    }
    const hasOverlayScrollbars = parts_exports.os.ios || !hasInsetScrollbars(referenceElement);
    this.restore = hasOverlayScrollbars ? preventScrollOverlayScrollbars(referenceElement) : preventScrollInsetScrollbars(referenceElement);
  }
};
var SCROLL_LOCKER = new ScrollLocker();
function useScrollLock(enabled = true, referenceElement = null) {
  useIsoLayoutEffect(() => {
    if (!enabled) {
      return void 0;
    }
    return SCROLL_LOCKER.acquire(referenceElement);
  }, [enabled, referenceElement]);
}

// node_modules/@base-ui/react/floating-ui-react/components/FloatingDelayGroup.mjs
var React16 = __toESM(require_react(), 1);

// node_modules/@base-ui/react/floating-ui-react/utils/event.mjs
function stopEvent(event) {
  event.preventDefault();
  event.stopPropagation();
}
function isReactEvent(event) {
  return "nativeEvent" in event;
}
function isVirtualClick(event) {
  if (event.pointerType === "" && event.isTrusted) {
    return true;
  }
  if (parts_exports.os.android && event.pointerType) {
    return event.type === "click" && event.buttons === 1;
  }
  return event.detail === 0 && !event.pointerType;
}
function isVirtualPointerEvent(event) {
  if (parts_exports.env.jsdom) {
    return false;
  }
  return !parts_exports.os.android && event.width === 0 && event.height === 0 || parts_exports.os.android && event.width === 1 && event.height === 1 && event.pressure === 0 && event.detail === 0 && event.pointerType === "mouse" || // iOS VoiceOver returns 0.333• for width/height.
  event.width < 1 && event.height < 1 && event.pressure === 0 && event.detail === 0 && event.pointerType === "touch";
}
function isMouseLikePointerType(pointerType, strict) {
  const values = ["mouse", "pen"];
  if (!strict) {
    values.push("", void 0);
  }
  return values.includes(pointerType);
}
function isClickLikeEvent(event) {
  const type = event.type;
  return type === "click" || type === "mousedown" || type === "keydown" || type === "keyup";
}

// node_modules/@base-ui/react/floating-ui-react/utils/constants.mjs
var FOCUSABLE_ATTRIBUTE = "data-base-ui-focusable";
var TYPEABLE_SELECTOR = "input:not([type='hidden']):not([disabled]),[contenteditable]:not([contenteditable='false']),textarea:not([disabled])";

// node_modules/@base-ui/react/internals/shadowDom.mjs
function activeElement(doc) {
  let element = doc.activeElement;
  while (element?.shadowRoot?.activeElement != null) {
    element = element.shadowRoot.activeElement;
  }
  return element;
}
function contains(parent, child) {
  if (!parent || !child) {
    return false;
  }
  const rootNode = child.getRootNode?.();
  if (parent.contains(child)) {
    return true;
  }
  if (rootNode && isShadowRoot(rootNode)) {
    let next = child;
    while (next) {
      if (parent === next) {
        return true;
      }
      next = next.parentNode || next.host;
    }
  }
  return false;
}
function getTarget(event) {
  if ("composedPath" in event) {
    return event.composedPath()[0];
  }
  return event.target;
}

// node_modules/@base-ui/react/floating-ui-react/utils/element.mjs
function isTargetInsideEnabledTrigger(target, triggerElements) {
  if (!isElement(target)) {
    return false;
  }
  const targetElement = target;
  if (triggerElements.hasElement(targetElement)) {
    return !targetElement.hasAttribute("data-trigger-disabled");
  }
  for (const [, trigger] of triggerElements.entries()) {
    if (contains(trigger, targetElement)) {
      return !trigger.hasAttribute("data-trigger-disabled");
    }
  }
  return false;
}
function isEventTargetWithin(event, node) {
  if (node == null) {
    return false;
  }
  if ("composedPath" in event) {
    return event.composedPath().includes(node);
  }
  const eventAgain = event;
  return eventAgain.target != null && node.contains(eventAgain.target);
}
function isRootElement(element) {
  return element.matches("html,body");
}
function isTypeableElement(element) {
  return isHTMLElement(element) && element.matches(TYPEABLE_SELECTOR);
}
function isInteractiveElement(element) {
  return element?.closest(`button,a[href],[role="button"],select,[tabindex]:not([tabindex="-1"]),${TYPEABLE_SELECTOR}`) != null;
}
function isTypeableCombobox(element) {
  if (!element) {
    return false;
  }
  return element.getAttribute("role") === "combobox" && isTypeableElement(element);
}
function matchesFocusVisible(element) {
  if (!element || parts_exports.env.jsdom) {
    return true;
  }
  try {
    return element.matches(":focus-visible");
  } catch (_e) {
    return true;
  }
}
function getFloatingFocusElement(floatingElement) {
  if (!floatingElement) {
    return null;
  }
  return floatingElement.hasAttribute(FOCUSABLE_ATTRIBUTE) ? floatingElement : floatingElement.querySelector(`[${FOCUSABLE_ATTRIBUTE}]`) || floatingElement;
}

// node_modules/@base-ui/react/floating-ui-react/hooks/useHoverShared.mjs
function resolveValue(value, pointerType) {
  if (pointerType != null && !isMouseLikePointerType(pointerType)) {
    return 0;
  }
  if (typeof value === "function") {
    return value();
  }
  return value;
}
function getDelay(value, prop, pointerType) {
  const result = resolveValue(value, pointerType);
  if (typeof result === "number") {
    return result;
  }
  return result?.[prop];
}
function getRestMs(value) {
  if (typeof value === "function") {
    return value();
  }
  return value;
}
function isClickLikeOpenEvent(openEventType, interactedInside) {
  return interactedInside || openEventType === "click" || openEventType === "mousedown";
}
function isHoverOpenEvent(openEventType) {
  return openEventType?.includes("mouse") && openEventType !== "mousedown";
}

// node_modules/@base-ui/react/floating-ui-react/components/FloatingDelayGroup.mjs
var import_jsx_runtime = __toESM(require_jsx_runtime(), 1);
var FloatingDelayGroupContext = /* @__PURE__ */ React16.createContext({
  hasProvider: false,
  timeoutMs: 0,
  delayRef: {
    current: 0
  },
  initialDelayRef: {
    current: 0
  },
  timeout: new Timeout(),
  currentIdRef: {
    current: null
  },
  currentContextRef: {
    current: null
  }
});
if (true) FloatingDelayGroupContext.displayName = "FloatingDelayGroupContext";
function resetDelayRef(delayRef, initialDelayRef) {
  delayRef.current = initialDelayRef.current;
}
function FloatingDelayGroup(props) {
  const {
    children,
    delay,
    timeoutMs = 0
  } = props;
  const delayRef = React16.useRef(delay);
  const initialDelayRef = React16.useRef(delay);
  const currentIdRef = React16.useRef(null);
  const currentContextRef = React16.useRef(null);
  const timeout = useTimeout();
  useIsoLayoutEffect(() => {
    initialDelayRef.current = delay;
    if (!currentIdRef.current) {
      delayRef.current = delay;
      return;
    }
    delayRef.current = {
      open: getDelay(delayRef.current, "open"),
      close: getDelay(delay, "close")
    };
  }, [delay, currentIdRef, delayRef, initialDelayRef]);
  return /* @__PURE__ */ (0, import_jsx_runtime.jsx)(FloatingDelayGroupContext.Provider, {
    value: React16.useMemo(() => ({
      hasProvider: true,
      delayRef,
      initialDelayRef,
      currentIdRef,
      timeoutMs,
      currentContextRef,
      timeout
    }), [timeoutMs, timeout]),
    children
  });
}
function useDelayGroup(context, options = {
  open: false
}) {
  const {
    open
  } = options;
  const store = "rootStore" in context ? context.rootStore : context;
  const floatingId = store.useState("floatingId");
  const groupContext = React16.useContext(FloatingDelayGroupContext);
  const {
    currentIdRef,
    delayRef,
    timeoutMs,
    initialDelayRef,
    currentContextRef,
    hasProvider,
    timeout
  } = groupContext;
  const [isInstantPhase, setIsInstantPhase] = React16.useState(false);
  const openRef = React16.useRef(open);
  const isUnmountedRef = React16.useRef(false);
  useIsoLayoutEffect(() => {
    openRef.current = open;
  }, [open]);
  useIsoLayoutEffect(() => {
    return () => {
      isUnmountedRef.current = true;
    };
  }, []);
  useIsoLayoutEffect(() => {
    function unset() {
      if (!isUnmountedRef.current) {
        setIsInstantPhase(false);
      }
      currentContextRef.current?.setIsInstantPhase(false);
      currentIdRef.current = null;
      currentContextRef.current = null;
      delayRef.current = initialDelayRef.current;
      timeout.clear();
    }
    if (!currentIdRef.current) {
      return void 0;
    }
    if (!open && currentIdRef.current === floatingId) {
      setIsInstantPhase(false);
      if (timeoutMs) {
        const closingId = floatingId;
        timeout.start(timeoutMs, () => {
          if (store.select("open") || currentIdRef.current && currentIdRef.current !== closingId) {
            return;
          }
          unset();
        });
        return () => {
          if (openRef.current || currentIdRef.current !== closingId) {
            timeout.clear();
          }
        };
      }
      unset();
    }
    return void 0;
  }, [open, floatingId, currentIdRef, delayRef, timeoutMs, initialDelayRef, currentContextRef, timeout, store]);
  useIsoLayoutEffect(() => {
    if (!open) {
      return;
    }
    const prevContext = currentContextRef.current;
    const prevId = currentIdRef.current;
    timeout.clear();
    currentContextRef.current = {
      onOpenChange: store.setOpen,
      setIsInstantPhase
    };
    currentIdRef.current = floatingId;
    delayRef.current = {
      open: 0,
      close: getDelay(initialDelayRef.current, "close")
    };
    if (prevId !== null && prevId !== floatingId) {
      setIsInstantPhase(true);
      prevContext?.setIsInstantPhase(true);
      prevContext?.onOpenChange(false, createChangeEventDetails(reason_parts_exports.none));
    } else {
      setIsInstantPhase(false);
      prevContext?.setIsInstantPhase(false);
    }
  }, [open, floatingId, store, currentIdRef, delayRef, initialDelayRef, currentContextRef, timeout]);
  useIsoLayoutEffect(() => {
    return () => {
      if (currentIdRef.current === floatingId) {
        currentContextRef.current = null;
        if (!openRef.current) {
          return;
        }
        currentIdRef.current = null;
        resetDelayRef(delayRef, initialDelayRef);
        timeout.clear();
      }
    };
  }, [currentContextRef, currentIdRef, delayRef, floatingId, initialDelayRef, timeout]);
  return React16.useMemo(() => ({
    hasProvider,
    delayRef,
    isInstantPhase
  }), [hasProvider, delayRef, isInstantPhase]);
}

// node_modules/@base-ui/react/floating-ui-react/components/FloatingFocusManager.mjs
var React20 = __toESM(require_react(), 1);

// node_modules/@base-ui/utils/mergeCleanups.mjs
function mergeCleanups(...cleanups) {
  return () => {
    for (let i = 0; i < cleanups.length; i += 1) {
      const cleanup = cleanups[i];
      if (cleanup) {
        cleanup();
      }
    }
  };
}

// node_modules/@base-ui/react/utils/FocusGuard.mjs
var React17 = __toESM(require_react(), 1);

// node_modules/@base-ui/utils/visuallyHidden.mjs
var visuallyHiddenBase = {
  clipPath: "inset(50%)",
  overflow: "hidden",
  whiteSpace: "nowrap",
  border: 0,
  padding: 0,
  width: 1,
  height: 1,
  margin: -1
};
var visuallyHidden = {
  ...visuallyHiddenBase,
  position: "fixed",
  top: 0,
  left: 0
};
var visuallyHiddenInput = {
  ...visuallyHiddenBase,
  position: "absolute"
};

// node_modules/@base-ui/react/utils/FocusGuard.mjs
var import_jsx_runtime2 = __toESM(require_jsx_runtime(), 1);
var FocusGuard = /* @__PURE__ */ React17.forwardRef(function FocusGuard2(props, ref) {
  const [role, setRole] = React17.useState();
  useIsoLayoutEffect(() => {
    if (parts_exports.screenReader.voiceOver && parts_exports.engine.webkit) {
      setRole("button");
    }
  }, []);
  const restProps = {
    tabIndex: 0,
    // Role is only for VoiceOver
    role
  };
  return /* @__PURE__ */ (0, import_jsx_runtime2.jsx)("span", {
    ...props,
    ref,
    style: visuallyHidden,
    "aria-hidden": role ? void 0 : true,
    ...restProps,
    "data-base-ui-focus-guard": ""
  });
});
if (true) FocusGuard.displayName = "FocusGuard";

// node_modules/@floating-ui/utils/dist/floating-ui.utils.mjs
var sides = ["top", "right", "bottom", "left"];
var min = Math.min;
var max = Math.max;
var round = Math.round;
var floor = Math.floor;
var createCoords = (v) => ({
  x: v,
  y: v
});
var oppositeSideMap = {
  left: "right",
  right: "left",
  bottom: "top",
  top: "bottom"
};
function clamp(start, value, end) {
  return max(start, min(value, end));
}
function evaluate(value, param) {
  return typeof value === "function" ? value(param) : value;
}
function getSide(placement) {
  return placement.split("-")[0];
}
function getAlignment(placement) {
  return placement.split("-")[1];
}
function getOppositeAxis(axis) {
  return axis === "x" ? "y" : "x";
}
function getAxisLength(axis) {
  return axis === "y" ? "height" : "width";
}
function getSideAxis(placement) {
  const firstChar = placement[0];
  return firstChar === "t" || firstChar === "b" ? "y" : "x";
}
function getAlignmentAxis(placement) {
  return getOppositeAxis(getSideAxis(placement));
}
function getAlignmentSides(placement, rects, rtl) {
  if (rtl === void 0) {
    rtl = false;
  }
  const alignment = getAlignment(placement);
  const alignmentAxis = getAlignmentAxis(placement);
  const length = getAxisLength(alignmentAxis);
  let mainAlignmentSide = alignmentAxis === "x" ? alignment === (rtl ? "end" : "start") ? "right" : "left" : alignment === "start" ? "bottom" : "top";
  if (rects.reference[length] > rects.floating[length]) {
    mainAlignmentSide = getOppositePlacement(mainAlignmentSide);
  }
  return [mainAlignmentSide, getOppositePlacement(mainAlignmentSide)];
}
function getExpandedPlacements(placement) {
  const oppositePlacement = getOppositePlacement(placement);
  return [getOppositeAlignmentPlacement(placement), oppositePlacement, getOppositeAlignmentPlacement(oppositePlacement)];
}
function getOppositeAlignmentPlacement(placement) {
  return placement.includes("start") ? placement.replace("start", "end") : placement.replace("end", "start");
}
var lrPlacement = ["left", "right"];
var rlPlacement = ["right", "left"];
var tbPlacement = ["top", "bottom"];
var btPlacement = ["bottom", "top"];
function getSideList(side, isStart, rtl) {
  switch (side) {
    case "top":
    case "bottom":
      if (rtl) return isStart ? rlPlacement : lrPlacement;
      return isStart ? lrPlacement : rlPlacement;
    case "left":
    case "right":
      return isStart ? tbPlacement : btPlacement;
    default:
      return [];
  }
}
function getOppositeAxisPlacements(placement, flipAlignment, direction, rtl) {
  const alignment = getAlignment(placement);
  let list = getSideList(getSide(placement), direction === "start", rtl);
  if (alignment) {
    list = list.map((side) => side + "-" + alignment);
    if (flipAlignment) {
      list = list.concat(list.map(getOppositeAlignmentPlacement));
    }
  }
  return list;
}
function getOppositePlacement(placement) {
  const side = getSide(placement);
  return oppositeSideMap[side] + placement.slice(side.length);
}
function expandPaddingObject(padding) {
  return {
    top: 0,
    right: 0,
    bottom: 0,
    left: 0,
    ...padding
  };
}
function getPaddingObject(padding) {
  return typeof padding !== "number" ? expandPaddingObject(padding) : {
    top: padding,
    right: padding,
    bottom: padding,
    left: padding
  };
}
function rectToClientRect(rect) {
  const {
    x,
    y,
    width,
    height
  } = rect;
  return {
    width,
    height,
    top: y,
    left: x,
    right: x + width,
    bottom: y + height,
    x,
    y
  };
}

// node_modules/@base-ui/react/floating-ui-react/utils/composite.mjs
function isHiddenByStyles(styles) {
  return styles.visibility === "hidden" || styles.visibility === "collapse";
}
function isElementVisible(element, styles = element ? getComputedStyle2(element) : null) {
  if (!element || !element.isConnected || !styles || isHiddenByStyles(styles)) {
    return false;
  }
  if (typeof element.checkVisibility === "function") {
    return element.checkVisibility();
  }
  return styles.display !== "none" && styles.display !== "contents";
}

// node_modules/@base-ui/react/floating-ui-react/utils/tabbable.mjs
var CANDIDATE_SELECTOR = 'a[href],button,input,select,textarea,summary,details,iframe,object,embed,[tabindex],[contenteditable]:not([contenteditable="false"]),audio[controls],video[controls]';
function getParentElement(element) {
  const assignedSlot = element.assignedSlot;
  if (assignedSlot) {
    return assignedSlot;
  }
  if (element.parentElement) {
    return element.parentElement;
  }
  const rootNode = element.getRootNode();
  return isShadowRoot(rootNode) ? rootNode.host : null;
}
function getDetailsSummary(details) {
  for (const child of Array.from(details.children)) {
    if (getNodeName(child) === "summary") {
      return child;
    }
  }
  return null;
}
function isWithinOpenDetailsSummary(element, details) {
  const summary = getDetailsSummary(details);
  return !!summary && (element === summary || contains(summary, element));
}
function isFocusableCandidate(element) {
  const nodeName = element ? getNodeName(element) : "";
  return element != null && element.matches(CANDIDATE_SELECTOR) && (nodeName !== "summary" || element.parentElement != null && getNodeName(element.parentElement) === "details" && getDetailsSummary(element.parentElement) === element) && (nodeName !== "details" || getDetailsSummary(element) == null) && (nodeName !== "input" || element.type !== "hidden");
}
function isFocusableElement(element) {
  if (!isFocusableCandidate(element) || !element.isConnected || element.matches(":disabled")) {
    return false;
  }
  for (let current = element; current; current = getParentElement(current)) {
    const isAncestor = current !== element;
    const isSlot = getNodeName(current) === "slot";
    if (current.hasAttribute("inert")) {
      return false;
    }
    if (isAncestor && getNodeName(current) === "details" && !current.open && !isWithinOpenDetailsSummary(element, current) || current.hasAttribute("hidden") || !isSlot && !isVisibleInTabbableTree(current, isAncestor)) {
      return false;
    }
  }
  return true;
}
function isVisibleInTabbableTree(element, isAncestor) {
  const styles = getComputedStyle2(element);
  if (!isAncestor) {
    return isElementVisible(element, styles);
  }
  return styles.display !== "none";
}
function getTabIndex(element) {
  const tabIndex = element.tabIndex;
  if (tabIndex < 0) {
    const nodeName = getNodeName(element);
    if (nodeName === "details" || nodeName === "audio" || nodeName === "video" || isHTMLElement(element) && element.isContentEditable) {
      return 0;
    }
  }
  return tabIndex;
}
function getNamedRadioInput(element) {
  if (getNodeName(element) !== "input") {
    return null;
  }
  const input = element;
  return input.type === "radio" && input.name !== "" ? input : null;
}
function isTabbableRadio(element, candidates) {
  const input = getNamedRadioInput(element);
  if (!input) {
    return true;
  }
  const checkedRadio = candidates.find((candidate) => {
    const radio = getNamedRadioInput(candidate);
    return radio?.name === input.name && radio.form === input.form && radio.checked;
  });
  if (checkedRadio) {
    return checkedRadio === input;
  }
  return candidates.find((candidate) => {
    const radio = getNamedRadioInput(candidate);
    return radio?.name === input.name && radio.form === input.form;
  }) === input;
}
function getComposedChildren(container) {
  if (isHTMLElement(container) && getNodeName(container) === "slot") {
    const assignedElements = container.assignedElements({
      flatten: true
    });
    if (assignedElements.length > 0) {
      return assignedElements;
    }
  }
  if (isHTMLElement(container) && container.shadowRoot) {
    return Array.from(container.shadowRoot.children);
  }
  return Array.from(container.children);
}
function appendCandidates(container, list) {
  getComposedChildren(container).forEach((child) => {
    if (isFocusableCandidate(child)) {
      list.push(child);
    }
    appendCandidates(child, list);
  });
}
function appendMatchingElements(container, selector, list) {
  getComposedChildren(container).forEach((child) => {
    if (isHTMLElement(child) && child.matches(selector)) {
      list.push(child);
    }
    appendMatchingElements(child, selector, list);
  });
}
function isTabbable(element) {
  return isFocusableElement(element) && getTabIndex(element) >= 0;
}
function focusable(container) {
  const candidates = [];
  appendCandidates(container, candidates);
  return candidates.filter(isFocusableElement);
}
function tabbable(container) {
  const candidates = focusable(container);
  return candidates.filter((element) => getTabIndex(element) >= 0 && isTabbableRadio(element, candidates));
}
function getTabbableIn(container, dir) {
  const list = tabbable(container);
  const len = list.length;
  if (len === 0) {
    return void 0;
  }
  const active = activeElement(ownerDocument(container));
  const index2 = list.indexOf(active);
  const nextIndex = index2 === -1 ? dir === 1 ? 0 : len - 1 : index2 + dir;
  return list[nextIndex];
}
function getNextTabbable(referenceElement) {
  return getTabbableIn(ownerDocument(referenceElement).body, 1) || referenceElement;
}
function getPreviousTabbable(referenceElement) {
  return getTabbableIn(ownerDocument(referenceElement).body, -1) || referenceElement;
}
function getTabbableNearElement(referenceElement, dir) {
  if (!referenceElement) {
    return null;
  }
  const list = tabbable(ownerDocument(referenceElement).body);
  const elementCount = list.length;
  if (elementCount === 0) {
    return null;
  }
  const index2 = list.indexOf(referenceElement);
  if (index2 === -1) {
    return null;
  }
  const nextIndex = (index2 + dir + elementCount) % elementCount;
  return list[nextIndex];
}
function getTabbableAfterElement(referenceElement) {
  return getTabbableNearElement(referenceElement, 1);
}
function getTabbableBeforeElement(referenceElement) {
  return getTabbableNearElement(referenceElement, -1);
}
function isOutsideEvent(event, container) {
  const containerElement = container || event.currentTarget;
  const relatedTarget = event.relatedTarget;
  return !relatedTarget || !contains(containerElement, relatedTarget);
}
function disableFocusInside(container) {
  const tabbableElements = tabbable(container);
  tabbableElements.forEach((element) => {
    element.dataset.tabindex = element.getAttribute("tabindex") || "";
    element.setAttribute("tabindex", "-1");
  });
}
function enableFocusInside(container) {
  const elements = [];
  appendMatchingElements(container, "[data-tabindex]", elements);
  elements.forEach((element) => {
    const tabindex = element.dataset.tabindex;
    delete element.dataset.tabindex;
    if (tabindex) {
      element.setAttribute("tabindex", tabindex);
    } else {
      element.removeAttribute("tabindex");
    }
  });
}

// node_modules/@base-ui/react/floating-ui-react/utils/nodes.mjs
function getNodeChildren(nodes, id, onlyOpenChildren = true) {
  const directChildren = nodes.filter((node) => node.parentId === id);
  return directChildren.flatMap((child) => [...!onlyOpenChildren || child.context?.open ? [child] : [], ...getNodeChildren(nodes, child.id, onlyOpenChildren)]);
}
function getNodeAncestors(nodes, id) {
  let allAncestors = [];
  let currentParentId = nodes.find((node) => node.id === id)?.parentId;
  while (currentParentId) {
    const currentNode = nodes.find((node) => node.id === currentParentId);
    currentParentId = currentNode?.parentId;
    if (currentNode) {
      allAncestors = allAncestors.concat(currentNode);
    }
  }
  return allAncestors;
}

// node_modules/@base-ui/react/floating-ui-react/utils/createAttribute.mjs
function createAttribute(name) {
  return `data-base-ui-${name}`;
}

// node_modules/@base-ui/react/floating-ui-react/utils/enqueueFocus.mjs
var rafId = 0;
function enqueueFocus(el, options = {}) {
  const {
    preventScroll = false,
    sync = false,
    shouldFocus
  } = options;
  cancelAnimationFrame(rafId);
  function exec() {
    if (shouldFocus && !shouldFocus()) {
      return;
    }
    el?.focus({
      preventScroll
    });
  }
  if (sync) {
    exec();
    return NOOP;
  }
  const currentRafId = requestAnimationFrame(exec);
  rafId = currentRafId;
  return () => {
    if (rafId === currentRafId) {
      cancelAnimationFrame(currentRafId);
      rafId = 0;
    }
  };
}

// node_modules/@base-ui/react/floating-ui-react/utils/markOthers.mjs
var counters = {
  inert: /* @__PURE__ */ new WeakMap(),
  "aria-hidden": /* @__PURE__ */ new WeakMap()
};
var markerName = "data-base-ui-inert";
var uncontrolledElementsSets = {
  inert: /* @__PURE__ */ new WeakSet(),
  "aria-hidden": /* @__PURE__ */ new WeakSet()
};
var markerCounterMap = /* @__PURE__ */ new WeakMap();
var lockCount = 0;
function getUncontrolledElementsSet(controlAttribute) {
  return uncontrolledElementsSets[controlAttribute];
}
function unwrapHost(node) {
  if (!node) {
    return null;
  }
  return isShadowRoot(node) ? node.host : unwrapHost(node.parentNode);
}
var correctElements = (parent, targets) => targets.map((target) => {
  if (parent.contains(target)) {
    return target;
  }
  const correctedTarget = unwrapHost(target);
  if (parent.contains(correctedTarget)) {
    return correctedTarget;
  }
  return null;
}).filter((x) => x != null);
var buildKeepSet = (targets) => {
  const keep = /* @__PURE__ */ new Set();
  targets.forEach((target) => {
    let node = target;
    while (node && !keep.has(node)) {
      keep.add(node);
      node = node.parentNode;
    }
  });
  return keep;
};
var collectOutsideElements = (root, keepElements, stopElements) => {
  const outside = [];
  const walk = (parent) => {
    if (!parent || stopElements.has(parent)) {
      return;
    }
    Array.from(parent.children).forEach((node) => {
      if (getNodeName(node) === "script") {
        return;
      }
      if (keepElements.has(node)) {
        walk(node);
      } else {
        outside.push(node);
      }
    });
  };
  walk(root);
  return outside;
};
function applyAttributeToOthers(uncorrectedAvoidElements, body, ariaHidden, inert, {
  mark = true
}) {
  let controlAttribute = null;
  if (inert) {
    controlAttribute = "inert";
  } else if (ariaHidden) {
    controlAttribute = "aria-hidden";
  }
  let counterMap = null;
  let uncontrolledElementsSet = null;
  const avoidElements = correctElements(body, uncorrectedAvoidElements);
  const markerTargets = mark ? collectOutsideElements(body, buildKeepSet(avoidElements), new Set(avoidElements)) : [];
  const hiddenElements = [];
  const markedElements = [];
  if (controlAttribute) {
    const map = counters[controlAttribute];
    const currentUncontrolledElementsSet = getUncontrolledElementsSet(controlAttribute);
    uncontrolledElementsSet = currentUncontrolledElementsSet;
    counterMap = map;
    const ariaLiveElements = correctElements(body, Array.from(body.querySelectorAll("[aria-live]")));
    const controlElements = avoidElements.concat(ariaLiveElements);
    const controlTargets = collectOutsideElements(body, buildKeepSet(controlElements), new Set(controlElements));
    controlTargets.forEach((node) => {
      const attr2 = node.getAttribute(controlAttribute);
      const alreadyHidden = attr2 !== null && attr2 !== "false";
      const counterValue = (map.get(node) || 0) + 1;
      map.set(node, counterValue);
      hiddenElements.push(node);
      if (counterValue === 1 && alreadyHidden) {
        currentUncontrolledElementsSet.add(node);
      }
      if (!alreadyHidden) {
        node.setAttribute(controlAttribute, controlAttribute === "inert" ? "" : "true");
      }
    });
  }
  if (mark) {
    markerTargets.forEach((node) => {
      const markerValue = (markerCounterMap.get(node) || 0) + 1;
      markerCounterMap.set(node, markerValue);
      markedElements.push(node);
      if (markerValue === 1) {
        node.setAttribute(markerName, "");
      }
    });
  }
  lockCount += 1;
  return () => {
    if (counterMap) {
      hiddenElements.forEach((element) => {
        const currentCounterValue = counterMap.get(element) || 0;
        const counterValue = currentCounterValue - 1;
        counterMap.set(element, counterValue);
        if (!counterValue) {
          if (!uncontrolledElementsSet?.has(element) && controlAttribute) {
            element.removeAttribute(controlAttribute);
          }
          uncontrolledElementsSet?.delete(element);
        }
      });
    }
    if (mark) {
      markedElements.forEach((element) => {
        const markerValue = (markerCounterMap.get(element) || 0) - 1;
        markerCounterMap.set(element, markerValue);
        if (!markerValue) {
          element.removeAttribute(markerName);
        }
      });
    }
    lockCount -= 1;
    if (!lockCount) {
      counters.inert = /* @__PURE__ */ new WeakMap();
      counters["aria-hidden"] = /* @__PURE__ */ new WeakMap();
      uncontrolledElementsSets.inert = /* @__PURE__ */ new WeakSet();
      uncontrolledElementsSets["aria-hidden"] = /* @__PURE__ */ new WeakSet();
      markerCounterMap = /* @__PURE__ */ new WeakMap();
    }
  };
}
function markOthers(avoidElements, options = {}) {
  const {
    ariaHidden = false,
    inert = false,
    mark = true
  } = options;
  const body = ownerDocument(avoidElements[0]).body;
  return applyAttributeToOthers(avoidElements, body, ariaHidden, inert, {
    mark
  });
}

// node_modules/@base-ui/react/floating-ui-react/components/FloatingPortal.mjs
var React18 = __toESM(require_react(), 1);
var ReactDOM2 = __toESM(require_react_dom(), 1);

// node_modules/@base-ui/react/internals/constants.mjs
var PATIENT_CLICK_THRESHOLD = 500;
var DISABLED_TRANSITIONS_STYLE = {
  style: {
    transition: "none"
  }
};
var CLICK_TRIGGER_IDENTIFIER = "data-base-ui-click-trigger";
var BASE_UI_SWIPE_IGNORE_ATTRIBUTE = "data-base-ui-swipe-ignore";
var LEGACY_SWIPE_IGNORE_ATTRIBUTE = "data-swipe-ignore";
var BASE_UI_SWIPE_IGNORE_SELECTOR = `[${BASE_UI_SWIPE_IGNORE_ATTRIBUTE}]`;
var LEGACY_SWIPE_IGNORE_SELECTOR = `[${LEGACY_SWIPE_IGNORE_ATTRIBUTE}]`;
var POPUP_COLLISION_AVOIDANCE = {
  fallbackAxisSide: "end"
};
var ownerVisuallyHidden = {
  clipPath: "inset(50%)",
  position: "fixed",
  top: 0,
  left: 0
};

// node_modules/@base-ui/react/floating-ui-react/components/FloatingPortal.mjs
var import_jsx_runtime3 = __toESM(require_jsx_runtime(), 1);
var PortalContext = /* @__PURE__ */ React18.createContext(null);
if (true) PortalContext.displayName = "PortalContext";
var usePortalContext = () => React18.useContext(PortalContext);
var attr = createAttribute("portal");
function useFloatingPortalNode(props = {}) {
  const {
    ref,
    container: containerProp,
    componentProps = EMPTY_OBJECT,
    elementProps
  } = props;
  const uniqueId = useId();
  const portalContext = usePortalContext();
  const parentPortalNode = portalContext?.portalNode;
  const [containerElement, setContainerElement] = React18.useState(null);
  const [portalNode, setPortalNode] = React18.useState(null);
  const setPortalNodeRef = useStableCallback((node) => {
    if (node !== null) {
      setPortalNode(node);
    }
  });
  const containerRef = React18.useRef(null);
  useIsoLayoutEffect(() => {
    if (containerProp === null) {
      if (containerRef.current) {
        containerRef.current = null;
        setPortalNode(null);
        setContainerElement(null);
      }
      return;
    }
    if (uniqueId == null) {
      return;
    }
    const resolvedContainer = (containerProp && (isNode(containerProp) ? containerProp : containerProp.current)) ?? parentPortalNode ?? document.body;
    if (resolvedContainer == null) {
      if (containerRef.current) {
        containerRef.current = null;
        setPortalNode(null);
        setContainerElement(null);
      }
      return;
    }
    if (containerRef.current !== resolvedContainer) {
      containerRef.current = resolvedContainer;
      setPortalNode(null);
      setContainerElement(resolvedContainer);
    }
  }, [containerProp, parentPortalNode, uniqueId]);
  const portalElement = useRenderElement("div", componentProps, {
    ref: [ref, setPortalNodeRef],
    props: [{
      id: uniqueId,
      [attr]: ""
    }, elementProps]
  });
  const portalSubtree = containerElement && portalElement ? /* @__PURE__ */ ReactDOM2.createPortal(portalElement, containerElement) : null;
  return {
    portalNode,
    portalSubtree
  };
}
var FloatingPortal = /* @__PURE__ */ React18.forwardRef(function FloatingPortal2(componentProps, forwardedRef) {
  const {
    render,
    className,
    style,
    children,
    container,
    renderGuards,
    ...elementProps
  } = componentProps;
  const {
    portalNode,
    portalSubtree
  } = useFloatingPortalNode({
    container,
    ref: forwardedRef,
    componentProps,
    elementProps
  });
  const beforeOutsideRef = React18.useRef(null);
  const afterOutsideRef = React18.useRef(null);
  const beforeInsideRef = React18.useRef(null);
  const afterInsideRef = React18.useRef(null);
  const [focusManagerState, setFocusManagerState] = React18.useState(null);
  const focusInsideDisabledRef = React18.useRef(false);
  const modal = focusManagerState?.modal;
  const open = focusManagerState?.open;
  const shouldRenderGuards = typeof renderGuards === "boolean" ? renderGuards : !!focusManagerState && !focusManagerState.modal && focusManagerState.open && !!portalNode;
  React18.useEffect(() => {
    if (!portalNode || modal) {
      return void 0;
    }
    function onFocus(event) {
      if (portalNode && event.relatedTarget && isOutsideEvent(event)) {
        if (event.type === "focusin") {
          if (focusInsideDisabledRef.current) {
            enableFocusInside(portalNode);
            focusInsideDisabledRef.current = false;
          }
        } else {
          disableFocusInside(portalNode);
          focusInsideDisabledRef.current = true;
        }
      }
    }
    return mergeCleanups(addEventListener(portalNode, "focusin", onFocus, true), addEventListener(portalNode, "focusout", onFocus, true));
  }, [portalNode, modal]);
  useIsoLayoutEffect(() => {
    if (!portalNode || open !== true || !focusInsideDisabledRef.current) {
      return;
    }
    enableFocusInside(portalNode);
    focusInsideDisabledRef.current = false;
  }, [open, portalNode]);
  const portalContextValue = React18.useMemo(() => ({
    beforeOutsideRef,
    afterOutsideRef,
    beforeInsideRef,
    afterInsideRef,
    portalNode,
    setFocusManagerState
  }), [portalNode]);
  return /* @__PURE__ */ (0, import_jsx_runtime3.jsxs)(React18.Fragment, {
    children: [portalSubtree, /* @__PURE__ */ (0, import_jsx_runtime3.jsxs)(PortalContext.Provider, {
      value: portalContextValue,
      children: [shouldRenderGuards && portalNode && /* @__PURE__ */ (0, import_jsx_runtime3.jsx)(FocusGuard, {
        "data-type": "outside",
        ref: beforeOutsideRef,
        onFocus: (event) => {
          if (isOutsideEvent(event, portalNode)) {
            beforeInsideRef.current?.focus();
          } else {
            const domReference = focusManagerState ? focusManagerState.domReference : null;
            const prevTabbable = getPreviousTabbable(domReference);
            prevTabbable?.focus();
          }
        }
      }), shouldRenderGuards && portalNode && /* @__PURE__ */ (0, import_jsx_runtime3.jsx)("span", {
        "aria-owns": portalNode.id,
        style: ownerVisuallyHidden
      }), portalNode && /* @__PURE__ */ ReactDOM2.createPortal(children, portalNode), shouldRenderGuards && portalNode && /* @__PURE__ */ (0, import_jsx_runtime3.jsx)(FocusGuard, {
        "data-type": "outside",
        ref: afterOutsideRef,
        onFocus: (event) => {
          if (isOutsideEvent(event, portalNode)) {
            afterInsideRef.current?.focus();
          } else {
            const domReference = focusManagerState ? focusManagerState.domReference : null;
            const nextTabbable = getNextTabbable(domReference);
            nextTabbable?.focus();
            if (focusManagerState?.closeOnFocusOut) {
              focusManagerState?.onOpenChange(false, createChangeEventDetails(reason_parts_exports.focusOut, event.nativeEvent));
            }
          }
        }
      })]
    })]
  });
});
if (true) FloatingPortal.displayName = "FloatingPortal";

// node_modules/@base-ui/react/floating-ui-react/components/FloatingTree.mjs
var React19 = __toESM(require_react(), 1);

// node_modules/@base-ui/react/floating-ui-react/utils/createEventEmitter.mjs
function createEventEmitter() {
  const map = /* @__PURE__ */ new Map();
  return {
    emit(event, data) {
      map.get(event)?.forEach((listener) => listener(data));
    },
    on(event, listener) {
      if (!map.has(event)) {
        map.set(event, /* @__PURE__ */ new Set());
      }
      map.get(event).add(listener);
    },
    off(event, listener) {
      map.get(event)?.delete(listener);
    }
  };
}

// node_modules/@base-ui/react/floating-ui-react/components/FloatingTreeStore.mjs
var FloatingTreeStore = class {
  nodesRef = {
    current: []
  };
  events = createEventEmitter();
  addNode(node) {
    this.nodesRef.current.push(node);
  }
  removeNode(node) {
    const index2 = this.nodesRef.current.findIndex((n) => n === node);
    if (index2 !== -1) {
      this.nodesRef.current.splice(index2, 1);
    }
  }
};

// node_modules/@base-ui/react/floating-ui-react/components/FloatingTree.mjs
var import_jsx_runtime4 = __toESM(require_jsx_runtime(), 1);
var FloatingNodeContext = /* @__PURE__ */ React19.createContext(null);
if (true) FloatingNodeContext.displayName = "FloatingNodeContext";
var FloatingTreeContext = /* @__PURE__ */ React19.createContext(null);
if (true) FloatingTreeContext.displayName = "FloatingTreeContext";
var useFloatingParentNodeId = () => React19.useContext(FloatingNodeContext)?.id || null;
var useFloatingTree = (externalTree) => {
  const contextTree = React19.useContext(FloatingTreeContext);
  return externalTree ?? contextTree;
};
function useFloatingNodeId(externalTree) {
  const id = useId();
  const tree = useFloatingTree(externalTree);
  const parentId = useFloatingParentNodeId();
  useIsoLayoutEffect(() => {
    if (!id) {
      return void 0;
    }
    const node = {
      id,
      parentId
    };
    tree?.addNode(node);
    return () => {
      tree?.removeNode(node);
    };
  }, [tree, id, parentId]);
  return id;
}
function FloatingNode(props) {
  const {
    children,
    id
  } = props;
  const parentId = useFloatingParentNodeId();
  return /* @__PURE__ */ (0, import_jsx_runtime4.jsx)(FloatingNodeContext.Provider, {
    value: React19.useMemo(() => ({
      id,
      parentId
    }), [id, parentId]),
    children
  });
}
function FloatingTree(props) {
  const {
    children,
    externalTree
  } = props;
  const tree = useRefWithInit(() => externalTree ?? new FloatingTreeStore()).current;
  return /* @__PURE__ */ (0, import_jsx_runtime4.jsx)(FloatingTreeContext.Provider, {
    value: tree,
    children
  });
}

// node_modules/@base-ui/react/floating-ui-react/components/FloatingFocusManager.mjs
var import_jsx_runtime5 = __toESM(require_jsx_runtime(), 1);
function getEventType(event, lastInteractionType) {
  const win = getWindow(getTarget(event));
  if (event instanceof win.KeyboardEvent) {
    return "keyboard";
  }
  if (event instanceof win.FocusEvent) {
    return lastInteractionType || "keyboard";
  }
  if ("pointerType" in event) {
    return event.pointerType || "keyboard";
  }
  if ("touches" in event) {
    return "touch";
  }
  if (event instanceof win.MouseEvent) {
    return lastInteractionType || (event.detail === 0 ? "keyboard" : "mouse");
  }
  return "";
}
var LIST_LIMIT = 20;
var previouslyFocusedElements = [];
function clearDisconnectedPreviouslyFocusedElements() {
  previouslyFocusedElements = previouslyFocusedElements.filter((entry) => {
    return entry.deref()?.isConnected;
  });
}
function addPreviouslyFocusedElement(element) {
  clearDisconnectedPreviouslyFocusedElements();
  if (element && getNodeName(element) !== "body") {
    previouslyFocusedElements.push(new WeakRef(element));
    if (previouslyFocusedElements.length > LIST_LIMIT) {
      previouslyFocusedElements = previouslyFocusedElements.slice(-LIST_LIMIT);
    }
  }
}
function getPreviouslyFocusedElement() {
  clearDisconnectedPreviouslyFocusedElements();
  return previouslyFocusedElements[previouslyFocusedElements.length - 1]?.deref();
}
function getFirstTabbableElement(container) {
  if (!container) {
    return null;
  }
  if (isTabbable(container)) {
    return container;
  }
  return tabbable(container)[0] || container;
}
function handleTabIndex(floatingFocusElement) {
  if (floatingFocusElement.hasAttribute("tabindex") && !floatingFocusElement.hasAttribute("data-tabindex")) {
    return;
  }
  if (!floatingFocusElement.getAttribute("role")?.includes("dialog")) {
    return;
  }
  const focusableElements = focusable(floatingFocusElement);
  const tabbableContent = focusableElements.filter((element) => {
    const dataTabIndex = element.getAttribute("data-tabindex") || "";
    return isTabbable(element) || element.hasAttribute("data-tabindex") && !dataTabIndex.startsWith("-");
  });
  const tabIndex = floatingFocusElement.getAttribute("tabindex");
  if (tabbableContent.length === 0) {
    if (tabIndex !== "0") {
      floatingFocusElement.setAttribute("tabindex", "0");
      floatingFocusElement.setAttribute("data-tabindex", "0");
    }
  } else if (tabIndex !== "-1" || floatingFocusElement.hasAttribute("data-tabindex") && floatingFocusElement.getAttribute("data-tabindex") !== "-1") {
    floatingFocusElement.setAttribute("tabindex", "-1");
    floatingFocusElement.setAttribute("data-tabindex", "-1");
  }
}
function FloatingFocusManager(props) {
  const {
    context,
    children,
    disabled: disabled2 = false,
    initialFocus = true,
    returnFocus = true,
    restoreFocus = false,
    modal = true,
    closeOnFocusOut = true,
    openInteractionType = "",
    nextFocusableElement,
    previousFocusableElement,
    beforeContentFocusGuardRef,
    externalTree,
    getInsideElements
  } = props;
  const store = "rootStore" in context ? context.rootStore : context;
  const open = store.useState("open");
  const domReference = store.useState("domReferenceElement");
  const floating = store.useState("floatingElement");
  const {
    events,
    dataRef
  } = store.context;
  const getNodeId = useStableCallback(() => dataRef.current.floatingContext?.nodeId);
  const ignoreInitialFocus = initialFocus === false;
  const isUntrappedTypeableCombobox = isTypeableCombobox(domReference) && ignoreInitialFocus;
  const initialFocusRef = useValueAsRef(initialFocus);
  const returnFocusRef = useValueAsRef(returnFocus);
  const openInteractionTypeRef = useValueAsRef(openInteractionType);
  const openRef = useValueAsRef(open);
  const tree = useFloatingTree(externalTree);
  const portalContext = usePortalContext();
  const preventReturnFocusRef = React20.useRef(false);
  const isPointerDownRef = React20.useRef(false);
  const pointerDownOutsideRef = React20.useRef(false);
  const lastFocusedTabbableRef = React20.useRef(null);
  const closeTypeRef = React20.useRef("");
  const lastInteractionTypeRef = React20.useRef("");
  const beforeGuardRef = React20.useRef(null);
  const afterGuardRef = React20.useRef(null);
  const mergedBeforeGuardRef = useMergedRefs(beforeGuardRef, beforeContentFocusGuardRef, portalContext?.beforeInsideRef);
  const mergedAfterGuardRef = useMergedRefs(afterGuardRef, portalContext?.afterInsideRef);
  const blurTimeout = useTimeout();
  const pointerDownTimeout = useTimeout();
  const restoreFocusFrame = useAnimationFrame();
  const isInsidePortal = portalContext != null;
  const floatingFocusElement = getFloatingFocusElement(floating);
  const getTabbableContent = useStableCallback((container = floatingFocusElement) => {
    return container ? tabbable(container) : [];
  });
  const getResolvedInsideElements = useStableCallback(() => getInsideElements?.().filter((element) => element != null) ?? []);
  React20.useEffect(() => {
    if (disabled2 || !modal) {
      return void 0;
    }
    function onKeyDown(event) {
      if (event.key === "Tab") {
        if (contains(floatingFocusElement, activeElement(ownerDocument(floatingFocusElement))) && getTabbableContent().length === 0 && !isUntrappedTypeableCombobox) {
          stopEvent(event);
        }
      }
    }
    const doc = ownerDocument(floatingFocusElement);
    return addEventListener(doc, "keydown", onKeyDown);
  }, [disabled2, floatingFocusElement, modal, isUntrappedTypeableCombobox, getTabbableContent]);
  React20.useEffect(() => {
    if (disabled2 || !open) {
      return void 0;
    }
    const doc = ownerDocument(floatingFocusElement);
    function clearPointerDownOutside() {
      pointerDownOutsideRef.current = false;
    }
    function onPointerDown(event) {
      const target = getTarget(event);
      const insideElements = getResolvedInsideElements();
      const pointerTargetInside = contains(floating, target) || contains(domReference, target) || contains(portalContext?.portalNode, target) || insideElements.some((element) => element === target || contains(element, target));
      pointerDownOutsideRef.current = !pointerTargetInside;
      lastInteractionTypeRef.current = event.pointerType || "keyboard";
      if (target?.closest(`[${CLICK_TRIGGER_IDENTIFIER}]`)) {
        isPointerDownRef.current = true;
        pointerDownTimeout.start(0, () => {
          isPointerDownRef.current = false;
        });
      }
    }
    function onKeyDown() {
      lastInteractionTypeRef.current = "keyboard";
    }
    return mergeCleanups(
      addEventListener(doc, "pointerdown", onPointerDown, true),
      addEventListener(doc, "pointerup", clearPointerDownOutside, true),
      addEventListener(doc, "pointercancel", clearPointerDownOutside, true),
      addEventListener(doc, "keydown", onKeyDown, true),
      // Avoid a stale `true` leaking into the next open (e.g. keep-mounted popups)
      // if the popup dismissed between pointerdown and pointerup.
      clearPointerDownOutside
    );
  }, [disabled2, floating, domReference, floatingFocusElement, open, portalContext, pointerDownTimeout, getResolvedInsideElements]);
  React20.useEffect(() => {
    if (disabled2 || !closeOnFocusOut) {
      return void 0;
    }
    const doc = ownerDocument(floatingFocusElement);
    function handlePointerDown() {
      isPointerDownRef.current = true;
      pointerDownTimeout.start(0, () => {
        isPointerDownRef.current = false;
      });
    }
    function handleFocusIn(event) {
      const target = getTarget(event);
      if (isTabbable(target)) {
        lastFocusedTabbableRef.current = target;
      }
    }
    function handleFocusOutside(event) {
      const relatedTarget = event.relatedTarget;
      const currentTarget = event.currentTarget;
      const target = getTarget(event);
      if (modal && relatedTarget == null && target != null && contains(floating, target)) {
        addPreviouslyFocusedElement(target);
      }
      queueMicrotask(() => {
        const nodeId = getNodeId();
        const triggers = store.context.triggerElements;
        const insideElements = getResolvedInsideElements();
        const isRelatedFocusGuard = relatedTarget?.hasAttribute(createAttribute("focus-guard")) && [beforeGuardRef.current, afterGuardRef.current, portalContext?.beforeInsideRef.current, portalContext?.afterInsideRef.current, portalContext?.beforeOutsideRef.current, portalContext?.afterOutsideRef.current, resolveRef(previousFocusableElement), resolveRef(nextFocusableElement)].includes(relatedTarget);
        const movedToUnrelatedNode = !(contains(domReference, relatedTarget) || contains(floating, relatedTarget) || contains(relatedTarget, floating) || contains(portalContext?.portalNode, relatedTarget) || insideElements.some((element) => element === relatedTarget || contains(element, relatedTarget)) || relatedTarget != null && triggers.hasElement(relatedTarget) || triggers.hasMatchingElement((trigger) => contains(trigger, relatedTarget)) || isRelatedFocusGuard || tree && (getNodeChildren(tree.nodesRef.current, nodeId).find((node) => contains(node.context?.elements.floating, relatedTarget) || contains(node.context?.elements.domReference, relatedTarget)) || getNodeAncestors(tree.nodesRef.current, nodeId).find((node) => [node.context?.elements.floating, getFloatingFocusElement(node.context?.elements.floating)].includes(relatedTarget) || node.context?.elements.domReference === relatedTarget)));
        if (currentTarget === domReference && floatingFocusElement) {
          handleTabIndex(floatingFocusElement);
        }
        if (restoreFocus && currentTarget !== domReference && !isElementVisible(target) && activeElement(doc) === doc.body) {
          if (isHTMLElement(floatingFocusElement)) {
            floatingFocusElement.focus();
            if (restoreFocus === "popup") {
              restoreFocusFrame.request(() => {
                floatingFocusElement.focus();
              });
              return;
            }
          }
          const tabbableContent = getTabbableContent();
          const prevTabbable = lastFocusedTabbableRef.current;
          const nodeToFocus = (prevTabbable && tabbableContent.includes(prevTabbable) ? prevTabbable : null) || tabbableContent[tabbableContent.length - 1] || floatingFocusElement;
          if (isHTMLElement(nodeToFocus)) {
            nodeToFocus.focus();
          }
        }
        if (dataRef.current.insideReactTree) {
          dataRef.current.insideReactTree = false;
          return;
        }
        if ((isUntrappedTypeableCombobox ? true : !modal) && relatedTarget && movedToUnrelatedNode && !isPointerDownRef.current && // Fix React 18 Strict Mode returnFocus due to double rendering.
        // For an "untrapped" typeable combobox (input role=combobox with
        // initialFocus=false), re-opening the popup and tabbing out should still close it even
        // when the previously focused element (e.g. the next tabbable outside the popup) is
        // focused again. Otherwise, the popup remains open on the second Tab sequence:
        // click input -> Tab (closes) -> click input -> Tab.
        // Allow closing when `isUntrappedTypeableCombobox` regardless of the previously focused element.
        (isUntrappedTypeableCombobox || relatedTarget !== getPreviouslyFocusedElement())) {
          preventReturnFocusRef.current = true;
          store.setOpen(false, createChangeEventDetails(reason_parts_exports.focusOut, event));
        }
      });
    }
    function markInsideReactTree() {
      if (pointerDownOutsideRef.current) {
        return;
      }
      dataRef.current.insideReactTree = true;
      blurTimeout.start(0, () => {
        dataRef.current.insideReactTree = false;
      });
    }
    const domReferenceElement = isHTMLElement(domReference) ? domReference : null;
    if (!floating && !domReferenceElement) {
      return void 0;
    }
    return mergeCleanups(domReferenceElement && addEventListener(domReferenceElement, "focusout", handleFocusOutside), domReferenceElement && addEventListener(domReferenceElement, "pointerdown", handlePointerDown), floating && addEventListener(floating, "focusin", handleFocusIn), floating && addEventListener(floating, "focusout", handleFocusOutside), floating && portalContext && addEventListener(floating, "focusout", markInsideReactTree, true));
  }, [disabled2, domReference, floating, floatingFocusElement, modal, tree, portalContext, store, closeOnFocusOut, restoreFocus, getTabbableContent, isUntrappedTypeableCombobox, getNodeId, dataRef, blurTimeout, pointerDownTimeout, restoreFocusFrame, nextFocusableElement, previousFocusableElement, getResolvedInsideElements]);
  React20.useEffect(() => {
    if (disabled2 || !floating || !open) {
      return void 0;
    }
    const portalNodes = Array.from(portalContext?.portalNode?.querySelectorAll(`[${createAttribute("portal")}]`) || []);
    const ancestors = tree ? getNodeAncestors(tree.nodesRef.current, getNodeId()) : [];
    const rootAncestorComboboxDomReference = ancestors.find((node) => isTypeableCombobox(node.context?.elements.domReference || null))?.context?.elements.domReference;
    const controlInsideElements = [floating, ...portalNodes, beforeGuardRef.current, afterGuardRef.current, portalContext?.beforeOutsideRef.current, portalContext?.afterOutsideRef.current, ...getResolvedInsideElements()];
    const insideElements = [...controlInsideElements, rootAncestorComboboxDomReference, resolveRef(previousFocusableElement), resolveRef(nextFocusableElement), isUntrappedTypeableCombobox ? domReference : null].filter((x) => x != null);
    const ariaHiddenCleanup = markOthers(insideElements, {
      ariaHidden: modal || isUntrappedTypeableCombobox,
      mark: false
    });
    const markerInsideElements = [floating, ...portalNodes].filter((x) => x != null);
    const markerCleanup = markOthers(markerInsideElements);
    return () => {
      markerCleanup();
      ariaHiddenCleanup();
    };
  }, [open, disabled2, domReference, floating, modal, portalContext, isUntrappedTypeableCombobox, tree, getNodeId, nextFocusableElement, previousFocusableElement, getResolvedInsideElements]);
  useIsoLayoutEffect(() => {
    if (!open || disabled2 || !isHTMLElement(floatingFocusElement)) {
      return;
    }
    const doc = ownerDocument(floatingFocusElement);
    const previouslyFocusedElement = activeElement(doc);
    queueMicrotask(() => {
      const initialFocusValueOrFn = initialFocusRef.current;
      const resolvedInitialFocus = typeof initialFocusValueOrFn === "function" ? initialFocusValueOrFn(openInteractionTypeRef.current || "") : initialFocusValueOrFn;
      if (resolvedInitialFocus === void 0 || resolvedInitialFocus === false) {
        return;
      }
      const focusAlreadyInsideFloatingEl = contains(floatingFocusElement, previouslyFocusedElement);
      if (focusAlreadyInsideFloatingEl) {
        return;
      }
      let focusableElements = null;
      const getDefaultFocusElement = () => {
        if (focusableElements == null) {
          focusableElements = getTabbableContent(floatingFocusElement);
        }
        return focusableElements[0] || floatingFocusElement;
      };
      let elToFocus;
      if (resolvedInitialFocus === true || resolvedInitialFocus === null) {
        elToFocus = getDefaultFocusElement();
      } else {
        elToFocus = resolveRef(resolvedInitialFocus);
      }
      elToFocus = elToFocus || getDefaultFocusElement();
      const hadFocusInside = contains(floatingFocusElement, activeElement(doc));
      enqueueFocus(elToFocus, {
        preventScroll: elToFocus === floatingFocusElement,
        shouldFocus() {
          if (!openRef.current) {
            return false;
          }
          if (hadFocusInside) {
            return true;
          }
          const currentActiveElement = activeElement(doc);
          const focusMovedInside = currentActiveElement !== elToFocus && contains(floatingFocusElement, currentActiveElement);
          return !focusMovedInside;
        }
      });
    });
  }, [disabled2, open, floatingFocusElement, getTabbableContent, initialFocusRef, openInteractionTypeRef, openRef]);
  useIsoLayoutEffect(() => {
    if (disabled2 || !floatingFocusElement) {
      return void 0;
    }
    const doc = ownerDocument(floatingFocusElement);
    const elementFocusedBeforeOpen = activeElement(doc);
    const preferPreviousFocus = openInteractionTypeRef.current == null;
    addPreviouslyFocusedElement(elementFocusedBeforeOpen);
    function onOpenChangeLocal(details) {
      if (!details.open) {
        closeTypeRef.current = getEventType(details.nativeEvent, lastInteractionTypeRef.current);
      }
      if (details.reason === reason_parts_exports.triggerHover && details.nativeEvent.type === "mouseleave") {
        preventReturnFocusRef.current = true;
      }
      if (details.reason !== reason_parts_exports.outsidePress) {
        return;
      }
      if (details.nested) {
        preventReturnFocusRef.current = false;
      } else if (isVirtualClick(details.nativeEvent) || isVirtualPointerEvent(details.nativeEvent)) {
        preventReturnFocusRef.current = false;
      } else {
        let isPreventScrollSupported = false;
        ownerDocument(floatingFocusElement).createElement("div").focus({
          get preventScroll() {
            isPreventScrollSupported = true;
            return false;
          }
        });
        if (isPreventScrollSupported) {
          preventReturnFocusRef.current = false;
        } else {
          preventReturnFocusRef.current = true;
        }
      }
    }
    events.on("openchange", onOpenChangeLocal);
    function getReturnElement() {
      const returnFocusValueOrFn = returnFocusRef.current;
      let resolvedReturnFocusValue = typeof returnFocusValueOrFn === "function" ? returnFocusValueOrFn(closeTypeRef.current) : returnFocusValueOrFn;
      if (resolvedReturnFocusValue === void 0 || resolvedReturnFocusValue === false) {
        return null;
      }
      if (resolvedReturnFocusValue === null) {
        resolvedReturnFocusValue = true;
      }
      const referenceReturnElement = domReference?.isConnected ? domReference : null;
      const previousReturnElement = elementFocusedBeforeOpen?.isConnected && getNodeName(elementFocusedBeforeOpen) !== "body" ? elementFocusedBeforeOpen : null;
      let defaultReturnElement = preferPreviousFocus ? previousReturnElement || referenceReturnElement : referenceReturnElement || previousReturnElement;
      if (!defaultReturnElement) {
        defaultReturnElement = getPreviouslyFocusedElement() || null;
      }
      if (typeof resolvedReturnFocusValue === "boolean") {
        return defaultReturnElement;
      }
      return resolveRef(resolvedReturnFocusValue) || defaultReturnElement || null;
    }
    return () => {
      events.off("openchange", onOpenChangeLocal);
      const activeEl = activeElement(doc);
      const insideElements = getResolvedInsideElements();
      const isFocusInsideFloatingTree = contains(floating, activeEl) || insideElements.some((element) => element === activeEl || contains(element, activeEl)) || tree && getNodeChildren(tree.nodesRef.current, getNodeId(), false).some((node) => contains(node.context?.elements.floating, activeEl));
      const returnFocusValueOrFn = returnFocusRef.current;
      const returnElement = getReturnElement();
      queueMicrotask(() => {
        const tabbableReturnElement = getFirstTabbableElement(returnElement);
        const hasExplicitReturnFocus = typeof returnFocusValueOrFn !== "boolean";
        if (returnFocusValueOrFn && !preventReturnFocusRef.current && isHTMLElement(tabbableReturnElement) && // If the focus moved somewhere else after mount, avoid returning focus
        // since it likely entered a different element which should be
        // respected: https://github.com/floating-ui/floating-ui/issues/2607
        (!hasExplicitReturnFocus && tabbableReturnElement !== activeEl && activeEl !== doc.body ? isFocusInsideFloatingTree : true)) {
          tabbableReturnElement.focus({
            preventScroll: true
          });
        }
        preventReturnFocusRef.current = false;
      });
    };
  }, [disabled2, floating, floatingFocusElement, returnFocusRef, openInteractionTypeRef, events, tree, domReference, getNodeId, getResolvedInsideElements]);
  useIsoLayoutEffect(() => {
    if (!parts_exports.engine.webkit || open || !floating) {
      return;
    }
    const activeEl = activeElement(ownerDocument(floating));
    if (!isHTMLElement(activeEl) || !isTypeableElement(activeEl)) {
      return;
    }
    if (contains(floating, activeEl)) {
      activeEl.blur();
    }
  }, [open, floating]);
  useIsoLayoutEffect(() => {
    if (disabled2 || !portalContext) {
      return void 0;
    }
    portalContext.setFocusManagerState({
      modal,
      closeOnFocusOut,
      open,
      onOpenChange: store.setOpen,
      domReference
    });
    return () => {
      portalContext.setFocusManagerState(null);
    };
  }, [disabled2, portalContext, modal, open, store, closeOnFocusOut, domReference]);
  useIsoLayoutEffect(() => {
    if (disabled2 || !floatingFocusElement) {
      return void 0;
    }
    handleTabIndex(floatingFocusElement);
    return () => {
      queueMicrotask(clearDisconnectedPreviouslyFocusedElements);
    };
  }, [disabled2, floatingFocusElement]);
  const shouldRenderGuards = !disabled2 && (modal ? !isUntrappedTypeableCombobox : true) && (isInsidePortal || modal);
  return /* @__PURE__ */ (0, import_jsx_runtime5.jsxs)(React20.Fragment, {
    children: [shouldRenderGuards && /* @__PURE__ */ (0, import_jsx_runtime5.jsx)(FocusGuard, {
      "data-type": "inside",
      ref: mergedBeforeGuardRef,
      onFocus: (event) => {
        if (modal) {
          const els = getTabbableContent();
          enqueueFocus(els[els.length - 1]);
        } else if (portalContext?.portalNode) {
          preventReturnFocusRef.current = false;
          if (isOutsideEvent(event, portalContext.portalNode)) {
            const nextTabbable = getNextTabbable(domReference);
            nextTabbable?.focus();
          } else {
            resolveRef(previousFocusableElement ?? portalContext.beforeOutsideRef)?.focus();
          }
        }
      }
    }), children, shouldRenderGuards && /* @__PURE__ */ (0, import_jsx_runtime5.jsx)(FocusGuard, {
      "data-type": "inside",
      ref: mergedAfterGuardRef,
      onFocus: (event) => {
        if (modal) {
          enqueueFocus(getTabbableContent()[0]);
        } else if (portalContext?.portalNode) {
          if (closeOnFocusOut) {
            preventReturnFocusRef.current = true;
          }
          if (isOutsideEvent(event, portalContext.portalNode)) {
            const prevTabbable = getPreviousTabbable(domReference);
            prevTabbable?.focus();
          } else {
            resolveRef(nextFocusableElement ?? portalContext.afterOutsideRef)?.focus();
          }
        }
      }
    })]
  });
}

// node_modules/@base-ui/react/floating-ui-react/hooks/useClick.mjs
var React21 = __toESM(require_react(), 1);
function useClick(context, props = {}) {
  const {
    enabled = true,
    event: eventOption = "click",
    toggle = true,
    ignoreMouse = false,
    stickIfOpen = true,
    touchOpenDelay = 0,
    reason = reason_parts_exports.triggerPress
  } = props;
  const store = "rootStore" in context ? context.rootStore : context;
  const dataRef = store.context.dataRef;
  const pointerTypeRef = React21.useRef(void 0);
  const frame = useAnimationFrame();
  const touchOpenTimeout = useTimeout();
  const reference = React21.useMemo(() => {
    function setOpenWithTouchDelay(nextOpen, nativeEvent, target, pointerType) {
      const details = createChangeEventDetails(reason, nativeEvent, target);
      if (nextOpen && pointerType === "touch" && touchOpenDelay > 0) {
        touchOpenTimeout.start(touchOpenDelay, () => {
          store.setOpen(true, details);
        });
      } else {
        store.setOpen(nextOpen, details);
      }
    }
    function getNextOpen(open, currentTarget, isClickLikeOpenEvent2) {
      const openEvent = dataRef.current.openEvent;
      const hasClickedOnInactiveTrigger = store.select("domReferenceElement") !== currentTarget;
      if (open && hasClickedOnInactiveTrigger) {
        return true;
      }
      if (!open) {
        return true;
      }
      if (!toggle) {
        return true;
      }
      if (openEvent && stickIfOpen) {
        return !isClickLikeOpenEvent2(openEvent.type);
      }
      return false;
    }
    return {
      onPointerDown(event) {
        pointerTypeRef.current = event.pointerType;
      },
      onMouseDown(event) {
        const pointerType = pointerTypeRef.current;
        const nativeEvent = event.nativeEvent;
        const open = store.select("open");
        if (event.button !== 0 || eventOption === "click" || isMouseLikePointerType(pointerType, true) && ignoreMouse) {
          return;
        }
        const nextOpen = getNextOpen(open, event.currentTarget, (openEventType) => openEventType === "click" || openEventType === "mousedown");
        const target = getTarget(nativeEvent);
        if (isTypeableElement(target)) {
          setOpenWithTouchDelay(nextOpen, nativeEvent, target, pointerType);
          return;
        }
        const eventCurrentTarget = event.currentTarget;
        frame.request(() => {
          setOpenWithTouchDelay(nextOpen, nativeEvent, eventCurrentTarget, pointerType);
        });
      },
      onClick(event) {
        if (eventOption === "mousedown-only") {
          return;
        }
        const pointerType = pointerTypeRef.current;
        if (eventOption === "mousedown" && pointerType) {
          pointerTypeRef.current = void 0;
          return;
        }
        if (isMouseLikePointerType(pointerType, true) && ignoreMouse) {
          return;
        }
        const open = store.select("open");
        const nextOpen = getNextOpen(open, event.currentTarget, (openEventType) => openEventType === "click" || openEventType === "mousedown" || openEventType === "keydown" || openEventType === "keyup");
        setOpenWithTouchDelay(nextOpen, event.nativeEvent, event.currentTarget, pointerType);
      },
      onKeyDown() {
        pointerTypeRef.current = void 0;
      }
    };
  }, [dataRef, eventOption, ignoreMouse, reason, store, stickIfOpen, toggle, frame, touchOpenTimeout, touchOpenDelay]);
  return React21.useMemo(() => enabled ? {
    reference
  } : EMPTY_OBJECT, [enabled, reference]);
}

// node_modules/@base-ui/react/floating-ui-react/hooks/useClientPoint.mjs
var React22 = __toESM(require_react(), 1);
function createVirtualElement(domElement, data) {
  let offsetX = null;
  let offsetY = null;
  let isAutoUpdateEvent = false;
  return {
    contextElement: domElement || void 0,
    getBoundingClientRect() {
      const domRect = domElement?.getBoundingClientRect() || {
        width: 0,
        height: 0,
        x: 0,
        y: 0
      };
      const isXAxis = data.axis === "x" || data.axis === "both";
      const isYAxis = data.axis === "y" || data.axis === "both";
      const canTrackCursorOnAutoUpdate = ["mouseenter", "mousemove"].includes(data.dataRef.current.openEvent?.type || "") && data.pointerType !== "touch";
      let width = domRect.width;
      let height = domRect.height;
      let x = domRect.x;
      let y = domRect.y;
      if (offsetX == null && data.x && isXAxis) {
        offsetX = domRect.x - data.x;
      }
      if (offsetY == null && data.y && isYAxis) {
        offsetY = domRect.y - data.y;
      }
      x -= offsetX || 0;
      y -= offsetY || 0;
      width = 0;
      height = 0;
      if (!isAutoUpdateEvent || canTrackCursorOnAutoUpdate) {
        width = data.axis === "y" ? domRect.width : 0;
        height = data.axis === "x" ? domRect.height : 0;
        x = isXAxis && data.x != null ? data.x : x;
        y = isYAxis && data.y != null ? data.y : y;
      } else if (isAutoUpdateEvent && !canTrackCursorOnAutoUpdate) {
        height = data.axis === "x" ? domRect.height : height;
        width = data.axis === "y" ? domRect.width : width;
      }
      isAutoUpdateEvent = true;
      return {
        width,
        height,
        x,
        y,
        top: y,
        right: x + width,
        bottom: y + height,
        left: x
      };
    }
  };
}
function isMouseBasedEvent(event) {
  return event != null && event.clientX != null;
}
function useClientPoint(context, props = {}) {
  const {
    enabled = true,
    axis = "both"
  } = props;
  const store = "rootStore" in context ? context.rootStore : context;
  const open = store.useState("open");
  const floating = store.useState("floatingElement");
  const domReference = store.useState("domReferenceElement");
  const dataRef = store.context.dataRef;
  const initialRef = React22.useRef(false);
  const cleanupListenerRef = React22.useRef(null);
  const [pointerType, setPointerType] = React22.useState();
  const [reactive, setReactive] = React22.useState([]);
  const resetReference = useStableCallback((reference2) => {
    store.set("positionReference", reference2);
  });
  const setReference = useStableCallback((newX, newY, referenceElement) => {
    if (initialRef.current) {
      return;
    }
    if (dataRef.current.openEvent && !isMouseBasedEvent(dataRef.current.openEvent)) {
      return;
    }
    store.set("positionReference", createVirtualElement(referenceElement ?? domReference, {
      x: newX,
      y: newY,
      axis,
      dataRef,
      pointerType
    }));
  });
  const handleReferenceEnterOrMove = useStableCallback((event) => {
    if (!open) {
      setReference(event.clientX, event.clientY, event.currentTarget);
    } else if (!cleanupListenerRef.current) {
      setReference(event.clientX, event.clientY, event.currentTarget);
      setReactive([]);
    }
  });
  const openCheck = isMouseLikePointerType(pointerType) ? floating : open;
  React22.useEffect(() => {
    if (!enabled) {
      resetReference(domReference);
      return void 0;
    }
    if (!openCheck) {
      return void 0;
    }
    function cleanupListener() {
      cleanupListenerRef.current?.();
      cleanupListenerRef.current = null;
    }
    const win = getWindow(floating);
    function handleMouseMove(event) {
      const target = getTarget(event);
      if (!contains(floating, target)) {
        setReference(event.clientX, event.clientY);
      } else {
        cleanupListener();
      }
    }
    if (!dataRef.current.openEvent || isMouseBasedEvent(dataRef.current.openEvent)) {
      cleanupListenerRef.current = addEventListener(win, "mousemove", handleMouseMove);
    } else {
      resetReference(domReference);
    }
    return cleanupListener;
  }, [openCheck, enabled, floating, dataRef, domReference, store, setReference, resetReference, reactive]);
  React22.useEffect(() => () => {
    store.set("positionReference", null);
  }, [store]);
  React22.useEffect(() => {
    if (enabled && !floating) {
      initialRef.current = false;
    }
  }, [enabled, floating]);
  React22.useEffect(() => {
    if (!enabled && open) {
      initialRef.current = true;
    }
  }, [enabled, open]);
  const reference = React22.useMemo(() => {
    function setPointerTypeRef(event) {
      setPointerType(event.pointerType);
    }
    return {
      onPointerDown: setPointerTypeRef,
      onPointerEnter: setPointerTypeRef,
      onMouseMove: handleReferenceEnterOrMove,
      onMouseEnter: handleReferenceEnterOrMove
    };
  }, [handleReferenceEnterOrMove]);
  return React22.useMemo(() => enabled ? {
    reference,
    trigger: reference
  } : {}, [enabled, reference]);
}

// node_modules/@base-ui/react/floating-ui-react/hooks/useDismiss.mjs
var React23 = __toESM(require_react(), 1);
function alwaysFalse() {
  return false;
}
function normalizeProp(normalizable) {
  return {
    escapeKey: typeof normalizable === "boolean" ? normalizable : normalizable?.escapeKey ?? false,
    outsidePress: typeof normalizable === "boolean" ? normalizable : normalizable?.outsidePress ?? true
  };
}
function useDismiss(context, props = {}) {
  const {
    enabled = true,
    escapeKey: escapeKey2 = true,
    outsidePress: outsidePressProp = true,
    outsidePressEvent = "sloppy",
    referencePress = alwaysFalse,
    bubbles,
    externalTree
  } = props;
  const store = "rootStore" in context ? context.rootStore : context;
  const open = store.useState("open");
  const floatingElement = store.useState("floatingElement");
  const {
    dataRef
  } = store.context;
  const tree = useFloatingTree(externalTree);
  const outsidePressFn = useStableCallback(typeof outsidePressProp === "function" ? outsidePressProp : () => false);
  const outsidePress2 = typeof outsidePressProp === "function" ? outsidePressFn : outsidePressProp;
  const outsidePressEnabled = outsidePress2 !== false;
  const getOutsidePressEventProp = useStableCallback(() => outsidePressEvent);
  const {
    escapeKey: escapeKeyBubbles,
    outsidePress: outsidePressBubbles
  } = normalizeProp(bubbles);
  const pressStartedInsideRef = React23.useRef(false);
  const pressStartPreventedRef = React23.useRef(false);
  const suppressNextOutsideClickRef = React23.useRef(false);
  const isComposingRef = React23.useRef(false);
  const currentPointerTypeRef = React23.useRef("");
  const touchStateRef = React23.useRef(null);
  const cancelDismissOnEndTimeout = useTimeout();
  const clearInsideReactTreeTimeout = useTimeout();
  const clearInsideReactTree = useStableCallback(() => {
    clearInsideReactTreeTimeout.clear();
    dataRef.current.insideReactTree = false;
  });
  const hasBlockingChild = useStableCallback((bubbleKey) => {
    const nodeId = dataRef.current.floatingContext?.nodeId;
    const children = tree ? getNodeChildren(tree.nodesRef.current, nodeId) : [];
    return children.some((child) => child.context?.open && !child.context.dataRef.current[bubbleKey]);
  });
  const isEventWithinOwnElements = useStableCallback((event) => {
    return isEventTargetWithin(event, store.select("floatingElement")) || isEventTargetWithin(event, store.select("domReferenceElement"));
  });
  const closeOnReferencePress = useStableCallback((event) => {
    if (!referencePress()) {
      return;
    }
    store.setOpen(false, createChangeEventDetails(reason_parts_exports.triggerPress, event.nativeEvent));
  });
  const closeOnEscapeKeyDown = useStableCallback((event) => {
    if (!open || !enabled || !escapeKey2 || event.key !== "Escape") {
      return;
    }
    if (isComposingRef.current) {
      return;
    }
    if (!escapeKeyBubbles && hasBlockingChild("__escapeKeyBubbles")) {
      return;
    }
    const native = isReactEvent(event) ? event.nativeEvent : event;
    const eventDetails = createChangeEventDetails(reason_parts_exports.escapeKey, native);
    store.setOpen(false, eventDetails);
    if (!eventDetails.isCanceled) {
      event.preventDefault();
    }
    if (!escapeKeyBubbles && !eventDetails.isPropagationAllowed) {
      event.stopPropagation();
    }
  });
  const markInsideReactTree = useStableCallback(() => {
    dataRef.current.insideReactTree = true;
    clearInsideReactTreeTimeout.start(0, clearInsideReactTree);
  });
  const markPressStartedInsideReactTree = useStableCallback((event) => {
    if (!open || !enabled || event.button !== 0) {
      return;
    }
    const target = getTarget(event.nativeEvent);
    if (!contains(store.select("floatingElement"), target)) {
      return;
    }
    if (!pressStartedInsideRef.current) {
      pressStartedInsideRef.current = true;
      pressStartPreventedRef.current = false;
    }
  });
  const markInsidePressStartPrevented = useStableCallback((event) => {
    if (!open || !enabled) {
      return;
    }
    if (!(event.defaultPrevented || event.nativeEvent.defaultPrevented)) {
      return;
    }
    if (pressStartedInsideRef.current) {
      pressStartPreventedRef.current = true;
    }
  });
  React23.useEffect(() => {
    if (!open || !enabled) {
      return void 0;
    }
    dataRef.current.__escapeKeyBubbles = escapeKeyBubbles;
    dataRef.current.__outsidePressBubbles = outsidePressBubbles;
    const compositionTimeout = new Timeout();
    const preventedPressSuppressionTimeout = new Timeout();
    function handleCompositionStart() {
      compositionTimeout.clear();
      isComposingRef.current = true;
    }
    function handleCompositionEnd() {
      compositionTimeout.start(
        // 0ms or 1ms don't work in Safari. 5ms appears to consistently work.
        // Only apply to WebKit for the test to remain 0ms.
        parts_exports.engine.webkit ? 5 : 0,
        () => {
          isComposingRef.current = false;
        }
      );
    }
    function suppressImmediateOutsideClickAfterPreventedStart() {
      suppressNextOutsideClickRef.current = true;
      preventedPressSuppressionTimeout.start(0, () => {
        suppressNextOutsideClickRef.current = false;
      });
    }
    function resetPressStartState() {
      pressStartedInsideRef.current = false;
      pressStartPreventedRef.current = false;
    }
    function getOutsidePressEvent() {
      const type = currentPointerTypeRef.current;
      const computedType = type === "pen" || !type ? "mouse" : type;
      const outsidePressEventValue = getOutsidePressEventProp();
      const resolved = typeof outsidePressEventValue === "function" ? outsidePressEventValue() : outsidePressEventValue;
      if (typeof resolved === "string") {
        return resolved;
      }
      return resolved[computedType];
    }
    function shouldIgnoreEvent(event) {
      const computedOutsidePressEvent = getOutsidePressEvent();
      return computedOutsidePressEvent === "intentional" && event.type !== "click" || computedOutsidePressEvent === "sloppy" && event.type === "click";
    }
    function isEventWithinFloatingTree(event) {
      const nodeId = dataRef.current.floatingContext?.nodeId;
      const targetIsInsideChildren = tree && getNodeChildren(tree.nodesRef.current, nodeId).some((node) => isEventTargetWithin(event, node.context?.elements.floating));
      return isEventWithinOwnElements(event) || targetIsInsideChildren;
    }
    function closeOnPressOutside(event) {
      if (shouldIgnoreEvent(event)) {
        if (event.type !== "click" && !isEventWithinOwnElements(event)) {
          preventedPressSuppressionTimeout.clear();
          suppressNextOutsideClickRef.current = false;
        }
        clearInsideReactTree();
        return;
      }
      if (dataRef.current.insideReactTree) {
        clearInsideReactTree();
        return;
      }
      const target = getTarget(event);
      const inertSelector = `[${createAttribute("inert")}]`;
      const targetRoot = isElement(target) ? target.getRootNode() : null;
      const markers = Array.from((isShadowRoot(targetRoot) ? targetRoot : ownerDocument(store.select("floatingElement"))).querySelectorAll(inertSelector));
      const triggers = store.context.triggerElements;
      if (target && (triggers.hasElement(target) || triggers.hasMatchingElement((trigger) => contains(trigger, target)))) {
        return;
      }
      let targetRootAncestor = isElement(target) ? target : null;
      while (targetRootAncestor && !isLastTraversableNode(targetRootAncestor)) {
        const nextParent = getParentNode(targetRootAncestor);
        if (isLastTraversableNode(nextParent) || !isElement(nextParent)) {
          break;
        }
        targetRootAncestor = nextParent;
      }
      if (markers.length && isElement(target) && !isRootElement(target) && // Clicked on a direct ancestor (e.g. FloatingOverlay).
      !contains(target, store.select("floatingElement")) && // If the target root element contains none of the markers, then the
      // element was injected after the floating element rendered.
      markers.every((marker) => !contains(targetRootAncestor, marker))) {
        return;
      }
      if (isHTMLElement(target) && !("touches" in event)) {
        const lastTraversableNode = isLastTraversableNode(target);
        const style = getComputedStyle2(target);
        const scrollRe = /auto|scroll/;
        const isScrollableX = lastTraversableNode || scrollRe.test(style.overflowX);
        const isScrollableY = lastTraversableNode || scrollRe.test(style.overflowY);
        const canScrollX = isScrollableX && target.clientWidth > 0 && target.scrollWidth > target.clientWidth;
        const canScrollY = isScrollableY && target.clientHeight > 0 && target.scrollHeight > target.clientHeight;
        const isRTL2 = style.direction === "rtl";
        const pressedVerticalScrollbar = canScrollY && (isRTL2 ? event.offsetX <= target.offsetWidth - target.clientWidth : event.offsetX > target.clientWidth);
        const pressedHorizontalScrollbar = canScrollX && event.offsetY > target.clientHeight;
        if (pressedVerticalScrollbar || pressedHorizontalScrollbar) {
          return;
        }
      }
      if (isEventWithinFloatingTree(event)) {
        return;
      }
      if (getOutsidePressEvent() === "intentional" && suppressNextOutsideClickRef.current) {
        preventedPressSuppressionTimeout.clear();
        suppressNextOutsideClickRef.current = false;
        return;
      }
      if (typeof outsidePress2 === "function" && !outsidePress2(event)) {
        return;
      }
      if (hasBlockingChild("__outsidePressBubbles")) {
        return;
      }
      store.setOpen(false, createChangeEventDetails(reason_parts_exports.outsidePress, event));
      clearInsideReactTree();
    }
    function handlePointerDown(event) {
      if (getOutsidePressEvent() !== "sloppy" || event.pointerType === "touch" || !store.select("open") || !enabled || isEventWithinOwnElements(event)) {
        return;
      }
      closeOnPressOutside(event);
    }
    function handleTouchStart(event) {
      if (getOutsidePressEvent() !== "sloppy" || !store.select("open") || !enabled || isEventWithinOwnElements(event)) {
        return;
      }
      const touch = event.touches[0];
      if (touch) {
        touchStateRef.current = {
          startTime: Date.now(),
          startX: touch.clientX,
          startY: touch.clientY,
          dismissOnTouchEnd: false,
          dismissOnMouseDown: true
        };
        cancelDismissOnEndTimeout.start(1e3, () => {
          if (touchStateRef.current) {
            touchStateRef.current.dismissOnTouchEnd = false;
            touchStateRef.current.dismissOnMouseDown = false;
          }
        });
      }
    }
    function addTargetEventListenerOnce(event, listener) {
      const target = getTarget(event);
      if (!target) {
        return;
      }
      const unsubscribe2 = addEventListener(target, event.type, () => {
        listener(event);
        unsubscribe2();
      });
    }
    function handleTouchStartCapture(event) {
      currentPointerTypeRef.current = "touch";
      addTargetEventListenerOnce(event, handleTouchStart);
    }
    function closeOnPressOutsideCapture(event) {
      cancelDismissOnEndTimeout.clear();
      if (event.type === "pointerdown") {
        currentPointerTypeRef.current = event.pointerType;
      }
      if (event.type === "mousedown" && touchStateRef.current && !touchStateRef.current.dismissOnMouseDown) {
        return;
      }
      addTargetEventListenerOnce(event, (targetEvent) => {
        if (targetEvent.type === "pointerdown") {
          handlePointerDown(targetEvent);
        } else {
          closeOnPressOutside(targetEvent);
        }
      });
    }
    function handlePressEndCapture(event) {
      if (!pressStartedInsideRef.current) {
        return;
      }
      const pressStartedInsideDefaultPrevented = pressStartPreventedRef.current;
      resetPressStartState();
      if (getOutsidePressEvent() !== "intentional") {
        return;
      }
      if (event.type === "pointercancel") {
        if (pressStartedInsideDefaultPrevented) {
          suppressImmediateOutsideClickAfterPreventedStart();
        }
        return;
      }
      if (isEventWithinFloatingTree(event)) {
        return;
      }
      if (pressStartedInsideDefaultPrevented) {
        suppressImmediateOutsideClickAfterPreventedStart();
        return;
      }
      if (typeof outsidePress2 === "function" && !outsidePress2(event)) {
        return;
      }
      preventedPressSuppressionTimeout.clear();
      suppressNextOutsideClickRef.current = true;
      clearInsideReactTree();
    }
    function handleTouchMove(event) {
      if (getOutsidePressEvent() !== "sloppy" || !touchStateRef.current || isEventWithinOwnElements(event)) {
        return;
      }
      const touch = event.touches[0];
      if (!touch) {
        return;
      }
      const deltaX = Math.abs(touch.clientX - touchStateRef.current.startX);
      const deltaY = Math.abs(touch.clientY - touchStateRef.current.startY);
      const distance = Math.sqrt(deltaX * deltaX + deltaY * deltaY);
      if (distance > 5) {
        touchStateRef.current.dismissOnTouchEnd = true;
      }
      if (distance > 10) {
        closeOnPressOutside(event);
        cancelDismissOnEndTimeout.clear();
        touchStateRef.current = null;
      }
    }
    function handleTouchMoveCapture(event) {
      addTargetEventListenerOnce(event, handleTouchMove);
    }
    function handleTouchEnd(event) {
      if (getOutsidePressEvent() !== "sloppy" || !touchStateRef.current || isEventWithinOwnElements(event)) {
        return;
      }
      if (touchStateRef.current.dismissOnTouchEnd) {
        closeOnPressOutside(event);
      }
      cancelDismissOnEndTimeout.clear();
      touchStateRef.current = null;
    }
    function handleTouchEndCapture(event) {
      addTargetEventListenerOnce(event, handleTouchEnd);
    }
    const doc = ownerDocument(floatingElement);
    const unsubscribe = mergeCleanups(escapeKey2 && mergeCleanups(addEventListener(doc, "keydown", closeOnEscapeKeyDown), addEventListener(doc, "compositionstart", handleCompositionStart), addEventListener(doc, "compositionend", handleCompositionEnd)), outsidePressEnabled && mergeCleanups(addEventListener(doc, "click", closeOnPressOutsideCapture, true), addEventListener(doc, "pointerdown", closeOnPressOutsideCapture, true), addEventListener(doc, "pointerup", handlePressEndCapture, true), addEventListener(doc, "pointercancel", handlePressEndCapture, true), addEventListener(doc, "mousedown", closeOnPressOutsideCapture, true), addEventListener(doc, "mouseup", handlePressEndCapture, true), addEventListener(doc, "touchstart", handleTouchStartCapture, true), addEventListener(doc, "touchmove", handleTouchMoveCapture, true), addEventListener(doc, "touchend", handleTouchEndCapture, true)));
    return () => {
      unsubscribe();
      compositionTimeout.clear();
      preventedPressSuppressionTimeout.clear();
      resetPressStartState();
      suppressNextOutsideClickRef.current = false;
    };
  }, [dataRef, floatingElement, escapeKey2, outsidePressEnabled, outsidePress2, open, enabled, escapeKeyBubbles, outsidePressBubbles, closeOnEscapeKeyDown, clearInsideReactTree, getOutsidePressEventProp, hasBlockingChild, isEventWithinOwnElements, tree, store, cancelDismissOnEndTimeout]);
  React23.useEffect(clearInsideReactTree, [outsidePress2, clearInsideReactTree]);
  const reference = React23.useMemo(() => ({
    onKeyDown: closeOnEscapeKeyDown,
    onPointerDown: closeOnReferencePress,
    onClick: closeOnReferencePress
  }), [closeOnEscapeKeyDown, closeOnReferencePress]);
  const floating = React23.useMemo(() => ({
    onKeyDown: closeOnEscapeKeyDown,
    // `onMouseDown` may be blocked if `event.preventDefault()` is called in
    // `onPointerDown`, such as with <NumberField.ScrubArea>.
    // See https://github.com/mui/base-ui/pull/3379
    onPointerDown: markInsidePressStartPrevented,
    onMouseDown: markInsidePressStartPrevented,
    onClickCapture: markInsideReactTree,
    onMouseDownCapture(event) {
      markInsideReactTree();
      markPressStartedInsideReactTree(event);
    },
    onPointerDownCapture(event) {
      markInsideReactTree();
      markPressStartedInsideReactTree(event);
    },
    onMouseUpCapture: markInsideReactTree,
    onTouchEndCapture: markInsideReactTree,
    onTouchMoveCapture: markInsideReactTree
  }), [closeOnEscapeKeyDown, markInsideReactTree, markPressStartedInsideReactTree, markInsidePressStartPrevented]);
  return React23.useMemo(() => enabled ? {
    reference,
    floating,
    trigger: reference
  } : {}, [enabled, reference, floating]);
}

// node_modules/@base-ui/react/floating-ui-react/hooks/useFloating.mjs
var React30 = __toESM(require_react(), 1);

// node_modules/@floating-ui/core/dist/floating-ui.core.mjs
function computeCoordsFromPlacement(_ref, placement, rtl) {
  let {
    reference,
    floating
  } = _ref;
  const sideAxis = getSideAxis(placement);
  const alignmentAxis = getAlignmentAxis(placement);
  const alignLength = getAxisLength(alignmentAxis);
  const side = getSide(placement);
  const isVertical = sideAxis === "y";
  const commonX = reference.x + reference.width / 2 - floating.width / 2;
  const commonY = reference.y + reference.height / 2 - floating.height / 2;
  const commonAlign = reference[alignLength] / 2 - floating[alignLength] / 2;
  let coords;
  switch (side) {
    case "top":
      coords = {
        x: commonX,
        y: reference.y - floating.height
      };
      break;
    case "bottom":
      coords = {
        x: commonX,
        y: reference.y + reference.height
      };
      break;
    case "right":
      coords = {
        x: reference.x + reference.width,
        y: commonY
      };
      break;
    case "left":
      coords = {
        x: reference.x - floating.width,
        y: commonY
      };
      break;
    default:
      coords = {
        x: reference.x,
        y: reference.y
      };
  }
  switch (getAlignment(placement)) {
    case "start":
      coords[alignmentAxis] -= commonAlign * (rtl && isVertical ? -1 : 1);
      break;
    case "end":
      coords[alignmentAxis] += commonAlign * (rtl && isVertical ? -1 : 1);
      break;
  }
  return coords;
}
async function detectOverflow(state, options) {
  var _await$platform$isEle;
  if (options === void 0) {
    options = {};
  }
  const {
    x,
    y,
    platform: platform3,
    rects,
    elements,
    strategy
  } = state;
  const {
    boundary = "clippingAncestors",
    rootBoundary = "viewport",
    elementContext = "floating",
    altBoundary = false,
    padding = 0
  } = evaluate(options, state);
  const paddingObject = getPaddingObject(padding);
  const altContext = elementContext === "floating" ? "reference" : "floating";
  const element = elements[altBoundary ? altContext : elementContext];
  const clippingClientRect = rectToClientRect(await platform3.getClippingRect({
    element: ((_await$platform$isEle = await (platform3.isElement == null ? void 0 : platform3.isElement(element))) != null ? _await$platform$isEle : true) ? element : element.contextElement || await (platform3.getDocumentElement == null ? void 0 : platform3.getDocumentElement(elements.floating)),
    boundary,
    rootBoundary,
    strategy
  }));
  const rect = elementContext === "floating" ? {
    x,
    y,
    width: rects.floating.width,
    height: rects.floating.height
  } : rects.reference;
  const offsetParent = await (platform3.getOffsetParent == null ? void 0 : platform3.getOffsetParent(elements.floating));
  const offsetScale = await (platform3.isElement == null ? void 0 : platform3.isElement(offsetParent)) ? await (platform3.getScale == null ? void 0 : platform3.getScale(offsetParent)) || {
    x: 1,
    y: 1
  } : {
    x: 1,
    y: 1
  };
  const elementClientRect = rectToClientRect(platform3.convertOffsetParentRelativeRectToViewportRelativeRect ? await platform3.convertOffsetParentRelativeRectToViewportRelativeRect({
    elements,
    rect,
    offsetParent,
    strategy
  }) : rect);
  return {
    top: (clippingClientRect.top - elementClientRect.top + paddingObject.top) / offsetScale.y,
    bottom: (elementClientRect.bottom - clippingClientRect.bottom + paddingObject.bottom) / offsetScale.y,
    left: (clippingClientRect.left - elementClientRect.left + paddingObject.left) / offsetScale.x,
    right: (elementClientRect.right - clippingClientRect.right + paddingObject.right) / offsetScale.x
  };
}
var MAX_RESET_COUNT = 50;
var computePosition = async (reference, floating, config) => {
  const {
    placement = "bottom",
    strategy = "absolute",
    middleware = [],
    platform: platform3
  } = config;
  const platformWithDetectOverflow = platform3.detectOverflow ? platform3 : {
    ...platform3,
    detectOverflow
  };
  const rtl = await (platform3.isRTL == null ? void 0 : platform3.isRTL(floating));
  let rects = await platform3.getElementRects({
    reference,
    floating,
    strategy
  });
  let {
    x,
    y
  } = computeCoordsFromPlacement(rects, placement, rtl);
  let statefulPlacement = placement;
  let resetCount = 0;
  const middlewareData = {};
  for (let i = 0; i < middleware.length; i++) {
    const currentMiddleware = middleware[i];
    if (!currentMiddleware) {
      continue;
    }
    const {
      name,
      fn
    } = currentMiddleware;
    const {
      x: nextX,
      y: nextY,
      data,
      reset
    } = await fn({
      x,
      y,
      initialPlacement: placement,
      placement: statefulPlacement,
      strategy,
      middlewareData,
      rects,
      platform: platformWithDetectOverflow,
      elements: {
        reference,
        floating
      }
    });
    x = nextX != null ? nextX : x;
    y = nextY != null ? nextY : y;
    middlewareData[name] = {
      ...middlewareData[name],
      ...data
    };
    if (reset && resetCount < MAX_RESET_COUNT) {
      resetCount++;
      if (typeof reset === "object") {
        if (reset.placement) {
          statefulPlacement = reset.placement;
        }
        if (reset.rects) {
          rects = reset.rects === true ? await platform3.getElementRects({
            reference,
            floating,
            strategy
          }) : reset.rects;
        }
        ({
          x,
          y
        } = computeCoordsFromPlacement(rects, statefulPlacement, rtl));
      }
      i = -1;
    }
  }
  return {
    x,
    y,
    placement: statefulPlacement,
    strategy,
    middlewareData
  };
};
var flip = function(options) {
  if (options === void 0) {
    options = {};
  }
  return {
    name: "flip",
    options,
    async fn(state) {
      var _middlewareData$arrow, _middlewareData$flip;
      const {
        placement,
        middlewareData,
        rects,
        initialPlacement,
        platform: platform3,
        elements
      } = state;
      const {
        mainAxis: checkMainAxis = true,
        crossAxis: checkCrossAxis = true,
        fallbackPlacements: specifiedFallbackPlacements,
        fallbackStrategy = "bestFit",
        fallbackAxisSideDirection = "none",
        flipAlignment = true,
        ...detectOverflowOptions
      } = evaluate(options, state);
      if ((_middlewareData$arrow = middlewareData.arrow) != null && _middlewareData$arrow.alignmentOffset) {
        return {};
      }
      const side = getSide(placement);
      const initialSideAxis = getSideAxis(initialPlacement);
      const isBasePlacement = getSide(initialPlacement) === initialPlacement;
      const rtl = await (platform3.isRTL == null ? void 0 : platform3.isRTL(elements.floating));
      const fallbackPlacements = specifiedFallbackPlacements || (isBasePlacement || !flipAlignment ? [getOppositePlacement(initialPlacement)] : getExpandedPlacements(initialPlacement));
      const hasFallbackAxisSideDirection = fallbackAxisSideDirection !== "none";
      if (!specifiedFallbackPlacements && hasFallbackAxisSideDirection) {
        fallbackPlacements.push(...getOppositeAxisPlacements(initialPlacement, flipAlignment, fallbackAxisSideDirection, rtl));
      }
      const placements2 = [initialPlacement, ...fallbackPlacements];
      const overflow = await platform3.detectOverflow(state, detectOverflowOptions);
      const overflows = [];
      let overflowsData = ((_middlewareData$flip = middlewareData.flip) == null ? void 0 : _middlewareData$flip.overflows) || [];
      if (checkMainAxis) {
        overflows.push(overflow[side]);
      }
      if (checkCrossAxis) {
        const sides2 = getAlignmentSides(placement, rects, rtl);
        overflows.push(overflow[sides2[0]], overflow[sides2[1]]);
      }
      overflowsData = [...overflowsData, {
        placement,
        overflows
      }];
      if (!overflows.every((side2) => side2 <= 0)) {
        var _middlewareData$flip2, _overflowsData$filter;
        const nextIndex = (((_middlewareData$flip2 = middlewareData.flip) == null ? void 0 : _middlewareData$flip2.index) || 0) + 1;
        const nextPlacement = placements2[nextIndex];
        if (nextPlacement) {
          const ignoreCrossAxisOverflow = checkCrossAxis === "alignment" ? initialSideAxis !== getSideAxis(nextPlacement) : false;
          if (!ignoreCrossAxisOverflow || // We leave the current main axis only if every placement on that axis
          // overflows the main axis.
          overflowsData.every((d) => getSideAxis(d.placement) === initialSideAxis ? d.overflows[0] > 0 : true)) {
            return {
              data: {
                index: nextIndex,
                overflows: overflowsData
              },
              reset: {
                placement: nextPlacement
              }
            };
          }
        }
        let resetPlacement = (_overflowsData$filter = overflowsData.filter((d) => d.overflows[0] <= 0).sort((a, b) => a.overflows[1] - b.overflows[1])[0]) == null ? void 0 : _overflowsData$filter.placement;
        if (!resetPlacement) {
          switch (fallbackStrategy) {
            case "bestFit": {
              var _overflowsData$filter2;
              const placement2 = (_overflowsData$filter2 = overflowsData.filter((d) => {
                if (hasFallbackAxisSideDirection) {
                  const currentSideAxis = getSideAxis(d.placement);
                  return currentSideAxis === initialSideAxis || // Create a bias to the `y` side axis due to horizontal
                  // reading directions favoring greater width.
                  currentSideAxis === "y";
                }
                return true;
              }).map((d) => [d.placement, d.overflows.filter((overflow2) => overflow2 > 0).reduce((acc, overflow2) => acc + overflow2, 0)]).sort((a, b) => a[1] - b[1])[0]) == null ? void 0 : _overflowsData$filter2[0];
              if (placement2) {
                resetPlacement = placement2;
              }
              break;
            }
            case "initialPlacement":
              resetPlacement = initialPlacement;
              break;
          }
        }
        if (placement !== resetPlacement) {
          return {
            reset: {
              placement: resetPlacement
            }
          };
        }
      }
      return {};
    }
  };
};
function getSideOffsets(overflow, rect) {
  return {
    top: overflow.top - rect.height,
    right: overflow.right - rect.width,
    bottom: overflow.bottom - rect.height,
    left: overflow.left - rect.width
  };
}
function isAnySideFullyClipped(overflow) {
  return sides.some((side) => overflow[side] >= 0);
}
var hide = function(options) {
  if (options === void 0) {
    options = {};
  }
  return {
    name: "hide",
    options,
    async fn(state) {
      const {
        rects,
        platform: platform3
      } = state;
      const {
        strategy = "referenceHidden",
        ...detectOverflowOptions
      } = evaluate(options, state);
      switch (strategy) {
        case "referenceHidden": {
          const overflow = await platform3.detectOverflow(state, {
            ...detectOverflowOptions,
            elementContext: "reference"
          });
          const offsets = getSideOffsets(overflow, rects.reference);
          return {
            data: {
              referenceHiddenOffsets: offsets,
              referenceHidden: isAnySideFullyClipped(offsets)
            }
          };
        }
        case "escaped": {
          const overflow = await platform3.detectOverflow(state, {
            ...detectOverflowOptions,
            altBoundary: true
          });
          const offsets = getSideOffsets(overflow, rects.floating);
          return {
            data: {
              escapedOffsets: offsets,
              escaped: isAnySideFullyClipped(offsets)
            }
          };
        }
        default: {
          return {};
        }
      }
    }
  };
};
var originSides = /* @__PURE__ */ new Set(["left", "top"]);
async function convertValueToCoords(state, options) {
  const {
    placement,
    platform: platform3,
    elements
  } = state;
  const rtl = await (platform3.isRTL == null ? void 0 : platform3.isRTL(elements.floating));
  const side = getSide(placement);
  const alignment = getAlignment(placement);
  const isVertical = getSideAxis(placement) === "y";
  const mainAxisMulti = originSides.has(side) ? -1 : 1;
  const crossAxisMulti = rtl && isVertical ? -1 : 1;
  const rawValue = evaluate(options, state);
  let {
    mainAxis,
    crossAxis,
    alignmentAxis
  } = typeof rawValue === "number" ? {
    mainAxis: rawValue,
    crossAxis: 0,
    alignmentAxis: null
  } : {
    mainAxis: rawValue.mainAxis || 0,
    crossAxis: rawValue.crossAxis || 0,
    alignmentAxis: rawValue.alignmentAxis
  };
  if (alignment && typeof alignmentAxis === "number") {
    crossAxis = alignment === "end" ? alignmentAxis * -1 : alignmentAxis;
  }
  return isVertical ? {
    x: crossAxis * crossAxisMulti,
    y: mainAxis * mainAxisMulti
  } : {
    x: mainAxis * mainAxisMulti,
    y: crossAxis * crossAxisMulti
  };
}
var offset = function(options) {
  if (options === void 0) {
    options = 0;
  }
  return {
    name: "offset",
    options,
    async fn(state) {
      var _middlewareData$offse, _middlewareData$arrow;
      const {
        x,
        y,
        placement,
        middlewareData
      } = state;
      const diffCoords = await convertValueToCoords(state, options);
      if (placement === ((_middlewareData$offse = middlewareData.offset) == null ? void 0 : _middlewareData$offse.placement) && (_middlewareData$arrow = middlewareData.arrow) != null && _middlewareData$arrow.alignmentOffset) {
        return {};
      }
      return {
        x: x + diffCoords.x,
        y: y + diffCoords.y,
        data: {
          ...diffCoords,
          placement
        }
      };
    }
  };
};
var shift = function(options) {
  if (options === void 0) {
    options = {};
  }
  return {
    name: "shift",
    options,
    async fn(state) {
      const {
        x,
        y,
        placement,
        platform: platform3
      } = state;
      const {
        mainAxis: checkMainAxis = true,
        crossAxis: checkCrossAxis = false,
        limiter = {
          fn: (_ref) => {
            let {
              x: x2,
              y: y2
            } = _ref;
            return {
              x: x2,
              y: y2
            };
          }
        },
        ...detectOverflowOptions
      } = evaluate(options, state);
      const coords = {
        x,
        y
      };
      const overflow = await platform3.detectOverflow(state, detectOverflowOptions);
      const crossAxis = getSideAxis(getSide(placement));
      const mainAxis = getOppositeAxis(crossAxis);
      let mainAxisCoord = coords[mainAxis];
      let crossAxisCoord = coords[crossAxis];
      if (checkMainAxis) {
        const minSide = mainAxis === "y" ? "top" : "left";
        const maxSide = mainAxis === "y" ? "bottom" : "right";
        const min2 = mainAxisCoord + overflow[minSide];
        const max2 = mainAxisCoord - overflow[maxSide];
        mainAxisCoord = clamp(min2, mainAxisCoord, max2);
      }
      if (checkCrossAxis) {
        const minSide = crossAxis === "y" ? "top" : "left";
        const maxSide = crossAxis === "y" ? "bottom" : "right";
        const min2 = crossAxisCoord + overflow[minSide];
        const max2 = crossAxisCoord - overflow[maxSide];
        crossAxisCoord = clamp(min2, crossAxisCoord, max2);
      }
      const limitedCoords = limiter.fn({
        ...state,
        [mainAxis]: mainAxisCoord,
        [crossAxis]: crossAxisCoord
      });
      return {
        ...limitedCoords,
        data: {
          x: limitedCoords.x - x,
          y: limitedCoords.y - y,
          enabled: {
            [mainAxis]: checkMainAxis,
            [crossAxis]: checkCrossAxis
          }
        }
      };
    }
  };
};
var limitShift = function(options) {
  if (options === void 0) {
    options = {};
  }
  return {
    options,
    fn(state) {
      const {
        x,
        y,
        placement,
        rects,
        middlewareData
      } = state;
      const {
        offset: offset4 = 0,
        mainAxis: checkMainAxis = true,
        crossAxis: checkCrossAxis = true
      } = evaluate(options, state);
      const coords = {
        x,
        y
      };
      const crossAxis = getSideAxis(placement);
      const mainAxis = getOppositeAxis(crossAxis);
      let mainAxisCoord = coords[mainAxis];
      let crossAxisCoord = coords[crossAxis];
      const rawOffset = evaluate(offset4, state);
      const computedOffset = typeof rawOffset === "number" ? {
        mainAxis: rawOffset,
        crossAxis: 0
      } : {
        mainAxis: 0,
        crossAxis: 0,
        ...rawOffset
      };
      if (checkMainAxis) {
        const len = mainAxis === "y" ? "height" : "width";
        const limitMin = rects.reference[mainAxis] - rects.floating[len] + computedOffset.mainAxis;
        const limitMax = rects.reference[mainAxis] + rects.reference[len] - computedOffset.mainAxis;
        if (mainAxisCoord < limitMin) {
          mainAxisCoord = limitMin;
        } else if (mainAxisCoord > limitMax) {
          mainAxisCoord = limitMax;
        }
      }
      if (checkCrossAxis) {
        var _middlewareData$offse, _middlewareData$offse2;
        const len = mainAxis === "y" ? "width" : "height";
        const isOriginSide = originSides.has(getSide(placement));
        const limitMin = rects.reference[crossAxis] - rects.floating[len] + (isOriginSide ? ((_middlewareData$offse = middlewareData.offset) == null ? void 0 : _middlewareData$offse[crossAxis]) || 0 : 0) + (isOriginSide ? 0 : computedOffset.crossAxis);
        const limitMax = rects.reference[crossAxis] + rects.reference[len] + (isOriginSide ? 0 : ((_middlewareData$offse2 = middlewareData.offset) == null ? void 0 : _middlewareData$offse2[crossAxis]) || 0) - (isOriginSide ? computedOffset.crossAxis : 0);
        if (crossAxisCoord < limitMin) {
          crossAxisCoord = limitMin;
        } else if (crossAxisCoord > limitMax) {
          crossAxisCoord = limitMax;
        }
      }
      return {
        [mainAxis]: mainAxisCoord,
        [crossAxis]: crossAxisCoord
      };
    }
  };
};
var size = function(options) {
  if (options === void 0) {
    options = {};
  }
  return {
    name: "size",
    options,
    async fn(state) {
      var _state$middlewareData, _state$middlewareData2;
      const {
        placement,
        rects,
        platform: platform3,
        elements
      } = state;
      const {
        apply = () => {
        },
        ...detectOverflowOptions
      } = evaluate(options, state);
      const overflow = await platform3.detectOverflow(state, detectOverflowOptions);
      const side = getSide(placement);
      const alignment = getAlignment(placement);
      const isYAxis = getSideAxis(placement) === "y";
      const {
        width,
        height
      } = rects.floating;
      let heightSide;
      let widthSide;
      if (side === "top" || side === "bottom") {
        heightSide = side;
        widthSide = alignment === (await (platform3.isRTL == null ? void 0 : platform3.isRTL(elements.floating)) ? "start" : "end") ? "left" : "right";
      } else {
        widthSide = side;
        heightSide = alignment === "end" ? "top" : "bottom";
      }
      const maximumClippingHeight = height - overflow.top - overflow.bottom;
      const maximumClippingWidth = width - overflow.left - overflow.right;
      const overflowAvailableHeight = min(height - overflow[heightSide], maximumClippingHeight);
      const overflowAvailableWidth = min(width - overflow[widthSide], maximumClippingWidth);
      const noShift = !state.middlewareData.shift;
      let availableHeight = overflowAvailableHeight;
      let availableWidth = overflowAvailableWidth;
      if ((_state$middlewareData = state.middlewareData.shift) != null && _state$middlewareData.enabled.x) {
        availableWidth = maximumClippingWidth;
      }
      if ((_state$middlewareData2 = state.middlewareData.shift) != null && _state$middlewareData2.enabled.y) {
        availableHeight = maximumClippingHeight;
      }
      if (noShift && !alignment) {
        const xMin = max(overflow.left, 0);
        const xMax = max(overflow.right, 0);
        const yMin = max(overflow.top, 0);
        const yMax = max(overflow.bottom, 0);
        if (isYAxis) {
          availableWidth = width - 2 * (xMin !== 0 || xMax !== 0 ? xMin + xMax : max(overflow.left, overflow.right));
        } else {
          availableHeight = height - 2 * (yMin !== 0 || yMax !== 0 ? yMin + yMax : max(overflow.top, overflow.bottom));
        }
      }
      await apply({
        ...state,
        availableWidth,
        availableHeight
      });
      const nextDimensions = await platform3.getDimensions(elements.floating);
      if (width !== nextDimensions.width || height !== nextDimensions.height) {
        return {
          reset: {
            rects: true
          }
        };
      }
      return {};
    }
  };
};

// node_modules/@floating-ui/dom/dist/floating-ui.dom.mjs
function getCssDimensions(element) {
  const css = getComputedStyle2(element);
  let width = parseFloat(css.width) || 0;
  let height = parseFloat(css.height) || 0;
  const hasOffset = isHTMLElement(element);
  const offsetWidth = hasOffset ? element.offsetWidth : width;
  const offsetHeight = hasOffset ? element.offsetHeight : height;
  const shouldFallback = round(width) !== offsetWidth || round(height) !== offsetHeight;
  if (shouldFallback) {
    width = offsetWidth;
    height = offsetHeight;
  }
  return {
    width,
    height,
    $: shouldFallback
  };
}
function unwrapElement(element) {
  return !isElement(element) ? element.contextElement : element;
}
function getScale(element) {
  const domElement = unwrapElement(element);
  if (!isHTMLElement(domElement)) {
    return createCoords(1);
  }
  const rect = domElement.getBoundingClientRect();
  const {
    width,
    height,
    $
  } = getCssDimensions(domElement);
  let x = ($ ? round(rect.width) : rect.width) / width;
  let y = ($ ? round(rect.height) : rect.height) / height;
  if (!x || !Number.isFinite(x)) {
    x = 1;
  }
  if (!y || !Number.isFinite(y)) {
    y = 1;
  }
  return {
    x,
    y
  };
}
var noOffsets = /* @__PURE__ */ createCoords(0);
function getVisualOffsets(element) {
  const win = getWindow(element);
  if (!isWebKit() || !win.visualViewport) {
    return noOffsets;
  }
  return {
    x: win.visualViewport.offsetLeft,
    y: win.visualViewport.offsetTop
  };
}
function shouldAddVisualOffsets(element, isFixed, floatingOffsetParent) {
  if (isFixed === void 0) {
    isFixed = false;
  }
  if (!floatingOffsetParent || isFixed && floatingOffsetParent !== getWindow(element)) {
    return false;
  }
  return isFixed;
}
function getBoundingClientRect(element, includeScale, isFixedStrategy, offsetParent) {
  if (includeScale === void 0) {
    includeScale = false;
  }
  if (isFixedStrategy === void 0) {
    isFixedStrategy = false;
  }
  const clientRect = element.getBoundingClientRect();
  const domElement = unwrapElement(element);
  let scale = createCoords(1);
  if (includeScale) {
    if (offsetParent) {
      if (isElement(offsetParent)) {
        scale = getScale(offsetParent);
      }
    } else {
      scale = getScale(element);
    }
  }
  const visualOffsets = shouldAddVisualOffsets(domElement, isFixedStrategy, offsetParent) ? getVisualOffsets(domElement) : createCoords(0);
  let x = (clientRect.left + visualOffsets.x) / scale.x;
  let y = (clientRect.top + visualOffsets.y) / scale.y;
  let width = clientRect.width / scale.x;
  let height = clientRect.height / scale.y;
  if (domElement) {
    const win = getWindow(domElement);
    const offsetWin = offsetParent && isElement(offsetParent) ? getWindow(offsetParent) : offsetParent;
    let currentWin = win;
    let currentIFrame = getFrameElement(currentWin);
    while (currentIFrame && offsetParent && offsetWin !== currentWin) {
      const iframeScale = getScale(currentIFrame);
      const iframeRect = currentIFrame.getBoundingClientRect();
      const css = getComputedStyle2(currentIFrame);
      const left = iframeRect.left + (currentIFrame.clientLeft + parseFloat(css.paddingLeft)) * iframeScale.x;
      const top = iframeRect.top + (currentIFrame.clientTop + parseFloat(css.paddingTop)) * iframeScale.y;
      x *= iframeScale.x;
      y *= iframeScale.y;
      width *= iframeScale.x;
      height *= iframeScale.y;
      x += left;
      y += top;
      currentWin = getWindow(currentIFrame);
      currentIFrame = getFrameElement(currentWin);
    }
  }
  return rectToClientRect({
    width,
    height,
    x,
    y
  });
}
function getWindowScrollBarX(element, rect) {
  const leftScroll = getNodeScroll(element).scrollLeft;
  if (!rect) {
    return getBoundingClientRect(getDocumentElement(element)).left + leftScroll;
  }
  return rect.left + leftScroll;
}
function getHTMLOffset(documentElement, scroll) {
  const htmlRect = documentElement.getBoundingClientRect();
  const x = htmlRect.left + scroll.scrollLeft - getWindowScrollBarX(documentElement, htmlRect);
  const y = htmlRect.top + scroll.scrollTop;
  return {
    x,
    y
  };
}
function convertOffsetParentRelativeRectToViewportRelativeRect(_ref) {
  let {
    elements,
    rect,
    offsetParent,
    strategy
  } = _ref;
  const isFixed = strategy === "fixed";
  const documentElement = getDocumentElement(offsetParent);
  const topLayer = elements ? isTopLayer(elements.floating) : false;
  if (offsetParent === documentElement || topLayer && isFixed) {
    return rect;
  }
  let scroll = {
    scrollLeft: 0,
    scrollTop: 0
  };
  let scale = createCoords(1);
  const offsets = createCoords(0);
  const isOffsetParentAnElement = isHTMLElement(offsetParent);
  if (isOffsetParentAnElement || !isOffsetParentAnElement && !isFixed) {
    if (getNodeName(offsetParent) !== "body" || isOverflowElement(documentElement)) {
      scroll = getNodeScroll(offsetParent);
    }
    if (isOffsetParentAnElement) {
      const offsetRect = getBoundingClientRect(offsetParent);
      scale = getScale(offsetParent);
      offsets.x = offsetRect.x + offsetParent.clientLeft;
      offsets.y = offsetRect.y + offsetParent.clientTop;
    }
  }
  const htmlOffset = documentElement && !isOffsetParentAnElement && !isFixed ? getHTMLOffset(documentElement, scroll) : createCoords(0);
  return {
    width: rect.width * scale.x,
    height: rect.height * scale.y,
    x: rect.x * scale.x - scroll.scrollLeft * scale.x + offsets.x + htmlOffset.x,
    y: rect.y * scale.y - scroll.scrollTop * scale.y + offsets.y + htmlOffset.y
  };
}
function getClientRects(element) {
  return Array.from(element.getClientRects());
}
function getDocumentRect(element) {
  const html = getDocumentElement(element);
  const scroll = getNodeScroll(element);
  const body = element.ownerDocument.body;
  const width = max(html.scrollWidth, html.clientWidth, body.scrollWidth, body.clientWidth);
  const height = max(html.scrollHeight, html.clientHeight, body.scrollHeight, body.clientHeight);
  let x = -scroll.scrollLeft + getWindowScrollBarX(element);
  const y = -scroll.scrollTop;
  if (getComputedStyle2(body).direction === "rtl") {
    x += max(html.clientWidth, body.clientWidth) - width;
  }
  return {
    width,
    height,
    x,
    y
  };
}
var SCROLLBAR_MAX = 25;
function getViewportRect(element, strategy) {
  const win = getWindow(element);
  const html = getDocumentElement(element);
  const visualViewport = win.visualViewport;
  let width = html.clientWidth;
  let height = html.clientHeight;
  let x = 0;
  let y = 0;
  if (visualViewport) {
    width = visualViewport.width;
    height = visualViewport.height;
    const visualViewportBased = isWebKit();
    if (!visualViewportBased || visualViewportBased && strategy === "fixed") {
      x = visualViewport.offsetLeft;
      y = visualViewport.offsetTop;
    }
  }
  const windowScrollbarX = getWindowScrollBarX(html);
  if (windowScrollbarX <= 0) {
    const doc = html.ownerDocument;
    const body = doc.body;
    const bodyStyles = getComputedStyle(body);
    const bodyMarginInline = doc.compatMode === "CSS1Compat" ? parseFloat(bodyStyles.marginLeft) + parseFloat(bodyStyles.marginRight) || 0 : 0;
    const clippingStableScrollbarWidth = Math.abs(html.clientWidth - body.clientWidth - bodyMarginInline);
    if (clippingStableScrollbarWidth <= SCROLLBAR_MAX) {
      width -= clippingStableScrollbarWidth;
    }
  } else if (windowScrollbarX <= SCROLLBAR_MAX) {
    width += windowScrollbarX;
  }
  return {
    width,
    height,
    x,
    y
  };
}
function getInnerBoundingClientRect(element, strategy) {
  const clientRect = getBoundingClientRect(element, true, strategy === "fixed");
  const top = clientRect.top + element.clientTop;
  const left = clientRect.left + element.clientLeft;
  const scale = isHTMLElement(element) ? getScale(element) : createCoords(1);
  const width = element.clientWidth * scale.x;
  const height = element.clientHeight * scale.y;
  const x = left * scale.x;
  const y = top * scale.y;
  return {
    width,
    height,
    x,
    y
  };
}
function getClientRectFromClippingAncestor(element, clippingAncestor, strategy) {
  let rect;
  if (clippingAncestor === "viewport") {
    rect = getViewportRect(element, strategy);
  } else if (clippingAncestor === "document") {
    rect = getDocumentRect(getDocumentElement(element));
  } else if (isElement(clippingAncestor)) {
    rect = getInnerBoundingClientRect(clippingAncestor, strategy);
  } else {
    const visualOffsets = getVisualOffsets(element);
    rect = {
      x: clippingAncestor.x - visualOffsets.x,
      y: clippingAncestor.y - visualOffsets.y,
      width: clippingAncestor.width,
      height: clippingAncestor.height
    };
  }
  return rectToClientRect(rect);
}
function hasFixedPositionAncestor(element, stopNode) {
  const parentNode = getParentNode(element);
  if (parentNode === stopNode || !isElement(parentNode) || isLastTraversableNode(parentNode)) {
    return false;
  }
  return getComputedStyle2(parentNode).position === "fixed" || hasFixedPositionAncestor(parentNode, stopNode);
}
function getClippingElementAncestors(element, cache) {
  const cachedResult = cache.get(element);
  if (cachedResult) {
    return cachedResult;
  }
  let result = getOverflowAncestors(element, [], false).filter((el) => isElement(el) && getNodeName(el) !== "body");
  let currentContainingBlockComputedStyle = null;
  const elementIsFixed = getComputedStyle2(element).position === "fixed";
  let currentNode = elementIsFixed ? getParentNode(element) : element;
  while (isElement(currentNode) && !isLastTraversableNode(currentNode)) {
    const computedStyle = getComputedStyle2(currentNode);
    const currentNodeIsContaining = isContainingBlock(currentNode);
    if (!currentNodeIsContaining && computedStyle.position === "fixed") {
      currentContainingBlockComputedStyle = null;
    }
    const shouldDropCurrentNode = elementIsFixed ? !currentNodeIsContaining && !currentContainingBlockComputedStyle : !currentNodeIsContaining && computedStyle.position === "static" && !!currentContainingBlockComputedStyle && (currentContainingBlockComputedStyle.position === "absolute" || currentContainingBlockComputedStyle.position === "fixed") || isOverflowElement(currentNode) && !currentNodeIsContaining && hasFixedPositionAncestor(element, currentNode);
    if (shouldDropCurrentNode) {
      result = result.filter((ancestor) => ancestor !== currentNode);
    } else {
      currentContainingBlockComputedStyle = computedStyle;
    }
    currentNode = getParentNode(currentNode);
  }
  cache.set(element, result);
  return result;
}
function getClippingRect(_ref) {
  let {
    element,
    boundary,
    rootBoundary,
    strategy
  } = _ref;
  const elementClippingAncestors = boundary === "clippingAncestors" ? isTopLayer(element) ? [] : getClippingElementAncestors(element, this._c) : [].concat(boundary);
  const clippingAncestors = [...elementClippingAncestors, rootBoundary];
  const firstRect = getClientRectFromClippingAncestor(element, clippingAncestors[0], strategy);
  let top = firstRect.top;
  let right = firstRect.right;
  let bottom = firstRect.bottom;
  let left = firstRect.left;
  for (let i = 1; i < clippingAncestors.length; i++) {
    const rect = getClientRectFromClippingAncestor(element, clippingAncestors[i], strategy);
    top = max(rect.top, top);
    right = min(rect.right, right);
    bottom = min(rect.bottom, bottom);
    left = max(rect.left, left);
  }
  return {
    width: right - left,
    height: bottom - top,
    x: left,
    y: top
  };
}
function getDimensions(element) {
  const {
    width,
    height
  } = getCssDimensions(element);
  return {
    width,
    height
  };
}
function getRectRelativeToOffsetParent(element, offsetParent, strategy) {
  const isOffsetParentAnElement = isHTMLElement(offsetParent);
  const documentElement = getDocumentElement(offsetParent);
  const isFixed = strategy === "fixed";
  const rect = getBoundingClientRect(element, true, isFixed, offsetParent);
  let scroll = {
    scrollLeft: 0,
    scrollTop: 0
  };
  const offsets = createCoords(0);
  function setLeftRTLScrollbarOffset() {
    offsets.x = getWindowScrollBarX(documentElement);
  }
  if (isOffsetParentAnElement || !isOffsetParentAnElement && !isFixed) {
    if (getNodeName(offsetParent) !== "body" || isOverflowElement(documentElement)) {
      scroll = getNodeScroll(offsetParent);
    }
    if (isOffsetParentAnElement) {
      const offsetRect = getBoundingClientRect(offsetParent, true, isFixed, offsetParent);
      offsets.x = offsetRect.x + offsetParent.clientLeft;
      offsets.y = offsetRect.y + offsetParent.clientTop;
    } else if (documentElement) {
      setLeftRTLScrollbarOffset();
    }
  }
  if (isFixed && !isOffsetParentAnElement && documentElement) {
    setLeftRTLScrollbarOffset();
  }
  const htmlOffset = documentElement && !isOffsetParentAnElement && !isFixed ? getHTMLOffset(documentElement, scroll) : createCoords(0);
  const x = rect.left + scroll.scrollLeft - offsets.x - htmlOffset.x;
  const y = rect.top + scroll.scrollTop - offsets.y - htmlOffset.y;
  return {
    x,
    y,
    width: rect.width,
    height: rect.height
  };
}
function isStaticPositioned(element) {
  return getComputedStyle2(element).position === "static";
}
function getTrueOffsetParent(element, polyfill) {
  if (!isHTMLElement(element) || getComputedStyle2(element).position === "fixed") {
    return null;
  }
  if (polyfill) {
    return polyfill(element);
  }
  let rawOffsetParent = element.offsetParent;
  if (getDocumentElement(element) === rawOffsetParent) {
    rawOffsetParent = rawOffsetParent.ownerDocument.body;
  }
  return rawOffsetParent;
}
function getOffsetParent(element, polyfill) {
  const win = getWindow(element);
  if (isTopLayer(element)) {
    return win;
  }
  if (!isHTMLElement(element)) {
    let svgOffsetParent = getParentNode(element);
    while (svgOffsetParent && !isLastTraversableNode(svgOffsetParent)) {
      if (isElement(svgOffsetParent) && !isStaticPositioned(svgOffsetParent)) {
        return svgOffsetParent;
      }
      svgOffsetParent = getParentNode(svgOffsetParent);
    }
    return win;
  }
  let offsetParent = getTrueOffsetParent(element, polyfill);
  while (offsetParent && isTableElement(offsetParent) && isStaticPositioned(offsetParent)) {
    offsetParent = getTrueOffsetParent(offsetParent, polyfill);
  }
  if (offsetParent && isLastTraversableNode(offsetParent) && isStaticPositioned(offsetParent) && !isContainingBlock(offsetParent)) {
    return win;
  }
  return offsetParent || getContainingBlock(element) || win;
}
var getElementRects = async function(data) {
  const getOffsetParentFn = this.getOffsetParent || getOffsetParent;
  const getDimensionsFn = this.getDimensions;
  const floatingDimensions = await getDimensionsFn(data.floating);
  return {
    reference: getRectRelativeToOffsetParent(data.reference, await getOffsetParentFn(data.floating), data.strategy),
    floating: {
      x: 0,
      y: 0,
      width: floatingDimensions.width,
      height: floatingDimensions.height
    }
  };
};
function isRTL(element) {
  return getComputedStyle2(element).direction === "rtl";
}
var platform2 = {
  convertOffsetParentRelativeRectToViewportRelativeRect,
  getDocumentElement,
  getClippingRect,
  getOffsetParent,
  getElementRects,
  getClientRects,
  getDimensions,
  getScale,
  isElement,
  isRTL
};
function rectsAreEqual(a, b) {
  return a.x === b.x && a.y === b.y && a.width === b.width && a.height === b.height;
}
function observeMove(element, onMove) {
  let io = null;
  let timeoutId;
  const root = getDocumentElement(element);
  function cleanup() {
    var _io;
    clearTimeout(timeoutId);
    (_io = io) == null || _io.disconnect();
    io = null;
  }
  function refresh(skip, threshold) {
    if (skip === void 0) {
      skip = false;
    }
    if (threshold === void 0) {
      threshold = 1;
    }
    cleanup();
    const elementRectForRootMargin = element.getBoundingClientRect();
    const {
      left,
      top,
      width,
      height
    } = elementRectForRootMargin;
    if (!skip) {
      onMove();
    }
    if (!width || !height) {
      return;
    }
    const insetTop = floor(top);
    const insetRight = floor(root.clientWidth - (left + width));
    const insetBottom = floor(root.clientHeight - (top + height));
    const insetLeft = floor(left);
    const rootMargin = -insetTop + "px " + -insetRight + "px " + -insetBottom + "px " + -insetLeft + "px";
    const options = {
      rootMargin,
      threshold: max(0, min(1, threshold)) || 1
    };
    let isFirstUpdate = true;
    function handleObserve(entries) {
      const ratio = entries[0].intersectionRatio;
      if (ratio !== threshold) {
        if (!isFirstUpdate) {
          return refresh();
        }
        if (!ratio) {
          timeoutId = setTimeout(() => {
            refresh(false, 1e-7);
          }, 1e3);
        } else {
          refresh(false, ratio);
        }
      }
      if (ratio === 1 && !rectsAreEqual(elementRectForRootMargin, element.getBoundingClientRect())) {
        refresh();
      }
      isFirstUpdate = false;
    }
    try {
      io = new IntersectionObserver(handleObserve, {
        ...options,
        // Handle <iframe>s
        root: root.ownerDocument
      });
    } catch (_e) {
      io = new IntersectionObserver(handleObserve, options);
    }
    io.observe(element);
  }
  refresh(true);
  return cleanup;
}
function autoUpdate(reference, floating, update2, options) {
  if (options === void 0) {
    options = {};
  }
  const {
    ancestorScroll = true,
    ancestorResize = true,
    elementResize = typeof ResizeObserver === "function",
    layoutShift = typeof IntersectionObserver === "function",
    animationFrame = false
  } = options;
  const referenceEl = unwrapElement(reference);
  const ancestors = ancestorScroll || ancestorResize ? [...referenceEl ? getOverflowAncestors(referenceEl) : [], ...floating ? getOverflowAncestors(floating) : []] : [];
  ancestors.forEach((ancestor) => {
    ancestorScroll && ancestor.addEventListener("scroll", update2, {
      passive: true
    });
    ancestorResize && ancestor.addEventListener("resize", update2);
  });
  const cleanupIo = referenceEl && layoutShift ? observeMove(referenceEl, update2) : null;
  let reobserveFrame = -1;
  let resizeObserver = null;
  if (elementResize) {
    resizeObserver = new ResizeObserver((_ref) => {
      let [firstEntry] = _ref;
      if (firstEntry && firstEntry.target === referenceEl && resizeObserver && floating) {
        resizeObserver.unobserve(floating);
        cancelAnimationFrame(reobserveFrame);
        reobserveFrame = requestAnimationFrame(() => {
          var _resizeObserver;
          (_resizeObserver = resizeObserver) == null || _resizeObserver.observe(floating);
        });
      }
      update2();
    });
    if (referenceEl && !animationFrame) {
      resizeObserver.observe(referenceEl);
    }
    if (floating) {
      resizeObserver.observe(floating);
    }
  }
  let frameId;
  let prevRefRect = animationFrame ? getBoundingClientRect(reference) : null;
  if (animationFrame) {
    frameLoop();
  }
  function frameLoop() {
    const nextRefRect = getBoundingClientRect(reference);
    if (prevRefRect && !rectsAreEqual(prevRefRect, nextRefRect)) {
      update2();
    }
    prevRefRect = nextRefRect;
    frameId = requestAnimationFrame(frameLoop);
  }
  update2();
  return () => {
    var _resizeObserver2;
    ancestors.forEach((ancestor) => {
      ancestorScroll && ancestor.removeEventListener("scroll", update2);
      ancestorResize && ancestor.removeEventListener("resize", update2);
    });
    cleanupIo == null || cleanupIo();
    (_resizeObserver2 = resizeObserver) == null || _resizeObserver2.disconnect();
    resizeObserver = null;
    if (animationFrame) {
      cancelAnimationFrame(frameId);
    }
  };
}
var offset2 = offset;
var shift2 = shift;
var flip2 = flip;
var size2 = size;
var hide2 = hide;
var limitShift2 = limitShift;
var computePosition2 = (reference, floating, options) => {
  const cache = /* @__PURE__ */ new Map();
  const mergedOptions = {
    platform: platform2,
    ...options
  };
  const platformWithCache = {
    ...mergedOptions.platform,
    _c: cache
  };
  return computePosition(reference, floating, {
    ...mergedOptions,
    platform: platformWithCache
  });
};

// node_modules/@floating-ui/react-dom/dist/floating-ui.react-dom.mjs
var React24 = __toESM(require_react(), 1);
var import_react2 = __toESM(require_react(), 1);
var ReactDOM3 = __toESM(require_react_dom(), 1);
var isClient = typeof document !== "undefined";
var noop2 = function noop3() {
};
var index = isClient ? import_react2.useLayoutEffect : noop2;
function deepEqual(a, b) {
  if (a === b) {
    return true;
  }
  if (typeof a !== typeof b) {
    return false;
  }
  if (typeof a === "function" && a.toString() === b.toString()) {
    return true;
  }
  let length;
  let i;
  let keys;
  if (a && b && typeof a === "object") {
    if (Array.isArray(a)) {
      length = a.length;
      if (length !== b.length) return false;
      for (i = length; i-- !== 0; ) {
        if (!deepEqual(a[i], b[i])) {
          return false;
        }
      }
      return true;
    }
    keys = Object.keys(a);
    length = keys.length;
    if (length !== Object.keys(b).length) {
      return false;
    }
    for (i = length; i-- !== 0; ) {
      if (!{}.hasOwnProperty.call(b, keys[i])) {
        return false;
      }
    }
    for (i = length; i-- !== 0; ) {
      const key = keys[i];
      if (key === "_owner" && a.$$typeof) {
        continue;
      }
      if (!deepEqual(a[key], b[key])) {
        return false;
      }
    }
    return true;
  }
  return a !== a && b !== b;
}
function getDPR(element) {
  if (typeof window === "undefined") {
    return 1;
  }
  const win = element.ownerDocument.defaultView || window;
  return win.devicePixelRatio || 1;
}
function roundByDPR(element, value) {
  const dpr = getDPR(element);
  return Math.round(value * dpr) / dpr;
}
function useLatestRef(value) {
  const ref = React24.useRef(value);
  index(() => {
    ref.current = value;
  });
  return ref;
}
function useFloating(options) {
  if (options === void 0) {
    options = {};
  }
  const {
    placement = "bottom",
    strategy = "absolute",
    middleware = [],
    platform: platform3,
    elements: {
      reference: externalReference,
      floating: externalFloating
    } = {},
    transform = true,
    whileElementsMounted,
    open
  } = options;
  const [data, setData] = React24.useState({
    x: 0,
    y: 0,
    strategy,
    placement,
    middlewareData: {},
    isPositioned: false
  });
  const [latestMiddleware, setLatestMiddleware] = React24.useState(middleware);
  if (!deepEqual(latestMiddleware, middleware)) {
    setLatestMiddleware(middleware);
  }
  const [_reference, _setReference] = React24.useState(null);
  const [_floating, _setFloating] = React24.useState(null);
  const setReference = React24.useCallback((node) => {
    if (node !== referenceRef.current) {
      referenceRef.current = node;
      _setReference(node);
    }
  }, []);
  const setFloating = React24.useCallback((node) => {
    if (node !== floatingRef.current) {
      floatingRef.current = node;
      _setFloating(node);
    }
  }, []);
  const referenceEl = externalReference || _reference;
  const floatingEl = externalFloating || _floating;
  const referenceRef = React24.useRef(null);
  const floatingRef = React24.useRef(null);
  const dataRef = React24.useRef(data);
  const hasWhileElementsMounted = whileElementsMounted != null;
  const whileElementsMountedRef = useLatestRef(whileElementsMounted);
  const platformRef = useLatestRef(platform3);
  const openRef = useLatestRef(open);
  const update2 = React24.useCallback(() => {
    if (!referenceRef.current || !floatingRef.current) {
      return;
    }
    const config = {
      placement,
      strategy,
      middleware: latestMiddleware
    };
    if (platformRef.current) {
      config.platform = platformRef.current;
    }
    computePosition2(referenceRef.current, floatingRef.current, config).then((data2) => {
      const fullData = {
        ...data2,
        // The floating element's position may be recomputed while it's closed
        // but still mounted (such as when transitioning out). To ensure
        // `isPositioned` will be `false` initially on the next open, avoid
        // setting it to `true` when `open === false` (must be specified).
        isPositioned: openRef.current !== false
      };
      if (isMountedRef.current && !deepEqual(dataRef.current, fullData)) {
        dataRef.current = fullData;
        ReactDOM3.flushSync(() => {
          setData(fullData);
        });
      }
    });
  }, [latestMiddleware, placement, strategy, platformRef, openRef]);
  index(() => {
    if (open === false && dataRef.current.isPositioned) {
      dataRef.current.isPositioned = false;
      setData((data2) => ({
        ...data2,
        isPositioned: false
      }));
    }
  }, [open]);
  const isMountedRef = React24.useRef(false);
  index(() => {
    isMountedRef.current = true;
    return () => {
      isMountedRef.current = false;
    };
  }, []);
  index(() => {
    if (referenceEl) referenceRef.current = referenceEl;
    if (floatingEl) floatingRef.current = floatingEl;
    if (referenceEl && floatingEl) {
      if (whileElementsMountedRef.current) {
        return whileElementsMountedRef.current(referenceEl, floatingEl, update2);
      }
      update2();
    }
  }, [referenceEl, floatingEl, update2, whileElementsMountedRef, hasWhileElementsMounted]);
  const refs = React24.useMemo(() => ({
    reference: referenceRef,
    floating: floatingRef,
    setReference,
    setFloating
  }), [setReference, setFloating]);
  const elements = React24.useMemo(() => ({
    reference: referenceEl,
    floating: floatingEl
  }), [referenceEl, floatingEl]);
  const floatingStyles = React24.useMemo(() => {
    const initialStyles = {
      position: strategy,
      left: 0,
      top: 0
    };
    if (!elements.floating) {
      return initialStyles;
    }
    const x = roundByDPR(elements.floating, data.x);
    const y = roundByDPR(elements.floating, data.y);
    if (transform) {
      return {
        ...initialStyles,
        transform: "translate(" + x + "px, " + y + "px)",
        ...getDPR(elements.floating) >= 1.5 && {
          willChange: "transform"
        }
      };
    }
    return {
      position: strategy,
      left: x,
      top: y
    };
  }, [strategy, transform, elements.floating, data.x, data.y]);
  return React24.useMemo(() => ({
    ...data,
    update: update2,
    refs,
    elements,
    floatingStyles
  }), [data, update2, refs, elements, floatingStyles]);
}
var offset3 = (options, deps) => {
  const result = offset2(options);
  return {
    name: result.name,
    fn: result.fn,
    options: [options, deps]
  };
};
var shift3 = (options, deps) => {
  const result = shift2(options);
  return {
    name: result.name,
    fn: result.fn,
    options: [options, deps]
  };
};
var limitShift3 = (options, deps) => {
  const result = limitShift2(options);
  return {
    fn: result.fn,
    options: [options, deps]
  };
};
var flip3 = (options, deps) => {
  const result = flip2(options);
  return {
    name: result.name,
    fn: result.fn,
    options: [options, deps]
  };
};
var size3 = (options, deps) => {
  const result = size2(options);
  return {
    name: result.name,
    fn: result.fn,
    options: [options, deps]
  };
};
var hide3 = (options, deps) => {
  const result = hide2(options);
  return {
    name: result.name,
    fn: result.fn,
    options: [options, deps]
  };
};

// node_modules/@base-ui/react/utils/popups/popupStoreUtils.mjs
var React29 = __toESM(require_react(), 1);
var ReactDOM4 = __toESM(require_react_dom(), 1);

// node_modules/@base-ui/react/floating-ui-react/hooks/useSyncedFloatingRootContext.mjs
var React28 = __toESM(require_react(), 1);

// node_modules/@base-ui/utils/store/createSelector.mjs
var createSelector = (a, b, c, d, e, f, ...other) => {
  if (other.length > 0) {
    throw new Error(true ? "Unsupported number of selectors" : formatErrorMessage_default(1));
  }
  let selector;
  if (a && b && c && d && e && f) {
    selector = (state, a1, a2, a3) => {
      const va = a(state, a1, a2, a3);
      const vb = b(state, a1, a2, a3);
      const vc = c(state, a1, a2, a3);
      const vd = d(state, a1, a2, a3);
      const ve = e(state, a1, a2, a3);
      return f(va, vb, vc, vd, ve, a1, a2, a3);
    };
  } else if (a && b && c && d && e) {
    selector = (state, a1, a2, a3) => {
      const va = a(state, a1, a2, a3);
      const vb = b(state, a1, a2, a3);
      const vc = c(state, a1, a2, a3);
      const vd = d(state, a1, a2, a3);
      return e(va, vb, vc, vd, a1, a2, a3);
    };
  } else if (a && b && c && d) {
    selector = (state, a1, a2, a3) => {
      const va = a(state, a1, a2, a3);
      const vb = b(state, a1, a2, a3);
      const vc = c(state, a1, a2, a3);
      return d(va, vb, vc, a1, a2, a3);
    };
  } else if (a && b && c) {
    selector = (state, a1, a2, a3) => {
      const va = a(state, a1, a2, a3);
      const vb = b(state, a1, a2, a3);
      return c(va, vb, a1, a2, a3);
    };
  } else if (a && b) {
    selector = (state, a1, a2, a3) => {
      const va = a(state, a1, a2, a3);
      return b(va, a1, a2, a3);
    };
  } else if (a) {
    selector = a;
  } else {
    throw (
      /* minify-error-disabled */
      new Error("Missing arguments")
    );
  }
  return selector;
};

// node_modules/@base-ui/utils/store/useStore.mjs
var React26 = __toESM(require_react(), 1);
var import_shim = __toESM(require_shim(), 1);
var import_with_selector = __toESM(require_with_selector(), 1);

// node_modules/@base-ui/utils/fastHooks.mjs
var React25 = __toESM(require_react(), 1);
var hooks = [];
var currentInstance = void 0;
function getInstance() {
  return currentInstance;
}
function register(hook) {
  hooks.push(hook);
}
function fastComponent(fn) {
  const FastComponent = (props, forwardedRef) => {
    const instance = useRefWithInit(createInstance).current;
    let result;
    try {
      currentInstance = instance;
      for (const hook of hooks) {
        hook.before(instance);
      }
      result = fn(props, forwardedRef);
      for (const hook of hooks) {
        hook.after(instance);
      }
      instance.didInitialize = true;
    } finally {
      currentInstance = void 0;
    }
    return result;
  };
  FastComponent.displayName = fn.displayName || fn.name;
  return FastComponent;
}
function fastComponentRef(fn) {
  return /* @__PURE__ */ React25.forwardRef(fastComponent(fn));
}
function createInstance() {
  return {
    didInitialize: false
  };
}

// node_modules/@base-ui/utils/store/useStore.mjs
var canUseRawUseSyncExternalStore = isReactVersionAtLeast(19);
var useStoreImplementation = canUseRawUseSyncExternalStore ? useStoreFast : useStoreLegacy;
function useStore(store, selector, a1, a2, a3) {
  return useStoreImplementation(store, selector, a1, a2, a3);
}
function useStoreR19(store, selector, a1, a2, a3) {
  const getSelection = React26.useCallback(() => selector(store.getSnapshot(), a1, a2, a3), [store, selector, a1, a2, a3]);
  return (0, import_shim.useSyncExternalStore)(store.subscribe, getSelection, getSelection);
}
register({
  before(instance) {
    instance.syncIndex = 0;
    if (!instance.didInitialize) {
      instance.syncTick = 1;
      instance.syncHooks = [];
      instance.didChangeStore = true;
      instance.getSnapshot = () => {
        let didChange2 = false;
        for (let i = 0; i < instance.syncHooks.length; i += 1) {
          const hook = instance.syncHooks[i];
          const value = hook.selector(hook.store.state, hook.a1, hook.a2, hook.a3);
          if (!Object.is(hook.value, value)) {
            didChange2 = true;
            hook.value = value;
          }
        }
        if (didChange2) {
          instance.syncTick += 1;
        }
        return instance.syncTick;
      };
    }
  },
  after(instance) {
    if (instance.syncHooks.length > 0) {
      if (instance.didChangeStore) {
        instance.didChangeStore = false;
        instance.subscribe = (onStoreChange) => {
          const stores = /* @__PURE__ */ new Set();
          for (const hook of instance.syncHooks) {
            stores.add(hook.store);
          }
          const unsubscribes = [];
          for (const store of stores) {
            unsubscribes.push(store.subscribe(onStoreChange));
          }
          return () => {
            for (const unsubscribe of unsubscribes) {
              unsubscribe();
            }
          };
        };
      }
      (0, import_shim.useSyncExternalStore)(instance.subscribe, instance.getSnapshot, instance.getSnapshot);
    }
  }
});
function useStoreFast(store, selector, a1, a2, a3) {
  const instance = getInstance();
  if (!instance) {
    return useStoreR19(store, selector, a1, a2, a3);
  }
  const index2 = instance.syncIndex;
  instance.syncIndex += 1;
  let hook;
  if (!instance.didInitialize) {
    hook = {
      store,
      selector,
      a1,
      a2,
      a3,
      value: selector(store.getSnapshot(), a1, a2, a3)
    };
    instance.syncHooks.push(hook);
  } else {
    hook = instance.syncHooks[index2];
    if (hook.store !== store || hook.selector !== selector || !Object.is(hook.a1, a1) || !Object.is(hook.a2, a2) || !Object.is(hook.a3, a3)) {
      if (hook.store !== store) {
        instance.didChangeStore = true;
      }
      hook.store = store;
      hook.selector = selector;
      hook.a1 = a1;
      hook.a2 = a2;
      hook.a3 = a3;
      hook.value = selector(store.getSnapshot(), a1, a2, a3);
    }
  }
  return hook.value;
}
function useStoreLegacy(store, selector, a1, a2, a3) {
  return (0, import_with_selector.useSyncExternalStoreWithSelector)(store.subscribe, store.getSnapshot, store.getSnapshot, (state) => selector(state, a1, a2, a3));
}

// node_modules/@base-ui/utils/store/Store.mjs
var Store = class {
  /**
   * The current state of the store.
   * This property is updated immediately when the state changes as a result of calling {@link setState}, {@link update}, or {@link set}.
   * To subscribe to state changes, use the {@link useState} method. The value returned by {@link useState} is updated after the component renders (similarly to React's useState).
   * The values can be used directly (to avoid subscribing to the store) in effects or event handlers.
   *
   * Do not modify properties in state directly. Instead, use the provided methods to ensure proper state management and listener notification.
   */
  // Internal state to handle recursive `setState()` calls
  constructor(state) {
    this.state = state;
    this.listeners = /* @__PURE__ */ new Set();
    this.updateTick = 0;
  }
  /**
   * Registers a listener that will be called whenever the store's state changes.
   *
   * @param fn The listener function to be called on state changes.
   * @returns A function to unsubscribe the listener.
   */
  subscribe = (fn) => {
    this.listeners.add(fn);
    return () => {
      this.listeners.delete(fn);
    };
  };
  /**
   * Returns the current state of the store.
   */
  getSnapshot = () => {
    return this.state;
  };
  /**
   * Updates the entire store's state and notifies all registered listeners.
   *
   * @param newState The new state to set for the store.
   */
  setState(newState) {
    if (this.state === newState) {
      return;
    }
    this.state = newState;
    this.updateTick += 1;
    const currentTick = this.updateTick;
    for (const listener of this.listeners) {
      if (currentTick !== this.updateTick) {
        return;
      }
      listener(newState);
    }
  }
  /**
   * Merges the provided changes into the current state and notifies listeners if there are changes.
   *
   * @param changes An object containing the changes to apply to the current state.
   */
  update(changes) {
    for (const key in changes) {
      if (!Object.is(this.state[key], changes[key])) {
        this.setState({
          ...this.state,
          ...changes
        });
        return;
      }
    }
  }
  /**
   * Sets a specific key in the store's state to a new value and notifies listeners if the value has changed.
   *
   * @param key The key in the store's state to update.
   * @param value The new value to set for the specified key.
   */
  set(key, value) {
    if (!Object.is(this.state[key], value)) {
      this.setState({
        ...this.state,
        [key]: value
      });
    }
  }
  /**
   * Gives the state a new reference and updates all registered listeners.
   */
  notifyAll() {
    const newState = {
      ...this.state
    };
    this.setState(newState);
  }
  use(selector, a1, a2, a3) {
    return useStore(this, selector, a1, a2, a3);
  }
};

// node_modules/@base-ui/utils/store/ReactStore.mjs
var React27 = __toESM(require_react(), 1);
var ReactStore = class extends Store {
  /**
   * Creates a new ReactStore instance.
   *
   * @param state Initial state of the store.
   * @param context Non-reactive context values.
   * @param selectors Optional selectors for use with `useState`.
   */
  constructor(state, context = {}, selectors4) {
    super(state);
    this.context = context;
    this.selectors = selectors4;
  }
  /**
   * Non-reactive values such as refs, callbacks, etc.
   */
  /**
   * Synchronizes a single external value into the store.
   *
   * Note that the while the value in `state` is updated immediately, the value returned
   * by `useState` is updated before the next render (similarly to React's `useState`).
   */
  useSyncedValue(key, value) {
    React27.useDebugValue(key);
    const store = this;
    useIsoLayoutEffect(() => {
      if (store.state[key] !== value) {
        store.set(key, value);
      }
    }, [store, key, value]);
  }
  /**
   * Synchronizes a single external value into the store and
   * cleans it up (sets to `undefined`) on unmount.
   *
   * Note that the while the value in `state` is updated immediately, the value returned
   * by `useState` is updated before the next render (similarly to React's `useState`).
   */
  useSyncedValueWithCleanup(key, value) {
    const store = this;
    useIsoLayoutEffect(() => {
      if (store.state[key] !== value) {
        store.set(key, value);
      }
      return () => {
        store.set(key, void 0);
      };
    }, [store, key, value]);
  }
  /**
   * Synchronizes multiple external values into the store.
   *
   * Note that the while the values in `state` are updated immediately, the values returned
   * by `useState` are updated before the next render (similarly to React's `useState`).
   */
  useSyncedValues(statePart) {
    const store = this;
    if (true) {
      React27.useDebugValue(statePart, (p) => Object.keys(p));
      const keys = React27.useRef(Object.keys(statePart)).current;
      const nextKeys = Object.keys(statePart);
      if (keys.length !== nextKeys.length || keys.some((key, index2) => key !== nextKeys[index2])) {
        console.error("ReactStore.useSyncedValues expects the same prop keys on every render. Keys should be stable.");
      }
    }
    const dependencies = Object.values(statePart);
    useIsoLayoutEffect(() => {
      store.update(statePart);
    }, [store, ...dependencies]);
  }
  /**
   * Registers a controllable prop pair (`controlled`, `defaultValue`) for a specific key. If `controlled`
   * is non-undefined, the store's state at `key` is updated to match `controlled`.
   */
  useControlledProp(key, controlled) {
    React27.useDebugValue(key);
    const store = this;
    const isControlled = controlled !== void 0;
    useIsoLayoutEffect(() => {
      if (isControlled && !Object.is(store.state[key], controlled)) {
        store.setState({
          ...store.state,
          [key]: controlled
        });
      }
    }, [store, key, controlled, isControlled]);
    if (true) {
      const cache = this.controlledValues ??= /* @__PURE__ */ new Map();
      if (!cache.has(key)) {
        cache.set(key, isControlled);
      }
      const previouslyControlled = cache.get(key);
      if (previouslyControlled !== void 0 && previouslyControlled !== isControlled) {
        console.error(`A component is changing the ${isControlled ? "" : "un"}controlled state of ${key.toString()} to be ${isControlled ? "un" : ""}controlled. Elements should not switch from uncontrolled to controlled (or vice versa).`);
      }
    }
  }
  /** Gets the current value from the store using a selector with the provided key.
   *
   * @param key Key of the selector to use.
   */
  select(key, a1, a2, a3) {
    const selector = this.selectors[key];
    return selector(this.state, a1, a2, a3);
  }
  /**
   * Returns a value from the store's state using a selector function.
   * Used to subscribe to specific parts of the state.
   * This methods causes a rerender whenever the selected state changes.
   *
   * @param key Key of the selector to use.
   */
  useState(key, a1, a2, a3) {
    React27.useDebugValue(key);
    return useStore(this, this.selectors[key], a1, a2, a3);
  }
  /**
   * Wraps a function with `useStableCallback` to ensure it has a stable reference
   * and assigns it to the context.
   *
   * @param key Key of the event callback. Must be a function in the context.
   * @param fn Function to assign.
   */
  useContextCallback(key, fn) {
    React27.useDebugValue(key);
    const stableFunction = useStableCallback(fn ?? NOOP);
    this.context[key] = stableFunction;
  }
  /**
   * Returns a stable setter function for a specific key in the store's state.
   * It's commonly used to pass as a ref callback to React elements.
   *
   * @param key Key of the state to set.
   */
  useStateSetter(key) {
    const ref = React27.useRef(void 0);
    if (ref.current === void 0) {
      ref.current = (value) => {
        this.set(key, value);
      };
    }
    return ref.current;
  }
  /**
   * Observes changes derived from the store's selectors and calls the listener when the selected value changes.
   *
   * @param key Key of the selector to observe.
   * @param listener Listener function called when the selector result changes.
   */
  observe(selector, listener) {
    let selectFn;
    if (typeof selector === "function") {
      selectFn = selector;
    } else {
      selectFn = this.selectors[selector];
    }
    let prevValue = selectFn(this.state);
    listener(prevValue, prevValue, this);
    return this.subscribe((nextState) => {
      const nextValue = selectFn(nextState);
      if (!Object.is(prevValue, nextValue)) {
        const oldValue = prevValue;
        prevValue = nextValue;
        listener(nextValue, oldValue, this);
      }
    });
  }
};

// node_modules/@base-ui/react/floating-ui-react/components/FloatingRootStore.mjs
var selectors = {
  open: createSelector((state) => state.open),
  transitionStatus: createSelector((state) => state.transitionStatus),
  domReferenceElement: createSelector((state) => state.domReferenceElement),
  referenceElement: createSelector((state) => state.positionReference ?? state.referenceElement),
  floatingElement: createSelector((state) => state.floatingElement),
  floatingId: createSelector((state) => state.floatingId)
};
var FloatingRootStore = class extends ReactStore {
  constructor(options) {
    const {
      syncOnly,
      nested,
      onOpenChange,
      triggerElements,
      ...initialState
    } = options;
    super({
      ...initialState,
      positionReference: initialState.referenceElement,
      domReferenceElement: initialState.referenceElement
    }, {
      onOpenChange,
      dataRef: {
        current: {}
      },
      events: createEventEmitter(),
      nested,
      triggerElements
    }, selectors);
    this.syncOnly = syncOnly;
  }
  /**
   * Syncs the event used by hover logic to distinguish hover-open from click-like interaction.
   */
  syncOpenEvent = (newOpen, event) => {
    if (!newOpen || !this.state.open || // Prevent a pending hover-open from overwriting a click-open event, while allowing
    // click events to upgrade a hover-open.
    event != null && isClickLikeEvent(event)) {
      this.context.dataRef.current.openEvent = newOpen ? event : void 0;
    }
  };
  /**
   * Runs the root-owned side effects for an open state change.
   */
  dispatchOpenChange = (newOpen, eventDetails) => {
    this.syncOpenEvent(newOpen, eventDetails.event);
    const details = {
      open: newOpen,
      reason: eventDetails.reason,
      nativeEvent: eventDetails.event,
      nested: this.context.nested,
      triggerElement: eventDetails.trigger
    };
    this.context.events.emit("openchange", details);
  };
  /**
   * Emits the `openchange` event through the internal event emitter and calls the `onOpenChange` handler with the provided arguments.
   *
   * @param newOpen The new open state.
   * @param eventDetails Details about the event that triggered the open state change.
   */
  setOpen = (newOpen, eventDetails) => {
    if (this.syncOnly) {
      this.context.onOpenChange?.(newOpen, eventDetails);
      return;
    }
    this.dispatchOpenChange(newOpen, eventDetails);
    this.context.onOpenChange?.(newOpen, eventDetails);
  };
};

// node_modules/@base-ui/react/floating-ui-react/hooks/useSyncedFloatingRootContext.mjs
function useSyncedFloatingRootContext(options) {
  const {
    popupStore,
    treatPopupAsFloatingElement = false,
    floatingRootContext: floatingRootContextProp,
    floatingId,
    nested,
    onOpenChange
  } = options;
  const open = popupStore.useState("open");
  const referenceElement = popupStore.useState("activeTriggerElement");
  const floatingElement = popupStore.useState(treatPopupAsFloatingElement ? "popupElement" : "positionerElement");
  const triggerElements = popupStore.context.triggerElements;
  const handleOpenChange = onOpenChange;
  const internalStoreRef = React28.useRef(null);
  if (floatingRootContextProp === void 0 && internalStoreRef.current === null) {
    internalStoreRef.current = new FloatingRootStore({
      open,
      transitionStatus: void 0,
      referenceElement,
      floatingElement,
      triggerElements,
      onOpenChange: handleOpenChange,
      floatingId,
      syncOnly: true,
      nested
    });
  }
  const store = floatingRootContextProp ?? internalStoreRef.current;
  popupStore.useSyncedValue("floatingId", floatingId);
  useIsoLayoutEffect(() => {
    const valuesToSync = {
      open,
      floatingId,
      referenceElement,
      floatingElement
    };
    if (isElement(referenceElement)) {
      valuesToSync.domReferenceElement = referenceElement;
    }
    if (store.state.positionReference === store.state.referenceElement) {
      valuesToSync.positionReference = referenceElement;
    }
    store.update(valuesToSync);
  }, [open, floatingId, referenceElement, floatingElement, store]);
  store.context.onOpenChange = handleOpenChange;
  store.context.nested = nested;
  return store;
}

// node_modules/@base-ui/react/utils/popups/popupStoreUtils.mjs
var FOCUSABLE_POPUP_PROPS = {
  tabIndex: -1,
  [FOCUSABLE_ATTRIBUTE]: ""
};
function createDefaultInitialFocus(popupRef) {
  return (interactionType) => interactionType === "touch" ? popupRef.current : true;
}
function usePopupStore(externalStore, createStore, treatPopupAsFloatingElement = false) {
  const floatingId = useId();
  const nested = useFloatingParentNodeId() != null;
  const internalStoreRef = React29.useRef(null);
  if (externalStore === void 0 && internalStoreRef.current === null) {
    internalStoreRef.current = createStore(floatingId, nested);
  }
  const store = externalStore ?? internalStoreRef.current;
  useSyncedFloatingRootContext({
    popupStore: store,
    treatPopupAsFloatingElement,
    floatingRootContext: store.state.floatingRootContext,
    floatingId,
    nested,
    onOpenChange: store.setOpen
  });
  return {
    store,
    internalStore: internalStoreRef.current
  };
}
function useTriggerRegistration(id, store) {
  const registeredElementIdRef = React29.useRef(null);
  const registeredElementRef = React29.useRef(null);
  return React29.useCallback((element) => {
    if (id === void 0) {
      return;
    }
    let shouldSyncTriggerCount = false;
    if (registeredElementIdRef.current !== null) {
      const registeredId = registeredElementIdRef.current;
      const registeredElement = registeredElementRef.current;
      const currentElement = store.context.triggerElements.getById(registeredId);
      if (registeredElement && currentElement === registeredElement) {
        store.context.triggerElements.delete(registeredId);
        shouldSyncTriggerCount = true;
      }
      registeredElementIdRef.current = null;
      registeredElementRef.current = null;
    }
    if (element !== null) {
      registeredElementIdRef.current = id;
      registeredElementRef.current = element;
      store.context.triggerElements.add(id, element);
      shouldSyncTriggerCount = true;
    }
    if (shouldSyncTriggerCount) {
      const triggerCount = store.context.triggerElements.size;
      if (store.select("open") && store.state.triggerCount !== triggerCount) {
        store.set("triggerCount", triggerCount);
      }
    }
  }, [store, id]);
}
function setPopupOpenState(state, open, trigger, preventUnmountOnClose = false) {
  if (open) {
    state.preventUnmountingOnClose = false;
  } else if (preventUnmountOnClose) {
    state.preventUnmountingOnClose = true;
  }
  const triggerId = trigger?.id ?? null;
  if (triggerId || open) {
    state.activeTriggerId = triggerId;
    state.activeTriggerElement = trigger ?? null;
  }
}
function attachPreventUnmountOnClose(eventDetails) {
  let preventUnmountOnClose = false;
  eventDetails.preventUnmountOnClose = () => {
    preventUnmountOnClose = true;
  };
  return () => preventUnmountOnClose;
}
function applyPopupOpenChange(store, nextOpen, eventDetails, options = {}) {
  const reason = eventDetails.reason;
  const isHover = reason === reason_parts_exports.triggerHover;
  const isFocusOpen = nextOpen && reason === reason_parts_exports.triggerFocus;
  const isDismissClose = !nextOpen && (reason === reason_parts_exports.triggerPress || reason === reason_parts_exports.escapeKey);
  const shouldPreventUnmountOnClose = attachPreventUnmountOnClose(eventDetails);
  store.context.onOpenChange?.(nextOpen, eventDetails);
  if (eventDetails.isCanceled) {
    return;
  }
  options.onBeforeDispatch?.();
  store.state.floatingRootContext.dispatchOpenChange(nextOpen, eventDetails);
  const changeState = () => {
    const updatedState = {
      ...options.extraState,
      open: nextOpen
    };
    if (isFocusOpen) {
      updatedState.instantType = "focus";
    } else if (isDismissClose) {
      updatedState.instantType = "dismiss";
    } else if (isHover) {
      updatedState.instantType = void 0;
    }
    setPopupOpenState(updatedState, nextOpen, eventDetails.trigger, shouldPreventUnmountOnClose());
    store.update(updatedState);
  };
  if (isHover) {
    ReactDOM4.flushSync(changeState);
  } else {
    changeState();
  }
}
function useInitialOpenSync(store, openProp, defaultOpen, defaultTriggerId) {
  useOnFirstRender(() => {
    if (openProp === void 0 && store.state.open === false && defaultOpen) {
      store.state = {
        ...store.state,
        open: true,
        activeTriggerId: defaultTriggerId,
        preventUnmountingOnClose: false
      };
    }
  });
}
function useTriggerDataForwarding(triggerId, triggerElementRef, store, stateUpdates) {
  const isMountedByThisTrigger = store.useState("isMountedByTrigger", triggerId);
  const baseRegisterTrigger = useTriggerRegistration(triggerId, store);
  const registerTrigger = useStableCallback((element) => {
    baseRegisterTrigger(element);
    if (!element) {
      return;
    }
    const open = store.select("open");
    const activeTriggerId = store.select("activeTriggerId");
    if (activeTriggerId === triggerId) {
      store.update({
        activeTriggerElement: element,
        ...open ? stateUpdates : null
      });
      return;
    }
    if (activeTriggerId == null && open) {
      store.update({
        activeTriggerId: triggerId,
        activeTriggerElement: element,
        ...stateUpdates
      });
    }
  });
  useIsoLayoutEffect(() => {
    if (isMountedByThisTrigger) {
      store.update({
        activeTriggerElement: triggerElementRef.current,
        ...stateUpdates
      });
    }
  }, [isMountedByThisTrigger, store, triggerElementRef, ...Object.values(stateUpdates)]);
  return {
    registerTrigger,
    isMountedByThisTrigger
  };
}
function useImplicitActiveTrigger(store, options = {}) {
  const {
    closeOnActiveTriggerUnmount = false
  } = options;
  const open = store.useState("open");
  const reactiveTriggerCount = store.useState("triggerCount");
  useIsoLayoutEffect(() => {
    if (!open) {
      if (store.state.triggerCount !== 0) {
        store.set("triggerCount", 0);
      }
      return;
    }
    const triggerCount = store.context.triggerElements.size;
    const stateUpdates = {};
    if (store.state.triggerCount !== triggerCount) {
      stateUpdates.triggerCount = triggerCount;
    }
    const activeTriggerId = store.select("activeTriggerId");
    let lostActiveTriggerId = null;
    if (activeTriggerId) {
      const activeTriggerElement = store.context.triggerElements.getById(activeTriggerId);
      if (!activeTriggerElement) {
        lostActiveTriggerId = activeTriggerId;
      } else if (activeTriggerElement !== store.state.activeTriggerElement) {
        stateUpdates.activeTriggerElement = activeTriggerElement;
      }
    }
    if (!lostActiveTriggerId && !activeTriggerId && triggerCount === 1) {
      const iteratorResult = store.context.triggerElements.entries().next();
      if (!iteratorResult.done) {
        const [implicitTriggerId, implicitTriggerElement] = iteratorResult.value;
        stateUpdates.activeTriggerId = implicitTriggerId;
        stateUpdates.activeTriggerElement = implicitTriggerElement;
      }
    }
    if (stateUpdates.triggerCount !== void 0 || stateUpdates.activeTriggerId !== void 0 || stateUpdates.activeTriggerElement !== void 0) {
      store.update(stateUpdates);
    }
    if (lostActiveTriggerId) {
      if (closeOnActiveTriggerUnmount) {
        queueMicrotask(() => {
          if (store.select("open") && store.select("activeTriggerId") === lostActiveTriggerId && !store.context.triggerElements.getById(lostActiveTriggerId)) {
            const eventDetails = createChangeEventDetails(reason_parts_exports.none);
            store.setOpen(false, eventDetails);
            if (!eventDetails.isCanceled) {
              store.update({
                activeTriggerId: null,
                activeTriggerElement: null
              });
            }
          }
        });
      }
    }
  }, [open, store, reactiveTriggerCount, closeOnActiveTriggerUnmount]);
}
function useOpenStateTransitions(open, store, onUnmount) {
  const {
    mounted,
    setMounted,
    transitionStatus
  } = useTransitionStatus(open);
  const preventUnmountingOnClose = store.useState("preventUnmountingOnClose");
  const syncedPreventUnmountingOnClose = open ? false : preventUnmountingOnClose;
  store.useSyncedValues({
    mounted,
    transitionStatus,
    preventUnmountingOnClose: syncedPreventUnmountingOnClose
  });
  const forceUnmount = useStableCallback(() => {
    setMounted(false);
    store.update({
      activeTriggerId: null,
      activeTriggerElement: null,
      mounted: false,
      preventUnmountingOnClose: false
    });
    onUnmount?.();
    store.context.onOpenChangeComplete?.(false);
  });
  useOpenChangeComplete({
    enabled: mounted && !open && !syncedPreventUnmountingOnClose,
    open,
    ref: store.context.popupRef,
    onComplete() {
      if (!open) {
        forceUnmount();
      }
    }
  });
  return {
    forceUnmount,
    transitionStatus
  };
}
function usePopupInteractionProps(store, statePart) {
  store.useSyncedValues(statePart);
  useIsoLayoutEffect(() => () => {
    store.update({
      activeTriggerProps: EMPTY_OBJECT,
      inactiveTriggerProps: EMPTY_OBJECT,
      popupProps: EMPTY_OBJECT
    });
  }, [store]);
}
function usePopupRootSync(store, open) {
  useIsoLayoutEffect(() => {
    if (!open && store.state.openMethod !== null) {
      store.set("openMethod", null);
    }
  }, [open, store]);
  useIsoLayoutEffect(() => () => {
    if (store.state.openMethod !== null) {
      store.set("openMethod", null);
    }
  }, [store]);
}

// node_modules/@base-ui/react/utils/popups/popupTriggerMap.mjs
var PopupTriggerMap = class {
  constructor() {
    this.elementsSet = /* @__PURE__ */ new Set();
    this.idMap = /* @__PURE__ */ new Map();
  }
  /**
   * Adds a trigger element with the given ID.
   *
   * Note: The provided element is assumed to not be registered under multiple IDs.
   */
  add(id, element) {
    const existingElement = this.idMap.get(id);
    if (existingElement === element) {
      return;
    }
    if (existingElement !== void 0) {
      this.elementsSet.delete(existingElement);
    }
    this.elementsSet.add(element);
    this.idMap.set(id, element);
    if (true) {
      if (this.elementsSet.size !== this.idMap.size) {
        throw new Error("Base UI: A trigger element cannot be registered under multiple IDs in PopupTriggerMap.");
      }
    }
  }
  /**
   * Removes the trigger element with the given ID.
   */
  delete(id) {
    const element = this.idMap.get(id);
    if (element) {
      this.elementsSet.delete(element);
      this.idMap.delete(id);
    }
  }
  /**
   * Whether the given element is registered as a trigger.
   */
  hasElement(element) {
    return this.elementsSet.has(element);
  }
  /**
   * Whether there is a registered trigger element matching the given predicate.
   */
  hasMatchingElement(predicate) {
    for (const element of this.elementsSet) {
      if (predicate(element)) {
        return true;
      }
    }
    return false;
  }
  /**
   * Returns the trigger element associated with the given ID, or undefined if no such element exists.
   */
  getById(id) {
    return this.idMap.get(id);
  }
  /**
   * Returns an iterable of all registered trigger entries, where each entry is a tuple of [id, element].
   */
  entries() {
    return this.idMap.entries();
  }
  /**
   * Returns an iterable of all registered trigger elements.
   */
  elements() {
    return this.elementsSet.values();
  }
  /**
   * Returns the number of registered trigger elements.
   */
  get size() {
    return this.idMap.size;
  }
};

// node_modules/@base-ui/react/floating-ui-react/utils/getEmptyRootContext.mjs
function getEmptyRootContext() {
  return new FloatingRootStore({
    open: false,
    transitionStatus: void 0,
    floatingElement: null,
    referenceElement: null,
    triggerElements: new PopupTriggerMap(),
    floatingId: void 0,
    syncOnly: false,
    nested: false,
    onOpenChange: void 0
  });
}

// node_modules/@base-ui/react/utils/popups/store.mjs
function createInitialPopupStoreState() {
  return {
    open: false,
    openProp: void 0,
    mounted: false,
    transitionStatus: void 0,
    floatingRootContext: getEmptyRootContext(),
    floatingId: void 0,
    triggerCount: 0,
    preventUnmountingOnClose: false,
    payload: void 0,
    activeTriggerId: null,
    activeTriggerElement: null,
    triggerIdProp: void 0,
    popupElement: null,
    positionerElement: null,
    activeTriggerProps: EMPTY_OBJECT,
    inactiveTriggerProps: EMPTY_OBJECT,
    popupProps: EMPTY_OBJECT
  };
}
function createPopupFloatingRootContext(triggerElements, floatingId, nested = false) {
  return new FloatingRootStore({
    open: false,
    transitionStatus: void 0,
    floatingElement: null,
    referenceElement: null,
    triggerElements,
    floatingId,
    syncOnly: true,
    nested,
    onOpenChange: void 0
  });
}
var activeTriggerIdSelector = createSelector((state) => state.triggerIdProp ?? state.activeTriggerId);
var openSelector = createSelector((state) => state.openProp ?? state.open);
var popupIdSelector = createSelector((state) => {
  const popupId = state.popupElement?.id ?? state.floatingId;
  return popupId || void 0;
});
function triggerOwnsOpenPopup(state, triggerId) {
  return triggerId !== void 0 && openSelector(state) && activeTriggerIdSelector(state) === triggerId;
}
function triggerOwnsOpenPopupOrIsOnlyTrigger(state, triggerId) {
  if (triggerOwnsOpenPopup(state, triggerId)) {
    return true;
  }
  return triggerId !== void 0 && openSelector(state) && activeTriggerIdSelector(state) == null && state.triggerCount === 1;
}
var popupStoreSelectors = {
  open: openSelector,
  mounted: createSelector((state) => state.mounted),
  transitionStatus: createSelector((state) => state.transitionStatus),
  floatingRootContext: createSelector((state) => state.floatingRootContext),
  triggerCount: createSelector((state) => state.triggerCount),
  preventUnmountingOnClose: createSelector((state) => state.preventUnmountingOnClose),
  payload: createSelector((state) => state.payload),
  activeTriggerId: activeTriggerIdSelector,
  activeTriggerElement: createSelector((state) => state.mounted ? state.activeTriggerElement : null),
  popupId: popupIdSelector,
  /**
   * Whether the trigger with the given ID was used to open the popup.
   */
  isTriggerActive: createSelector((state, triggerId) => triggerId !== void 0 && activeTriggerIdSelector(state) === triggerId),
  /**
   * Whether the popup is open and was activated by a trigger with the given ID.
   */
  isOpenedByTrigger: createSelector((state, triggerId) => triggerOwnsOpenPopup(state, triggerId)),
  /**
   * Whether the popup is mounted and was activated by a trigger with the given ID.
   */
  isMountedByTrigger: createSelector((state, triggerId) => triggerId !== void 0 && activeTriggerIdSelector(state) === triggerId && state.mounted),
  triggerProps: createSelector((state, isActive) => isActive ? state.activeTriggerProps : state.inactiveTriggerProps),
  /**
   * Popup id for the trigger that currently owns the open popup.
   */
  triggerPopupId: createSelector((state, triggerId) => triggerOwnsOpenPopupOrIsOnlyTrigger(state, triggerId) ? popupIdSelector(state) : void 0),
  popupProps: createSelector((state) => state.popupProps),
  popupElement: createSelector((state) => state.popupElement),
  positionerElement: createSelector((state) => state.positionerElement)
};

// node_modules/@base-ui/react/floating-ui-react/hooks/useFloatingRootContext.mjs
function useFloatingRootContext(options) {
  const {
    open = false,
    onOpenChange,
    elements = {}
  } = options;
  const floatingId = useId();
  const nested = useFloatingParentNodeId() != null;
  if (true) {
    const optionDomReference = elements.reference;
    if (optionDomReference && !isElement(optionDomReference)) {
      console.error("Cannot pass a virtual element to the `elements.reference` option,", "as it must be a real DOM element. Use `context.setPositionReference()`", "instead.");
    }
  }
  const store = useRefWithInit(() => new FloatingRootStore({
    open,
    transitionStatus: void 0,
    onOpenChange,
    referenceElement: elements.reference ?? null,
    floatingElement: elements.floating ?? null,
    triggerElements: new PopupTriggerMap(),
    floatingId,
    syncOnly: false,
    nested
  })).current;
  useIsoLayoutEffect(() => {
    const valuesToSync = {
      open,
      floatingId
    };
    if (elements.reference !== void 0) {
      valuesToSync.referenceElement = elements.reference;
      valuesToSync.domReferenceElement = isElement(elements.reference) ? elements.reference : null;
    }
    if (elements.floating !== void 0) {
      valuesToSync.floatingElement = elements.floating;
    }
    store.update(valuesToSync);
  }, [open, floatingId, elements.reference, elements.floating, store]);
  store.context.onOpenChange = onOpenChange;
  store.context.nested = nested;
  return store;
}

// node_modules/@base-ui/react/floating-ui-react/hooks/useFloating.mjs
function useFloating2(options = {}) {
  const {
    nodeId,
    externalTree
  } = options;
  const internalStore = useFloatingRootContext(options);
  const store = options.rootContext || internalStore;
  const referenceElement = store.useState("referenceElement");
  const floatingElement = store.useState("floatingElement");
  const domReferenceElement = store.useState("domReferenceElement");
  const open = store.useState("open");
  const floatingId = store.useState("floatingId");
  const [positionReference, setPositionReferenceRaw] = React30.useState(null);
  const [localDomReference, setLocalDomReference] = React30.useState(void 0);
  const [localFloatingElement, setLocalFloatingElement] = React30.useState(void 0);
  const domReferenceRef = React30.useRef(null);
  const tree = useFloatingTree(externalTree);
  const storeElements = React30.useMemo(() => ({
    reference: referenceElement,
    floating: floatingElement,
    domReference: domReferenceElement
  }), [referenceElement, floatingElement, domReferenceElement]);
  const position = useFloating({
    ...options,
    elements: {
      ...storeElements,
      ...positionReference && {
        reference: positionReference
      }
    }
  });
  const localDomReferenceElement = isElement(localDomReference) ? localDomReference : null;
  const syncedFloatingElement = localFloatingElement === void 0 ? store.state.floatingElement : localFloatingElement;
  store.useSyncedValue("referenceElement", localDomReference ?? null);
  store.useSyncedValue("domReferenceElement", localDomReference === void 0 ? domReferenceElement : localDomReferenceElement);
  store.useSyncedValue("floatingElement", syncedFloatingElement);
  const setPositionReference = React30.useCallback((node) => {
    const computedPositionReference = isElement(node) ? {
      getBoundingClientRect: () => node.getBoundingClientRect(),
      getClientRects: () => node.getClientRects(),
      contextElement: node
    } : node;
    setPositionReferenceRaw(computedPositionReference);
    position.refs.setReference(computedPositionReference);
  }, [position.refs]);
  const setReference = React30.useCallback((node) => {
    if (isElement(node) || node === null) {
      domReferenceRef.current = node;
      setLocalDomReference(node);
    }
    if (isElement(position.refs.reference.current) || position.refs.reference.current === null || // Don't allow setting virtual elements using the old technique back to
    // `null` to support `positionReference` + an unstable `reference`
    // callback ref.
    node !== null && !isElement(node)) {
      position.refs.setReference(node);
    }
  }, [position.refs, setLocalDomReference]);
  const setFloating = React30.useCallback((node) => {
    setLocalFloatingElement(node);
    position.refs.setFloating(node);
  }, [position.refs]);
  const refs = React30.useMemo(() => ({
    ...position.refs,
    setReference,
    setFloating,
    setPositionReference,
    domReference: domReferenceRef
  }), [position.refs, setReference, setFloating, setPositionReference]);
  const elements = React30.useMemo(() => ({
    ...position.elements,
    domReference: domReferenceElement
  }), [position.elements, domReferenceElement]);
  const context = React30.useMemo(() => ({
    ...position,
    dataRef: store.context.dataRef,
    open,
    onOpenChange: store.setOpen,
    events: store.context.events,
    floatingId,
    refs,
    elements,
    nodeId,
    rootStore: store
  }), [position, refs, elements, nodeId, store, open, floatingId]);
  useIsoLayoutEffect(() => {
    if (domReferenceElement) {
      domReferenceRef.current = domReferenceElement;
    }
  }, [domReferenceElement]);
  useIsoLayoutEffect(() => {
    store.context.dataRef.current.floatingContext = context;
    const node = tree?.nodesRef.current.find((n) => n.id === nodeId);
    if (node) {
      node.context = context;
    }
  });
  return React30.useMemo(() => ({
    ...position,
    context,
    refs,
    elements,
    rootStore: store
  }), [position, refs, elements, context, store]);
}

// node_modules/@base-ui/react/floating-ui-react/hooks/useFocus.mjs
var React31 = __toESM(require_react(), 1);
var isMacSafari = parts_exports.os.mac && parts_exports.engine.webkit;
function useFocus(context, props = {}) {
  const {
    enabled = true,
    delay
  } = props;
  const store = "rootStore" in context ? context.rootStore : context;
  const {
    events,
    dataRef
  } = store.context;
  const blockFocusRef = React31.useRef(false);
  const blockedReferenceRef = React31.useRef(null);
  const keyboardModalityRef = React31.useRef(true);
  const timeout = useTimeout();
  React31.useEffect(() => {
    const domReference = store.select("domReferenceElement");
    if (!enabled) {
      return void 0;
    }
    const win = getWindow(domReference);
    function onBlur() {
      const currentDomReference = store.select("domReferenceElement");
      if (!store.select("open") && isHTMLElement(currentDomReference) && currentDomReference === activeElement(ownerDocument(currentDomReference))) {
        blockFocusRef.current = true;
      }
    }
    function onKeyDown() {
      keyboardModalityRef.current = true;
    }
    function onPointerDown() {
      keyboardModalityRef.current = false;
    }
    return mergeCleanups(addEventListener(win, "blur", onBlur), isMacSafari && addEventListener(win, "keydown", onKeyDown, true), isMacSafari && addEventListener(win, "pointerdown", onPointerDown, true));
  }, [store, enabled]);
  React31.useEffect(() => {
    if (!enabled) {
      return void 0;
    }
    function onOpenChangeLocal(details) {
      if (details.reason === reason_parts_exports.triggerPress || details.reason === reason_parts_exports.escapeKey) {
        const referenceElement = store.select("domReferenceElement");
        if (isElement(referenceElement)) {
          blockedReferenceRef.current = referenceElement;
          blockFocusRef.current = true;
        }
      }
    }
    events.on("openchange", onOpenChangeLocal);
    return () => {
      events.off("openchange", onOpenChangeLocal);
    };
  }, [events, enabled, store]);
  const reference = React31.useMemo(() => {
    function resetBlockedFocus() {
      blockFocusRef.current = false;
      blockedReferenceRef.current = null;
    }
    return {
      onMouseLeave() {
        resetBlockedFocus();
      },
      onFocus(event) {
        const focusTarget = event.currentTarget;
        if (blockFocusRef.current) {
          if (blockedReferenceRef.current === focusTarget) {
            return;
          }
          resetBlockedFocus();
        }
        const target = getTarget(event.nativeEvent);
        if (isElement(target)) {
          if (isMacSafari && !event.relatedTarget) {
            if (!keyboardModalityRef.current && !isTypeableElement(target)) {
              return;
            }
          } else if (!matchesFocusVisible(target)) {
            return;
          }
        }
        const movedFromOtherEnabledTrigger = isTargetInsideEnabledTrigger(event.relatedTarget, store.context.triggerElements);
        const {
          nativeEvent,
          currentTarget
        } = event;
        const delayValue = typeof delay === "function" ? delay() : delay;
        if (store.select("open") && movedFromOtherEnabledTrigger || delayValue === 0 || delayValue === void 0) {
          store.setOpen(true, createChangeEventDetails(reason_parts_exports.triggerFocus, nativeEvent, currentTarget));
          return;
        }
        timeout.start(delayValue, () => {
          if (blockFocusRef.current) {
            return;
          }
          store.setOpen(true, createChangeEventDetails(reason_parts_exports.triggerFocus, nativeEvent, currentTarget));
        });
      },
      onBlur(event) {
        resetBlockedFocus();
        const relatedTarget = event.relatedTarget;
        const nativeEvent = event.nativeEvent;
        const movedToFocusGuard = isElement(relatedTarget) && relatedTarget.hasAttribute(createAttribute("focus-guard")) && relatedTarget.getAttribute("data-type") === "outside";
        timeout.start(0, () => {
          const domReference = store.select("domReferenceElement");
          const activeEl = activeElement(ownerDocument(domReference));
          if (!relatedTarget && activeEl === domReference) {
            return;
          }
          if (contains(dataRef.current.floatingContext?.refs.floating.current, activeEl) || contains(domReference, activeEl) || movedToFocusGuard) {
            return;
          }
          const nextFocusedElement = relatedTarget ?? activeEl;
          if (isTargetInsideEnabledTrigger(nextFocusedElement, store.context.triggerElements)) {
            return;
          }
          store.setOpen(false, createChangeEventDetails(reason_parts_exports.triggerFocus, nativeEvent));
        });
      }
    };
  }, [dataRef, delay, store, timeout]);
  return React31.useMemo(() => enabled ? {
    reference,
    trigger: reference
  } : {}, [enabled, reference]);
}

// node_modules/@base-ui/react/floating-ui-react/hooks/useHoverFloatingInteraction.mjs
var React32 = __toESM(require_react(), 1);

// node_modules/@base-ui/react/floating-ui-react/hooks/useHoverInteractionSharedState.mjs
var HoverInteraction = class _HoverInteraction {
  constructor() {
    this.pointerType = void 0;
    this.interactedInside = false;
    this.handler = void 0;
    this.blockMouseMove = true;
    this.performedPointerEventsMutation = false;
    this.pointerEventsScopeElement = null;
    this.pointerEventsReferenceElement = null;
    this.pointerEventsFloatingElement = null;
    this.restTimeoutPending = false;
    this.openChangeTimeout = new Timeout();
    this.restTimeout = new Timeout();
    this.handleCloseOptions = void 0;
  }
  static create() {
    return new _HoverInteraction();
  }
  dispose = () => {
    this.openChangeTimeout.clear();
    this.restTimeout.clear();
  };
  disposeEffect = () => {
    return this.dispose;
  };
};
var pointerEventsMutationOwnerByScopeElement = /* @__PURE__ */ new WeakMap();
function clearSafePolygonPointerEventsMutation(instance) {
  if (!instance.performedPointerEventsMutation) {
    return;
  }
  const scopeElement = instance.pointerEventsScopeElement;
  if (scopeElement && pointerEventsMutationOwnerByScopeElement.get(scopeElement) === instance) {
    instance.pointerEventsScopeElement?.style.removeProperty("pointer-events");
    instance.pointerEventsReferenceElement?.style.removeProperty("pointer-events");
    instance.pointerEventsFloatingElement?.style.removeProperty("pointer-events");
    pointerEventsMutationOwnerByScopeElement.delete(scopeElement);
  }
  instance.performedPointerEventsMutation = false;
  instance.pointerEventsScopeElement = null;
  instance.pointerEventsReferenceElement = null;
  instance.pointerEventsFloatingElement = null;
}
function applySafePolygonPointerEventsMutation(instance, options) {
  const {
    scopeElement,
    referenceElement,
    floatingElement
  } = options;
  const existingOwner = pointerEventsMutationOwnerByScopeElement.get(scopeElement);
  if (existingOwner && existingOwner !== instance) {
    clearSafePolygonPointerEventsMutation(existingOwner);
  }
  clearSafePolygonPointerEventsMutation(instance);
  instance.performedPointerEventsMutation = true;
  instance.pointerEventsScopeElement = scopeElement;
  instance.pointerEventsReferenceElement = referenceElement;
  instance.pointerEventsFloatingElement = floatingElement;
  pointerEventsMutationOwnerByScopeElement.set(scopeElement, instance);
  scopeElement.style.pointerEvents = "none";
  referenceElement.style.pointerEvents = "auto";
  floatingElement.style.pointerEvents = "auto";
}
function useHoverInteractionSharedState(store) {
  const data = store.context.dataRef.current;
  const instance = useRefWithInit(() => data.hoverInteractionState ?? HoverInteraction.create()).current;
  if (!data.hoverInteractionState) {
    data.hoverInteractionState = instance;
  }
  useOnMount(data.hoverInteractionState.disposeEffect);
  return data.hoverInteractionState;
}

// node_modules/@base-ui/react/floating-ui-react/hooks/useHoverFloatingInteraction.mjs
function useHoverFloatingInteraction(context, parameters = {}) {
  const {
    enabled = true,
    closeDelay: closeDelayProp = 0,
    nodeId: nodeIdProp
  } = parameters;
  const store = "rootStore" in context ? context.rootStore : context;
  const open = store.useState("open");
  const floatingElement = store.useState("floatingElement");
  const domReferenceElement = store.useState("domReferenceElement");
  const {
    dataRef
  } = store.context;
  const tree = useFloatingTree();
  const parentId = useFloatingParentNodeId();
  const instance = useHoverInteractionSharedState(store);
  const childClosedTimeout = useTimeout();
  const isClickLikeOpenEvent2 = useStableCallback(() => {
    return isClickLikeOpenEvent(dataRef.current.openEvent?.type, instance.interactedInside);
  });
  const isHoverOpen = useStableCallback(() => {
    return isHoverOpenEvent(dataRef.current.openEvent?.type);
  });
  const clearPointerEvents = useStableCallback(() => {
    clearSafePolygonPointerEventsMutation(instance);
  });
  useIsoLayoutEffect(() => {
    if (!open) {
      instance.pointerType = void 0;
      instance.restTimeoutPending = false;
      instance.interactedInside = false;
      clearPointerEvents();
    }
  }, [open, instance, clearPointerEvents]);
  React32.useEffect(() => {
    return clearPointerEvents;
  }, [clearPointerEvents]);
  useIsoLayoutEffect(() => {
    if (!enabled) {
      return void 0;
    }
    if (open && instance.handleCloseOptions?.blockPointerEvents && isHoverOpen() && isElement(domReferenceElement) && floatingElement) {
      const ref = domReferenceElement;
      const floatingEl = floatingElement;
      const doc = ownerDocument(floatingElement);
      const parentFloating = tree?.nodesRef.current.find((node) => node.id === parentId)?.context?.elements.floating;
      if (parentFloating) {
        parentFloating.style.pointerEvents = "";
      }
      const cachedScopeElement = instance.pointerEventsScopeElement !== floatingEl ? instance.pointerEventsScopeElement : null;
      const parentScopeElement = parentFloating !== floatingEl ? parentFloating : null;
      const scopeElement = instance.handleCloseOptions?.getScope?.() ?? cachedScopeElement ?? parentScopeElement ?? ref.closest("[data-rootownerid]") ?? doc.body;
      applySafePolygonPointerEventsMutation(instance, {
        scopeElement,
        referenceElement: ref,
        floatingElement: floatingEl
      });
      return () => {
        clearPointerEvents();
      };
    }
    return void 0;
  }, [enabled, open, domReferenceElement, floatingElement, instance, isHoverOpen, tree, parentId, clearPointerEvents]);
  React32.useEffect(() => {
    if (!enabled) {
      return void 0;
    }
    function hasParentChildren() {
      return !!(tree && parentId && getNodeChildren(tree.nodesRef.current, parentId).length > 0);
    }
    function closeWithDelay(event) {
      const closeDelay = getDelay(closeDelayProp, "close", instance.pointerType);
      const close = () => {
        store.setOpen(false, createChangeEventDetails(reason_parts_exports.triggerHover, event));
        tree?.events.emit("floating.closed", event);
      };
      if (closeDelay) {
        instance.openChangeTimeout.start(closeDelay, close);
      } else {
        instance.openChangeTimeout.clear();
        close();
      }
    }
    function handleInteractInside(event) {
      const target = getTarget(event);
      if (!isInteractiveElement(target)) {
        instance.interactedInside = false;
        return;
      }
      instance.interactedInside = target?.closest("[aria-haspopup]") != null;
    }
    function onFloatingMouseEnter() {
      instance.openChangeTimeout.clear();
      childClosedTimeout.clear();
      tree?.events.off("floating.closed", onNodeClosed);
      clearPointerEvents();
    }
    function onFloatingMouseLeave(event) {
      if (hasParentChildren() && tree) {
        tree.events.on("floating.closed", onNodeClosed);
        return;
      }
      if (isTargetInsideEnabledTrigger(event.relatedTarget, store.context.triggerElements)) {
        return;
      }
      const currentNodeId = dataRef.current.floatingContext?.nodeId ?? nodeIdProp;
      const relatedTarget = event.relatedTarget;
      const isMovingIntoDescendantFloating = tree && currentNodeId && isElement(relatedTarget) && getNodeChildren(tree.nodesRef.current, currentNodeId, false).some((node) => contains(node.context?.elements.floating, relatedTarget));
      if (isMovingIntoDescendantFloating) {
        return;
      }
      if (instance.handler) {
        instance.handler(event);
        return;
      }
      clearPointerEvents();
      if (isHoverOpen() && !isClickLikeOpenEvent2()) {
        closeWithDelay(event);
      }
    }
    function onNodeClosed(event) {
      if (!tree || !parentId || hasParentChildren()) {
        return;
      }
      childClosedTimeout.start(0, () => {
        tree.events.off("floating.closed", onNodeClosed);
        store.setOpen(false, createChangeEventDetails(reason_parts_exports.triggerHover, event));
        tree.events.emit("floating.closed", event);
      });
    }
    const floating = floatingElement;
    return mergeCleanups(floating && addEventListener(floating, "mouseenter", onFloatingMouseEnter), floating && addEventListener(floating, "mouseleave", onFloatingMouseLeave), floating && addEventListener(floating, "pointerdown", handleInteractInside, true), () => {
      tree?.events.off("floating.closed", onNodeClosed);
    });
  }, [enabled, floatingElement, store, dataRef, closeDelayProp, nodeIdProp, isHoverOpen, isClickLikeOpenEvent2, clearPointerEvents, instance, tree, parentId, childClosedTimeout]);
}

// node_modules/@base-ui/react/floating-ui-react/hooks/useHoverReferenceInteraction.mjs
var React33 = __toESM(require_react(), 1);
var ReactDOM5 = __toESM(require_react_dom(), 1);
var EMPTY_REF = {
  current: null
};
function useHoverReferenceInteraction(context, props = {}) {
  const {
    enabled = true,
    delay = 0,
    handleClose = null,
    mouseOnly = false,
    restMs = 0,
    move = true,
    triggerElementRef = EMPTY_REF,
    externalTree,
    isActiveTrigger = true,
    getHandleCloseContext,
    isClosing,
    shouldOpen: shouldOpenProp
  } = props;
  const store = "rootStore" in context ? context.rootStore : context;
  const {
    dataRef,
    events
  } = store.context;
  const tree = useFloatingTree(externalTree);
  const instance = useHoverInteractionSharedState(store);
  const isHoverCloseActiveRef = React33.useRef(false);
  const handleCloseRef = useValueAsRef(handleClose);
  const delayRef = useValueAsRef(delay);
  const restMsRef = useValueAsRef(restMs);
  const enabledRef = useValueAsRef(enabled);
  const shouldOpenRef = useValueAsRef(shouldOpenProp);
  const isClosingRef = useValueAsRef(isClosing);
  const isClickLikeOpenEvent2 = useStableCallback(() => {
    return isClickLikeOpenEvent(dataRef.current.openEvent?.type, instance.interactedInside);
  });
  const checkShouldOpen = useStableCallback(() => {
    return shouldOpenRef.current?.() !== false;
  });
  const isOverInactiveTrigger = useStableCallback((currentDomReference, currentTarget, target) => {
    const allTriggers = store.context.triggerElements;
    if (allTriggers.hasElement(currentTarget)) {
      return !currentDomReference || !contains(currentDomReference, currentTarget);
    }
    if (!isElement(target)) {
      return false;
    }
    const targetElement = target;
    return allTriggers.hasMatchingElement((trigger) => contains(trigger, targetElement)) && (!currentDomReference || !contains(currentDomReference, targetElement));
  });
  const cleanupMouseMoveHandler = useStableCallback(() => {
    if (!instance.handler) {
      return;
    }
    const doc = ownerDocument(store.select("domReferenceElement"));
    doc.removeEventListener("mousemove", instance.handler);
    instance.handler = void 0;
  });
  const clearPointerEvents = useStableCallback(() => {
    clearSafePolygonPointerEventsMutation(instance);
  });
  if (isActiveTrigger) {
    instance.handleCloseOptions = handleCloseRef.current?.__options;
  }
  React33.useEffect(() => cleanupMouseMoveHandler, [cleanupMouseMoveHandler]);
  React33.useEffect(() => {
    if (!enabled) {
      return void 0;
    }
    function onOpenChangeLocal(details) {
      if (!details.open) {
        isHoverCloseActiveRef.current = details.reason === reason_parts_exports.triggerHover;
        cleanupMouseMoveHandler();
        instance.openChangeTimeout.clear();
        instance.restTimeout.clear();
        instance.blockMouseMove = true;
        instance.restTimeoutPending = false;
      } else {
        isHoverCloseActiveRef.current = false;
      }
    }
    events.on("openchange", onOpenChangeLocal);
    return () => {
      events.off("openchange", onOpenChangeLocal);
    };
  }, [enabled, events, instance, cleanupMouseMoveHandler]);
  React33.useEffect(() => {
    if (!enabled) {
      return void 0;
    }
    function closeWithDelay(event, runElseBranch = true) {
      const closeDelay = getDelay(delayRef.current, "close", instance.pointerType);
      if (closeDelay) {
        instance.openChangeTimeout.start(closeDelay, () => {
          store.setOpen(false, createChangeEventDetails(reason_parts_exports.triggerHover, event));
          tree?.events.emit("floating.closed", event);
        });
      } else if (runElseBranch) {
        instance.openChangeTimeout.clear();
        store.setOpen(false, createChangeEventDetails(reason_parts_exports.triggerHover, event));
        tree?.events.emit("floating.closed", event);
      }
    }
    const trigger = triggerElementRef.current ?? (isActiveTrigger ? store.select("domReferenceElement") : null);
    if (!isElement(trigger)) {
      return void 0;
    }
    function onMouseEnter(event) {
      instance.openChangeTimeout.clear();
      instance.blockMouseMove = false;
      if (mouseOnly && !isMouseLikePointerType(instance.pointerType)) {
        return;
      }
      const restMsValue = getRestMs(restMsRef.current);
      const openDelay = getDelay(delayRef.current, "open", instance.pointerType);
      const eventTarget = getTarget(event);
      const currentTarget = event.currentTarget ?? null;
      const currentDomReference = store.select("domReferenceElement");
      let triggerNode = currentTarget;
      if (isElement(eventTarget) && !store.context.triggerElements.hasElement(eventTarget)) {
        for (const triggerElement of store.context.triggerElements.elements()) {
          if (contains(triggerElement, eventTarget)) {
            triggerNode = triggerElement;
            break;
          }
        }
      }
      if (isElement(currentTarget) && isElement(currentDomReference) && !store.context.triggerElements.hasElement(currentTarget) && contains(currentTarget, currentDomReference)) {
        triggerNode = currentDomReference;
      }
      const isOverInactive = triggerNode == null ? false : isOverInactiveTrigger(currentDomReference, triggerNode, eventTarget);
      const isOpen = store.select("open");
      const isInClosingTransition = isClosingRef.current?.() ?? store.select("transitionStatus") === "ending";
      const isHoverCloseTransition = !isOpen && isInClosingTransition && isHoverCloseActiveRef.current;
      const isReenteringSameTriggerDuringCloseTransition = !isOverInactive && isElement(triggerNode) && isElement(currentDomReference) && contains(currentDomReference, triggerNode) && isHoverCloseTransition;
      const isRestOnlyDelay = restMsValue > 0 && !openDelay;
      const shouldOpenImmediately = isOverInactive && (isOpen || isHoverCloseTransition) || isReenteringSameTriggerDuringCloseTransition;
      const shouldOpen = !isOpen || isOverInactive;
      if (shouldOpenImmediately) {
        if (checkShouldOpen()) {
          store.setOpen(true, createChangeEventDetails(reason_parts_exports.triggerHover, event, triggerNode));
        }
        return;
      }
      if (isRestOnlyDelay) {
        return;
      }
      if (openDelay) {
        instance.openChangeTimeout.start(openDelay, () => {
          if (shouldOpen && checkShouldOpen()) {
            store.setOpen(true, createChangeEventDetails(reason_parts_exports.triggerHover, event, triggerNode));
          }
        });
      } else if (shouldOpen) {
        if (checkShouldOpen()) {
          store.setOpen(true, createChangeEventDetails(reason_parts_exports.triggerHover, event, triggerNode));
        }
      }
    }
    function onMouseLeave(event) {
      if (isClickLikeOpenEvent2()) {
        clearPointerEvents();
        return;
      }
      cleanupMouseMoveHandler();
      const domReferenceElement = store.select("domReferenceElement");
      const doc = ownerDocument(domReferenceElement);
      instance.restTimeout.clear();
      instance.restTimeoutPending = false;
      const handleCloseContextBase = dataRef.current.floatingContext ?? getHandleCloseContext?.();
      if (isTargetInsideEnabledTrigger(event.relatedTarget, store.context.triggerElements)) {
        return;
      }
      if (handleCloseRef.current && handleCloseContextBase) {
        if (!store.select("open")) {
          instance.openChangeTimeout.clear();
        }
        const currentTrigger = triggerElementRef.current;
        instance.handler = handleCloseRef.current({
          ...handleCloseContextBase,
          tree,
          x: event.clientX,
          y: event.clientY,
          onClose() {
            clearPointerEvents();
            cleanupMouseMoveHandler();
            if (enabledRef.current && !isClickLikeOpenEvent2() && currentTrigger === store.select("domReferenceElement")) {
              closeWithDelay(event, true);
            }
          }
        });
        doc.addEventListener("mousemove", instance.handler);
        instance.handler(event);
        return;
      }
      const shouldClose = instance.pointerType === "touch" ? !contains(store.select("floatingElement"), event.relatedTarget) : true;
      if (shouldClose) {
        closeWithDelay(event);
      }
    }
    if (move) {
      return mergeCleanups(addEventListener(trigger, "mousemove", onMouseEnter, {
        once: true
      }), addEventListener(trigger, "mouseenter", onMouseEnter), addEventListener(trigger, "mouseleave", onMouseLeave));
    }
    return mergeCleanups(addEventListener(trigger, "mouseenter", onMouseEnter), addEventListener(trigger, "mouseleave", onMouseLeave));
  }, [cleanupMouseMoveHandler, clearPointerEvents, dataRef, delayRef, store, enabled, handleCloseRef, instance, isActiveTrigger, isOverInactiveTrigger, isClickLikeOpenEvent2, mouseOnly, move, restMsRef, triggerElementRef, tree, enabledRef, getHandleCloseContext, isClosingRef, checkShouldOpen]);
  return React33.useMemo(() => {
    if (!enabled) {
      return void 0;
    }
    function setPointerRef(event) {
      instance.pointerType = event.pointerType;
    }
    return {
      onPointerDown: setPointerRef,
      onPointerEnter: setPointerRef,
      onMouseMove(event) {
        const {
          nativeEvent
        } = event;
        const trigger = event.currentTarget;
        const currentDomReference = store.select("domReferenceElement");
        const currentOpen = store.select("open");
        const isOverInactive = isOverInactiveTrigger(currentDomReference, trigger, event.target);
        if (mouseOnly && !isMouseLikePointerType(instance.pointerType)) {
          return;
        }
        if (currentOpen && isOverInactive && instance.handleCloseOptions?.blockPointerEvents) {
          const floatingElement = store.select("floatingElement");
          if (floatingElement) {
            const scopeElement = instance.handleCloseOptions?.getScope?.() ?? trigger.ownerDocument.body;
            applySafePolygonPointerEventsMutation(instance, {
              scopeElement,
              referenceElement: trigger,
              floatingElement
            });
          }
        }
        const restMsValue = getRestMs(restMsRef.current);
        if (currentOpen && !isOverInactive || restMsValue === 0) {
          return;
        }
        if (!isOverInactive && instance.restTimeoutPending && event.movementX ** 2 + event.movementY ** 2 < 2) {
          return;
        }
        instance.restTimeout.clear();
        function handleMouseMove() {
          instance.restTimeoutPending = false;
          if (isClickLikeOpenEvent2()) {
            return;
          }
          const latestOpen = store.select("open");
          if (!instance.blockMouseMove && (!latestOpen || isOverInactive) && checkShouldOpen()) {
            store.setOpen(true, createChangeEventDetails(reason_parts_exports.triggerHover, nativeEvent, trigger));
          }
        }
        if (instance.pointerType === "touch") {
          ReactDOM5.flushSync(() => {
            handleMouseMove();
          });
        } else if (isOverInactive && currentOpen) {
          handleMouseMove();
        } else {
          instance.restTimeoutPending = true;
          instance.restTimeout.start(restMsValue, handleMouseMove);
        }
      }
    };
  }, [enabled, instance, isClickLikeOpenEvent2, isOverInactiveTrigger, mouseOnly, store, restMsRef, checkShouldOpen]);
}

// node_modules/@base-ui/react/floating-ui-react/safePolygon.mjs
var CURSOR_SPEED_THRESHOLD = 0.1;
var CURSOR_SPEED_THRESHOLD_SQUARED = CURSOR_SPEED_THRESHOLD * CURSOR_SPEED_THRESHOLD;
var POLYGON_BUFFER = 0.5;
function hasIntersectingEdge(pointX, pointY, xi, yi, xj, yj) {
  return yi >= pointY !== yj >= pointY && pointX <= (xj - xi) * (pointY - yi) / (yj - yi) + xi;
}
function isPointInQuadrilateral(pointX, pointY, x1, y1, x2, y2, x3, y3, x4, y4) {
  let isInsideValue = false;
  if (hasIntersectingEdge(pointX, pointY, x1, y1, x2, y2)) {
    isInsideValue = !isInsideValue;
  }
  if (hasIntersectingEdge(pointX, pointY, x2, y2, x3, y3)) {
    isInsideValue = !isInsideValue;
  }
  if (hasIntersectingEdge(pointX, pointY, x3, y3, x4, y4)) {
    isInsideValue = !isInsideValue;
  }
  if (hasIntersectingEdge(pointX, pointY, x4, y4, x1, y1)) {
    isInsideValue = !isInsideValue;
  }
  return isInsideValue;
}
function isInsideRect(pointX, pointY, rect) {
  return pointX >= rect.x && pointX <= rect.x + rect.width && pointY >= rect.y && pointY <= rect.y + rect.height;
}
function isInsideAxisAlignedRect(pointX, pointY, x1, y1, x2, y2) {
  const minX = Math.min(x1, x2);
  const maxX = Math.max(x1, x2);
  const minY = Math.min(y1, y2);
  const maxY = Math.max(y1, y2);
  return pointX >= minX && pointX <= maxX && pointY >= minY && pointY <= maxY;
}
function safePolygon(options = {}) {
  const {
    blockPointerEvents = false
  } = options;
  const timeout = new Timeout();
  const fn = ({
    x,
    y,
    placement,
    elements,
    onClose,
    nodeId,
    tree
  }) => {
    const side = placement?.split("-")[0];
    let hasLanded = false;
    let lastX = null;
    let lastY = null;
    let lastCursorTime = typeof performance !== "undefined" ? performance.now() : 0;
    function isCursorMovingSlowly(nextX, nextY) {
      const currentTime = performance.now();
      const elapsedTime = currentTime - lastCursorTime;
      if (lastX === null || lastY === null || elapsedTime === 0) {
        lastX = nextX;
        lastY = nextY;
        lastCursorTime = currentTime;
        return false;
      }
      const deltaX = nextX - lastX;
      const deltaY = nextY - lastY;
      const distanceSquared = deltaX * deltaX + deltaY * deltaY;
      const thresholdSquared = elapsedTime * elapsedTime * CURSOR_SPEED_THRESHOLD_SQUARED;
      lastX = nextX;
      lastY = nextY;
      lastCursorTime = currentTime;
      return distanceSquared < thresholdSquared;
    }
    function close() {
      timeout.clear();
      onClose();
    }
    return function onMouseMove(event) {
      timeout.clear();
      const domReference = elements.domReference;
      const floating = elements.floating;
      if (!domReference || !floating || side == null || x == null || y == null) {
        return void 0;
      }
      const {
        clientX,
        clientY
      } = event;
      const target = getTarget(event);
      const isLeave = event.type === "mouseleave";
      const isOverFloatingEl = contains(floating, target);
      const isOverReferenceEl = contains(domReference, target);
      if (isOverFloatingEl) {
        hasLanded = true;
        if (!isLeave) {
          return void 0;
        }
      }
      if (isOverReferenceEl) {
        hasLanded = false;
        if (!isLeave) {
          hasLanded = true;
          return void 0;
        }
      }
      if (isLeave && isElement(event.relatedTarget) && contains(floating, event.relatedTarget)) {
        return void 0;
      }
      function hasOpenChildNode() {
        return Boolean(tree && getNodeChildren(tree.nodesRef.current, nodeId).length > 0);
      }
      function closeIfNoOpenChild() {
        if (!hasOpenChildNode()) {
          close();
        }
      }
      if (hasOpenChildNode()) {
        return void 0;
      }
      const refRect = domReference.getBoundingClientRect();
      const rect = floating.getBoundingClientRect();
      const cursorLeaveFromRight = x > rect.right - rect.width / 2;
      const cursorLeaveFromBottom = y > rect.bottom - rect.height / 2;
      const isFloatingWider = rect.width > refRect.width;
      const isFloatingTaller = rect.height > refRect.height;
      const left = (isFloatingWider ? refRect : rect).left;
      const right = (isFloatingWider ? refRect : rect).right;
      const top = (isFloatingTaller ? refRect : rect).top;
      const bottom = (isFloatingTaller ? refRect : rect).bottom;
      if (side === "top" && y >= refRect.bottom - 1 || side === "bottom" && y <= refRect.top + 1 || side === "left" && x >= refRect.right - 1 || side === "right" && x <= refRect.left + 1) {
        closeIfNoOpenChild();
        return void 0;
      }
      let isInsideTroughRect = false;
      switch (side) {
        case "top":
          isInsideTroughRect = isInsideAxisAlignedRect(clientX, clientY, left, refRect.top + 1, right, rect.bottom - 1);
          break;
        case "bottom":
          isInsideTroughRect = isInsideAxisAlignedRect(clientX, clientY, left, rect.top + 1, right, refRect.bottom - 1);
          break;
        case "left":
          isInsideTroughRect = isInsideAxisAlignedRect(clientX, clientY, rect.right - 1, bottom, refRect.left + 1, top);
          break;
        case "right":
          isInsideTroughRect = isInsideAxisAlignedRect(clientX, clientY, refRect.right - 1, bottom, rect.left + 1, top);
          break;
        default:
      }
      if (isInsideTroughRect) {
        return void 0;
      }
      if (hasLanded && !isInsideRect(clientX, clientY, refRect)) {
        closeIfNoOpenChild();
        return void 0;
      }
      if (!isLeave && isCursorMovingSlowly(clientX, clientY)) {
        closeIfNoOpenChild();
        return void 0;
      }
      let isInsidePolygon = false;
      switch (side) {
        case "top": {
          const cursorXOffset = isFloatingWider ? POLYGON_BUFFER / 2 : POLYGON_BUFFER * 4;
          const cursorPointOneX = isFloatingWider ? x + cursorXOffset : cursorLeaveFromRight ? x + cursorXOffset : x - cursorXOffset;
          const cursorPointTwoX = isFloatingWider ? x - cursorXOffset : cursorLeaveFromRight ? x + cursorXOffset : x - cursorXOffset;
          const cursorPointY = y + POLYGON_BUFFER + 1;
          const commonYLeft = cursorLeaveFromRight ? rect.bottom - POLYGON_BUFFER : isFloatingWider ? rect.bottom - POLYGON_BUFFER : rect.top;
          const commonYRight = cursorLeaveFromRight ? isFloatingWider ? rect.bottom - POLYGON_BUFFER : rect.top : rect.bottom - POLYGON_BUFFER;
          isInsidePolygon = isPointInQuadrilateral(clientX, clientY, cursorPointOneX, cursorPointY, cursorPointTwoX, cursorPointY, rect.left, commonYLeft, rect.right, commonYRight);
          break;
        }
        case "bottom": {
          const cursorXOffset = isFloatingWider ? POLYGON_BUFFER / 2 : POLYGON_BUFFER * 4;
          const cursorPointOneX = isFloatingWider ? x + cursorXOffset : cursorLeaveFromRight ? x + cursorXOffset : x - cursorXOffset;
          const cursorPointTwoX = isFloatingWider ? x - cursorXOffset : cursorLeaveFromRight ? x + cursorXOffset : x - cursorXOffset;
          const cursorPointY = y - POLYGON_BUFFER;
          const commonYLeft = cursorLeaveFromRight ? rect.top + POLYGON_BUFFER : isFloatingWider ? rect.top + POLYGON_BUFFER : rect.bottom;
          const commonYRight = cursorLeaveFromRight ? isFloatingWider ? rect.top + POLYGON_BUFFER : rect.bottom : rect.top + POLYGON_BUFFER;
          isInsidePolygon = isPointInQuadrilateral(clientX, clientY, cursorPointOneX, cursorPointY, cursorPointTwoX, cursorPointY, rect.left, commonYLeft, rect.right, commonYRight);
          break;
        }
        case "left": {
          const cursorYOffset = isFloatingTaller ? POLYGON_BUFFER / 2 : POLYGON_BUFFER * 4;
          const cursorPointOneY = isFloatingTaller ? y + cursorYOffset : cursorLeaveFromBottom ? y + cursorYOffset : y - cursorYOffset;
          const cursorPointTwoY = isFloatingTaller ? y - cursorYOffset : cursorLeaveFromBottom ? y + cursorYOffset : y - cursorYOffset;
          const cursorPointX = x + POLYGON_BUFFER + 1;
          const commonXTop = cursorLeaveFromBottom ? rect.right - POLYGON_BUFFER : isFloatingTaller ? rect.right - POLYGON_BUFFER : rect.left;
          const commonXBottom = cursorLeaveFromBottom ? isFloatingTaller ? rect.right - POLYGON_BUFFER : rect.left : rect.right - POLYGON_BUFFER;
          isInsidePolygon = isPointInQuadrilateral(clientX, clientY, commonXTop, rect.top, commonXBottom, rect.bottom, cursorPointX, cursorPointOneY, cursorPointX, cursorPointTwoY);
          break;
        }
        case "right": {
          const cursorYOffset = isFloatingTaller ? POLYGON_BUFFER / 2 : POLYGON_BUFFER * 4;
          const cursorPointOneY = isFloatingTaller ? y + cursorYOffset : cursorLeaveFromBottom ? y + cursorYOffset : y - cursorYOffset;
          const cursorPointTwoY = isFloatingTaller ? y - cursorYOffset : cursorLeaveFromBottom ? y + cursorYOffset : y - cursorYOffset;
          const cursorPointX = x - POLYGON_BUFFER;
          const commonXTop = cursorLeaveFromBottom ? rect.left + POLYGON_BUFFER : isFloatingTaller ? rect.left + POLYGON_BUFFER : rect.right;
          const commonXBottom = cursorLeaveFromBottom ? isFloatingTaller ? rect.left + POLYGON_BUFFER : rect.right : rect.left + POLYGON_BUFFER;
          isInsidePolygon = isPointInQuadrilateral(clientX, clientY, cursorPointX, cursorPointOneY, cursorPointX, cursorPointTwoY, commonXTop, rect.top, commonXBottom, rect.bottom);
          break;
        }
        default:
      }
      if (!isInsidePolygon) {
        closeIfNoOpenChild();
      } else if (!hasLanded) {
        timeout.start(40, closeIfNoOpenChild);
      }
      return void 0;
    };
  };
  fn.__options = {
    ...options,
    blockPointerEvents
  };
  return fn;
}

// node_modules/@base-ui/react/utils/popupStateMapping.mjs
var CommonPopupDataAttributes = (function(CommonPopupDataAttributes2) {
  CommonPopupDataAttributes2["open"] = "data-open";
  CommonPopupDataAttributes2["closed"] = "data-closed";
  CommonPopupDataAttributes2[CommonPopupDataAttributes2["startingStyle"] = TransitionStatusDataAttributes.startingStyle] = "startingStyle";
  CommonPopupDataAttributes2[CommonPopupDataAttributes2["endingStyle"] = TransitionStatusDataAttributes.endingStyle] = "endingStyle";
  CommonPopupDataAttributes2["anchorHidden"] = "data-anchor-hidden";
  CommonPopupDataAttributes2["side"] = "data-side";
  CommonPopupDataAttributes2["align"] = "data-align";
  return CommonPopupDataAttributes2;
})({});
var CommonTriggerDataAttributes = /* @__PURE__ */ (function(CommonTriggerDataAttributes2) {
  CommonTriggerDataAttributes2["popupOpen"] = "data-popup-open";
  CommonTriggerDataAttributes2["pressed"] = "data-pressed";
  return CommonTriggerDataAttributes2;
})({});
var TRIGGER_HOOK = {
  [CommonTriggerDataAttributes.popupOpen]: ""
};
var PRESSABLE_TRIGGER_HOOK = {
  [CommonTriggerDataAttributes.popupOpen]: "",
  [CommonTriggerDataAttributes.pressed]: ""
};
var POPUP_OPEN_HOOK = {
  [CommonPopupDataAttributes.open]: ""
};
var POPUP_CLOSED_HOOK = {
  [CommonPopupDataAttributes.closed]: ""
};
var ANCHOR_HIDDEN_HOOK = {
  [CommonPopupDataAttributes.anchorHidden]: ""
};
var triggerOpenStateMapping = {
  open(value) {
    if (value) {
      return TRIGGER_HOOK;
    }
    return null;
  }
};
var pressableTriggerOpenStateMapping = {
  open(value) {
    if (value) {
      return PRESSABLE_TRIGGER_HOOK;
    }
    return null;
  }
};
var popupStateMapping = {
  open(value) {
    if (value) {
      return POPUP_OPEN_HOOK;
    }
    return POPUP_CLOSED_HOOK;
  },
  anchorHidden(value) {
    if (value) {
      return ANCHOR_HIDDEN_HOOK;
    }
    return null;
  }
};

// node_modules/@base-ui/react/internals/composite/composite.mjs
var ARROW_UP = "ArrowUp";
var ARROW_DOWN = "ArrowDown";
var ARROW_LEFT = "ArrowLeft";
var ARROW_RIGHT = "ArrowRight";
var HOME = "Home";
var END = "End";
var HORIZONTAL_KEYS = /* @__PURE__ */ new Set([ARROW_LEFT, ARROW_RIGHT]);
var VERTICAL_KEYS = /* @__PURE__ */ new Set([ARROW_UP, ARROW_DOWN]);
var ARROW_KEYS = /* @__PURE__ */ new Set([...HORIZONTAL_KEYS, ...VERTICAL_KEYS]);
var COMPOSITE_KEYS = /* @__PURE__ */ new Set([...ARROW_KEYS, HOME, END]);

// node_modules/@base-ui/utils/inertValue.mjs
function inertValue(value) {
  if (isReactVersionAtLeast(19)) {
    return value;
  }
  return value ? "true" : void 0;
}

// node_modules/@base-ui/react/utils/InternalBackdrop.mjs
var React34 = __toESM(require_react(), 1);
var import_jsx_runtime6 = __toESM(require_jsx_runtime(), 1);
var InternalBackdrop = /* @__PURE__ */ React34.forwardRef(function InternalBackdrop2(props, ref) {
  const {
    cutout,
    ...otherProps
  } = props;
  let clipPath;
  if (cutout) {
    const rect = cutout.getBoundingClientRect();
    clipPath = `polygon(0% 0%,100% 0%,100% 100%,0% 100%,0% 0%,${rect.left}px ${rect.top}px,${rect.left}px ${rect.bottom}px,${rect.right}px ${rect.bottom}px,${rect.right}px ${rect.top}px,${rect.left}px ${rect.top}px)`;
  }
  return /* @__PURE__ */ (0, import_jsx_runtime6.jsx)("div", {
    ref,
    role: "presentation",
    "data-base-ui-inert": "",
    ...otherProps,
    style: {
      position: "fixed",
      inset: 0,
      userSelect: "none",
      WebkitUserSelect: "none",
      clipPath
    }
  });
});
if (true) InternalBackdrop.displayName = "InternalBackdrop";

// node_modules/@base-ui/react/utils/useOpenInteractionType.mjs
var React36 = __toESM(require_react(), 1);

// node_modules/@base-ui/utils/useEnhancedClickHandler.mjs
var React35 = __toESM(require_react(), 1);
function useEnhancedClickHandler(handler) {
  const lastClickInteractionTypeRef = React35.useRef("");
  const handlePointerDown = React35.useCallback((event) => {
    if (event.defaultPrevented) {
      return;
    }
    lastClickInteractionTypeRef.current = event.pointerType;
    handler(event, event.pointerType);
  }, [handler]);
  const handleClick = React35.useCallback((event) => {
    if (event.detail === 0) {
      handler(event, "keyboard");
      return;
    }
    if ("pointerType" in event) {
      handler(event, event.pointerType);
    } else {
      handler(event, lastClickInteractionTypeRef.current);
    }
    lastClickInteractionTypeRef.current = "";
  }, [handler]);
  return {
    onClick: handleClick,
    onPointerDown: handlePointerDown
  };
}

// node_modules/@base-ui/react/utils/useOpenInteractionType.mjs
function useOpenMethodTriggerProps(open, setOpenMethod) {
  const handleTriggerClick = useStableCallback((_, interactionType) => {
    const isOpen = typeof open === "function" ? open() : open;
    if (!isOpen) {
      setOpenMethod(interactionType || // On iOS Safari, the hitslop around touch targets means tapping outside an element's
      // bounds does not fire `pointerdown` but does fire `mousedown`. The `interactionType`
      // will be "" in that case.
      (parts_exports.os.ios ? "touch" : ""));
    }
  });
  const {
    onClick,
    onPointerDown
  } = useEnhancedClickHandler(handleTriggerClick);
  return React36.useMemo(() => ({
    onClick,
    onPointerDown
  }), [onClick, onPointerDown]);
}

// node_modules/@base-ui/react/utils/useAnchorPositioning.mjs
var React37 = __toESM(require_react(), 1);

// node_modules/@base-ui/react/floating-ui-react/middleware/arrow.mjs
var baseArrow = (options) => ({
  name: "arrow",
  options,
  async fn(state) {
    const {
      x,
      y,
      placement,
      rects,
      platform: platform3,
      elements,
      middlewareData
    } = state;
    const {
      element,
      padding = 0,
      offsetParent = "real"
    } = evaluate(options, state) || {};
    if (element == null) {
      return {};
    }
    const paddingObject = getPaddingObject(padding);
    const coords = {
      x,
      y
    };
    const axis = getAlignmentAxis(placement);
    const length = getAxisLength(axis);
    const arrowDimensions = await platform3.getDimensions(element);
    const isYAxis = axis === "y";
    const minProp = isYAxis ? "top" : "left";
    const maxProp = isYAxis ? "bottom" : "right";
    const clientProp = isYAxis ? "clientHeight" : "clientWidth";
    const endDiff = rects.reference[length] + rects.reference[axis] - coords[axis] - rects.floating[length];
    const startDiff = coords[axis] - rects.reference[axis];
    const arrowOffsetParent = offsetParent === "real" ? await platform3.getOffsetParent?.(element) : elements.floating;
    let clientSize = elements.floating[clientProp] || rects.floating[length];
    if (!clientSize || !await platform3.isElement?.(arrowOffsetParent)) {
      clientSize = elements.floating[clientProp] || rects.floating[length];
    }
    const centerToReference = endDiff / 2 - startDiff / 2;
    const largestPossiblePadding = clientSize / 2 - arrowDimensions[length] / 2 - 1;
    const minPadding = Math.min(paddingObject[minProp], largestPossiblePadding);
    const maxPadding = Math.min(paddingObject[maxProp], largestPossiblePadding);
    const min2 = minPadding;
    const max2 = clientSize - arrowDimensions[length] - maxPadding;
    const center = clientSize / 2 - arrowDimensions[length] / 2 + centerToReference;
    const offset4 = clamp(min2, center, max2);
    const shouldAddOffset = !middlewareData.arrow && getAlignment(placement) != null && center !== offset4 && rects.reference[length] / 2 - (center < min2 ? minPadding : maxPadding) - arrowDimensions[length] / 2 < 0;
    const alignmentOffset = shouldAddOffset ? center < min2 ? center - min2 : center - max2 : 0;
    return {
      [axis]: coords[axis] + alignmentOffset,
      data: {
        [axis]: offset4,
        centerOffset: center - offset4 - alignmentOffset,
        ...shouldAddOffset && {
          alignmentOffset
        }
      },
      reset: shouldAddOffset
    };
  }
});
var arrow4 = (options, deps) => ({
  ...baseArrow(options),
  options: [options, deps]
});

// node_modules/@base-ui/react/utils/hideMiddleware.mjs
var nativeHideFn = hide3().fn;
var hide4 = {
  name: "hide",
  async fn(state) {
    const {
      width,
      height,
      x,
      y
    } = state.rects.reference;
    const anchorHidden = width === 0 && height === 0 && x === 0 && y === 0;
    const nativeHideResult = await nativeHideFn(state);
    return {
      data: {
        referenceHidden: nativeHideResult.data?.referenceHidden || anchorHidden
      }
    };
  }
};

// node_modules/@base-ui/react/utils/adaptiveOriginMiddleware.mjs
var DEFAULT_SIDES = {
  sideX: "left",
  sideY: "top"
};
var adaptiveOrigin = {
  name: "adaptiveOrigin",
  async fn(state) {
    const {
      x: rawX,
      y: rawY,
      rects: {
        floating: floatRect
      },
      elements: {
        floating
      },
      platform: platform3,
      strategy,
      placement
    } = state;
    const win = getWindow(floating);
    const styles = win.getComputedStyle(floating);
    const hasTransition = styles.transitionDuration !== "0s" && styles.transitionDuration !== "";
    if (!hasTransition) {
      return {
        x: rawX,
        y: rawY,
        data: DEFAULT_SIDES
      };
    }
    const offsetParent = await platform3.getOffsetParent?.(floating);
    let offsetDimensions = {
      width: 0,
      height: 0
    };
    if (strategy === "fixed" && win?.visualViewport) {
      offsetDimensions = {
        width: win.visualViewport.width,
        height: win.visualViewport.height
      };
    } else if (offsetParent === win) {
      const doc = ownerDocument(floating);
      offsetDimensions = {
        width: doc.documentElement.clientWidth,
        height: doc.documentElement.clientHeight
      };
    } else if (await platform3.isElement?.(offsetParent)) {
      offsetDimensions = await platform3.getDimensions(offsetParent);
    }
    const currentSide = getSide(placement);
    let x = rawX;
    let y = rawY;
    if (currentSide === "left") {
      x = offsetDimensions.width - (rawX + floatRect.width);
    }
    if (currentSide === "top") {
      y = offsetDimensions.height - (rawY + floatRect.height);
    }
    const sideX = currentSide === "left" ? "right" : DEFAULT_SIDES.sideX;
    const sideY = currentSide === "top" ? "bottom" : DEFAULT_SIDES.sideY;
    return {
      x,
      y,
      data: {
        sideX,
        sideY
      }
    };
  }
};

// node_modules/@base-ui/react/utils/useAnchorPositioning.mjs
function getLogicalSide(sideParam, renderedSide, isRtl) {
  const isLogicalSideParam = sideParam === "inline-start" || sideParam === "inline-end";
  const logicalRight = isRtl ? "inline-start" : "inline-end";
  const logicalLeft = isRtl ? "inline-end" : "inline-start";
  return {
    top: "top",
    right: isLogicalSideParam ? logicalRight : "right",
    bottom: "bottom",
    left: isLogicalSideParam ? logicalLeft : "left"
  }[renderedSide];
}
function getOffsetData(state, sideParam, isRtl) {
  const {
    rects,
    placement
  } = state;
  const data = {
    side: getLogicalSide(sideParam, getSide(placement), isRtl),
    align: getAlignment(placement) || "center",
    anchor: {
      width: rects.reference.width,
      height: rects.reference.height
    },
    positioner: {
      width: rects.floating.width,
      height: rects.floating.height
    }
  };
  return data;
}
function useAnchorPositioning(params) {
  const {
    // Public parameters
    anchor,
    positionMethod = "absolute",
    side: sideParam = "bottom",
    sideOffset = 0,
    align = "center",
    alignOffset = 0,
    collisionBoundary,
    collisionPadding: collisionPaddingParam = 5,
    sticky = false,
    arrowPadding = 5,
    disableAnchorTracking = false,
    inline: inlineMiddleware,
    // Private parameters
    keepMounted = false,
    floatingRootContext,
    mounted,
    collisionAvoidance,
    shiftCrossAxis = false,
    nodeId,
    adaptiveOrigin: adaptiveOrigin2,
    lazyFlip = false,
    externalTree
  } = params;
  const [mountSide, setMountSide] = React37.useState(null);
  if (!mounted && mountSide !== null) {
    setMountSide(null);
  }
  const collisionAvoidanceSide = collisionAvoidance.side || "flip";
  const collisionAvoidanceAlign = collisionAvoidance.align || "flip";
  const collisionAvoidanceFallbackAxisSide = collisionAvoidance.fallbackAxisSide || "end";
  const anchorFn = typeof anchor === "function" ? anchor : void 0;
  const anchorFnCallback = useStableCallback(anchorFn);
  const anchorDep = anchorFn ? anchorFnCallback : anchor;
  const anchorValueRef = useValueAsRef(anchor);
  const mountedRef = useValueAsRef(mounted);
  const direction = useDirection();
  const isRtl = direction === "rtl";
  const side = mountSide || {
    top: "top",
    right: "right",
    bottom: "bottom",
    left: "left",
    "inline-end": isRtl ? "left" : "right",
    "inline-start": isRtl ? "right" : "left"
  }[sideParam];
  const placement = align === "center" ? side : `${side}-${align}`;
  let collisionPadding = collisionPaddingParam;
  const bias = 1;
  const biasTop = sideParam === "bottom" ? bias : 0;
  const biasBottom = sideParam === "top" ? bias : 0;
  const biasLeft = sideParam === "right" ? bias : 0;
  const biasRight = sideParam === "left" ? bias : 0;
  if (typeof collisionPadding === "number") {
    collisionPadding = {
      top: collisionPadding + biasTop,
      right: collisionPadding + biasRight,
      bottom: collisionPadding + biasBottom,
      left: collisionPadding + biasLeft
    };
  } else if (collisionPadding) {
    collisionPadding = {
      top: (collisionPadding.top || 0) + biasTop,
      right: (collisionPadding.right || 0) + biasRight,
      bottom: (collisionPadding.bottom || 0) + biasBottom,
      left: (collisionPadding.left || 0) + biasLeft
    };
  }
  const commonCollisionProps = {
    boundary: collisionBoundary === "clipping-ancestors" ? "clippingAncestors" : collisionBoundary,
    padding: collisionPadding
  };
  const arrowRef = React37.useRef(null);
  const sideOffsetRef = useValueAsRef(sideOffset);
  const alignOffsetRef = useValueAsRef(alignOffset);
  const sideOffsetDep = typeof sideOffset !== "function" ? sideOffset : 0;
  const alignOffsetDep = typeof alignOffset !== "function" ? alignOffset : 0;
  const middleware = [];
  if (inlineMiddleware) {
    middleware.push(inlineMiddleware);
  }
  middleware.push(offset3((state) => {
    const data = getOffsetData(state, sideParam, isRtl);
    const sideAxis = typeof sideOffsetRef.current === "function" ? sideOffsetRef.current(data) : sideOffsetRef.current;
    const alignAxis = typeof alignOffsetRef.current === "function" ? alignOffsetRef.current(data) : alignOffsetRef.current;
    return {
      mainAxis: sideAxis,
      crossAxis: alignAxis,
      alignmentAxis: alignAxis
    };
  }, [sideOffsetDep, alignOffsetDep, isRtl, sideParam]));
  const shiftDisabled = collisionAvoidanceAlign === "none" && collisionAvoidanceSide !== "shift";
  const crossAxisShiftEnabled = !shiftDisabled && (sticky || shiftCrossAxis || collisionAvoidanceSide === "shift");
  const flipMiddleware = collisionAvoidanceSide === "none" ? null : flip3({
    ...commonCollisionProps,
    // Ensure the popup flips if it's been limited by its --available-height and it resizes.
    // Since the size() padding is smaller than the flip() padding, flip() will take precedence.
    padding: {
      top: collisionPadding.top + bias,
      right: collisionPadding.right + bias,
      bottom: collisionPadding.bottom + bias,
      left: collisionPadding.left + bias
    },
    mainAxis: !shiftCrossAxis && collisionAvoidanceSide === "flip",
    crossAxis: collisionAvoidanceAlign === "flip" ? "alignment" : false,
    fallbackAxisSideDirection: collisionAvoidanceFallbackAxisSide
  });
  const shiftMiddleware = shiftDisabled ? null : shift3((data) => {
    const html = ownerDocument(data.elements.floating).documentElement;
    return {
      ...commonCollisionProps,
      // Use the Layout Viewport to avoid shifting around when pinch-zooming
      // for context menus.
      rootBoundary: shiftCrossAxis ? {
        x: 0,
        y: 0,
        width: html.clientWidth,
        height: html.clientHeight
      } : void 0,
      mainAxis: collisionAvoidanceAlign !== "none",
      crossAxis: crossAxisShiftEnabled,
      limiter: sticky || shiftCrossAxis ? void 0 : limitShift3((limitData) => {
        if (!arrowRef.current) {
          return {};
        }
        const {
          width,
          height
        } = arrowRef.current.getBoundingClientRect();
        const sideAxis = getSideAxis(getSide(limitData.placement));
        const arrowSize = sideAxis === "y" ? width : height;
        const offsetAmount = sideAxis === "y" ? collisionPadding.left + collisionPadding.right : collisionPadding.top + collisionPadding.bottom;
        return {
          offset: arrowSize / 2 + offsetAmount / 2
        };
      })
    };
  }, [commonCollisionProps, sticky, shiftCrossAxis, collisionPadding, collisionAvoidanceAlign]);
  if (collisionAvoidanceSide === "shift" || collisionAvoidanceAlign === "shift" || align === "center") {
    middleware.push(shiftMiddleware, flipMiddleware);
  } else {
    middleware.push(flipMiddleware, shiftMiddleware);
  }
  middleware.push(size3({
    ...commonCollisionProps,
    apply({
      elements: {
        floating
      },
      availableWidth,
      availableHeight,
      rects
    }) {
      if (!mountedRef.current) {
        return;
      }
      const floatingStyle = floating.style;
      floatingStyle.setProperty("--available-width", `${availableWidth}px`);
      floatingStyle.setProperty("--available-height", `${availableHeight}px`);
      const dpr = getWindow(floating).devicePixelRatio || 1;
      const {
        x: x2,
        y: y2,
        width,
        height
      } = rects.reference;
      const anchorWidth = (Math.round((x2 + width) * dpr) - Math.round(x2 * dpr)) / dpr;
      const anchorHeight = (Math.round((y2 + height) * dpr) - Math.round(y2 * dpr)) / dpr;
      floatingStyle.setProperty("--anchor-width", `${anchorWidth}px`);
      floatingStyle.setProperty("--anchor-height", `${anchorHeight}px`);
    }
  }), arrow4((state) => ({
    // `transform-origin` calculations rely on an element existing. If the arrow hasn't been set,
    // we'll create a fake element.
    element: arrowRef.current || ownerDocument(state.elements.floating).createElement("div"),
    padding: arrowPadding,
    offsetParent: "floating"
  }), [arrowPadding]), {
    name: "transformOrigin",
    fn(state) {
      const {
        elements: elements2,
        middlewareData: middlewareData2,
        placement: renderedPlacement2,
        rects,
        y: y2
      } = state;
      const currentRenderedSide = getSide(renderedPlacement2);
      const currentRenderedAxis = getSideAxis(currentRenderedSide);
      const arrowEl = arrowRef.current;
      const arrowX = middlewareData2.arrow?.x || 0;
      const arrowY = middlewareData2.arrow?.y || 0;
      const arrowWidth = arrowEl?.clientWidth || 0;
      const arrowHeight = arrowEl?.clientHeight || 0;
      const transformX = arrowX + arrowWidth / 2;
      const transformY = arrowY + arrowHeight / 2;
      const shiftY = Math.abs(middlewareData2.shift?.y || 0);
      const halfAnchorHeight = rects.reference.height / 2;
      const sideOffsetValue = typeof sideOffset === "function" ? sideOffset(getOffsetData(state, sideParam, isRtl)) : sideOffset;
      const isOverlappingAnchor = shiftY > sideOffsetValue;
      const adjacentTransformOrigin = {
        top: `${transformX}px calc(100% + ${sideOffsetValue}px)`,
        bottom: `${transformX}px ${-sideOffsetValue}px`,
        left: `calc(100% + ${sideOffsetValue}px) ${transformY}px`,
        right: `${-sideOffsetValue}px ${transformY}px`
      }[currentRenderedSide];
      const overlapTransformOrigin = `${transformX}px ${rects.reference.y + halfAnchorHeight - y2}px`;
      elements2.floating.style.setProperty("--transform-origin", crossAxisShiftEnabled && currentRenderedAxis === "y" && isOverlappingAnchor ? overlapTransformOrigin : adjacentTransformOrigin);
      return {};
    }
  }, hide4, adaptiveOrigin2);
  useIsoLayoutEffect(() => {
    if (!mounted && floatingRootContext) {
      floatingRootContext.update({
        referenceElement: null,
        floatingElement: null,
        domReferenceElement: null,
        positionReference: null
      });
    }
  }, [mounted, floatingRootContext]);
  const autoUpdateOptions = React37.useMemo(() => ({
    elementResize: !disableAnchorTracking && typeof ResizeObserver !== "undefined",
    layoutShift: !disableAnchorTracking && typeof IntersectionObserver !== "undefined"
  }), [disableAnchorTracking]);
  const {
    refs,
    elements,
    x,
    y,
    middlewareData,
    update: update2,
    placement: renderedPlacement,
    context,
    isPositioned,
    floatingStyles: originalFloatingStyles
  } = useFloating2({
    rootContext: floatingRootContext,
    open: keepMounted ? mounted : void 0,
    placement,
    middleware,
    strategy: positionMethod,
    whileElementsMounted: keepMounted ? void 0 : (...args) => autoUpdate(...args, autoUpdateOptions),
    nodeId,
    externalTree
  });
  const {
    sideX,
    sideY
  } = middlewareData.adaptiveOrigin || DEFAULT_SIDES;
  const resolvedPosition = isPositioned ? positionMethod : "fixed";
  const floatingStyles = React37.useMemo(() => {
    const base = adaptiveOrigin2 ? {
      position: resolvedPosition,
      [sideX]: x,
      [sideY]: y
    } : {
      position: resolvedPosition,
      ...originalFloatingStyles
    };
    if (!isPositioned) {
      base.opacity = 0;
    }
    return base;
  }, [adaptiveOrigin2, resolvedPosition, sideX, x, sideY, y, originalFloatingStyles, isPositioned]);
  const registeredPositionReferenceRef = React37.useRef(null);
  useIsoLayoutEffect(() => {
    if (!mounted) {
      return;
    }
    const anchorValue = anchorValueRef.current;
    const resolvedAnchor = typeof anchorValue === "function" ? anchorValue() : anchorValue;
    const unwrappedElement = (isRef(resolvedAnchor) ? resolvedAnchor.current : resolvedAnchor) || null;
    const finalAnchor = unwrappedElement || null;
    if (finalAnchor !== registeredPositionReferenceRef.current) {
      refs.setPositionReference(finalAnchor);
      registeredPositionReferenceRef.current = finalAnchor;
    }
  }, [mounted, refs, anchorDep, anchorValueRef]);
  React37.useEffect(() => {
    if (!mounted) {
      return;
    }
    const anchorValue = anchorValueRef.current;
    if (typeof anchorValue === "function") {
      return;
    }
    if (isRef(anchorValue) && anchorValue.current !== registeredPositionReferenceRef.current) {
      refs.setPositionReference(anchorValue.current);
      registeredPositionReferenceRef.current = anchorValue.current;
    }
  }, [mounted, refs, anchorDep, anchorValueRef]);
  React37.useEffect(() => {
    if (keepMounted && mounted && elements.reference && elements.floating) {
      return autoUpdate(elements.reference, elements.floating, update2, autoUpdateOptions);
    }
    return void 0;
  }, [keepMounted, mounted, elements, update2, autoUpdateOptions]);
  const renderedSide = getSide(renderedPlacement);
  const logicalRenderedSide = getLogicalSide(sideParam, renderedSide, isRtl);
  const renderedAlign = getAlignment(renderedPlacement) || "center";
  const anchorHidden = Boolean(middlewareData.hide?.referenceHidden);
  useIsoLayoutEffect(() => {
    if (lazyFlip && mounted && isPositioned) {
      setMountSide(renderedSide);
    }
  }, [lazyFlip, mounted, isPositioned, renderedSide]);
  const arrowStyles = React37.useMemo(() => ({
    position: "absolute",
    top: middlewareData.arrow?.y,
    left: middlewareData.arrow?.x
  }), [middlewareData.arrow]);
  const arrowUncentered = middlewareData.arrow?.centerOffset !== 0;
  return React37.useMemo(() => ({
    positionerStyles: floatingStyles,
    arrowStyles,
    arrowRef,
    arrowUncentered,
    side: logicalRenderedSide,
    align: renderedAlign,
    physicalSide: renderedSide,
    anchorHidden,
    refs,
    context,
    isPositioned,
    update: update2
  }), [floatingStyles, arrowStyles, arrowRef, arrowUncentered, logicalRenderedSide, renderedAlign, renderedSide, anchorHidden, refs, context, isPositioned, update2]);
}
function isRef(param) {
  return param != null && "current" in param;
}

// node_modules/@base-ui/react/utils/getDisabledMountTransitionStyles.mjs
function getDisabledMountTransitionStyles(transitionStatus) {
  return transitionStatus === "starting" ? DISABLED_TRANSITIONS_STYLE : EMPTY_OBJECT;
}

// node_modules/@base-ui/react/utils/usePositioner.mjs
function usePositioner(componentProps, state, {
  styles,
  transitionStatus,
  props,
  refs,
  hidden,
  inert = false
}) {
  const style = {
    ...styles
  };
  if (inert) {
    style.pointerEvents = "none";
  }
  return useRenderElement("div", componentProps, {
    state,
    ref: refs,
    props: [{
      role: "presentation",
      hidden,
      style
    }, getDisabledMountTransitionStyles(transitionStatus), props],
    stateAttributesMapping: popupStateMapping
  });
}

// node_modules/@base-ui/react/utils/useAnchoredPopupScrollLock.mjs
var React38 = __toESM(require_react(), 1);
var VIEWPORT_WIDTH_TOLERANCE_PX = 20;
function useAnchoredPopupScrollLock(enabled, touchOpen, positionerElement, referenceElement) {
  const [touchOpenShouldLockScroll, setTouchOpenShouldLockScroll] = React38.useState(false);
  useIsoLayoutEffect(() => {
    if (!enabled || !touchOpen || positionerElement == null) {
      setTouchOpenShouldLockScroll(false);
      return;
    }
    const viewportWidth = ownerDocument(positionerElement).documentElement.clientWidth;
    const popupWidth = positionerElement.offsetWidth;
    setTouchOpenShouldLockScroll(viewportWidth > 0 && popupWidth > 0 && popupWidth >= viewportWidth - VIEWPORT_WIDTH_TOLERANCE_PX);
  }, [enabled, touchOpen, positionerElement]);
  useScrollLock(enabled && (!touchOpen || touchOpenShouldLockScroll), referenceElement);
}

// node_modules/@base-ui/react/button/Button.mjs
var React39 = __toESM(require_react(), 1);
var Button = /* @__PURE__ */ React39.forwardRef(function Button2(componentProps, forwardedRef) {
  const {
    render,
    className,
    disabled: disabled2 = false,
    focusableWhenDisabled = false,
    nativeButton = true,
    style,
    ...elementProps
  } = componentProps;
  const {
    getButtonProps,
    buttonRef
  } = useButton({
    disabled: disabled2,
    focusableWhenDisabled,
    native: nativeButton
  });
  const state = {
    disabled: disabled2
  };
  return useRenderElement("button", componentProps, {
    state,
    ref: [forwardedRef, buttonRef],
    props: [elementProps, getButtonProps]
  });
});
if (true) Button.displayName = "Button";

// node_modules/@base-ui/react/toolbar/root/ToolbarRootContext.mjs
var React40 = __toESM(require_react(), 1);
var ToolbarRootContext = /* @__PURE__ */ React40.createContext(void 0);
if (true) ToolbarRootContext.displayName = "ToolbarRootContext";
function useToolbarRootContext(optional) {
  const context = React40.useContext(ToolbarRootContext);
  if (context === void 0 && !optional) {
    throw new Error(true ? "Base UI: ToolbarRootContext is missing. Toolbar parts must be placed within <Toolbar.Root>." : formatErrorMessage_default(69));
  }
  return context;
}

// node_modules/@base-ui/react/utils/popups/useTriggerFocusGuards.mjs
var React41 = __toESM(require_react(), 1);
var ReactDOM6 = __toESM(require_react_dom(), 1);
function useTriggerFocusGuards(store, triggerElementRef) {
  const preFocusGuardRef = React41.useRef(null);
  function handlePreFocusGuardFocus(event) {
    ReactDOM6.flushSync(() => {
      store.setOpen(false, createChangeEventDetails(reason_parts_exports.focusOut, event.nativeEvent, event.currentTarget));
    });
    const previousTabbable = getTabbableBeforeElement(preFocusGuardRef.current);
    previousTabbable?.focus();
  }
  function handleFocusTargetFocus(event) {
    const positionerElement = store.select("positionerElement");
    if (positionerElement && isOutsideEvent(event, positionerElement)) {
      store.context.beforeContentFocusGuardRef.current?.focus();
    } else {
      ReactDOM6.flushSync(() => {
        store.setOpen(false, createChangeEventDetails(reason_parts_exports.focusOut, event.nativeEvent, event.currentTarget));
      });
      let nextTabbable = getTabbableAfterElement(store.context.triggerFocusTargetRef.current || triggerElementRef.current);
      while (nextTabbable !== null && contains(positionerElement, nextTabbable)) {
        const prevTabbable = nextTabbable;
        nextTabbable = getNextTabbable(nextTabbable);
        if (nextTabbable === prevTabbable) {
          break;
        }
      }
      nextTabbable?.focus();
    }
  }
  return {
    preFocusGuardRef,
    handlePreFocusGuardFocus,
    handleFocusTargetFocus
  };
}

// node_modules/@base-ui/react/utils/usePopupViewport.mjs
var React44 = __toESM(require_react(), 1);
var ReactDOM7 = __toESM(require_react_dom(), 1);

// node_modules/@base-ui/utils/usePreviousValue.mjs
var React42 = __toESM(require_react(), 1);
function usePreviousValue(value) {
  const [state, setState] = React42.useState({
    current: value,
    previous: null
  });
  if (value !== state.current) {
    setState({
      current: value,
      previous: state.current
    });
  }
  return state.previous;
}

// node_modules/@base-ui/react/utils/usePopupAutoResize.mjs
var React43 = __toESM(require_react(), 1);

// node_modules/@base-ui/react/utils/getCssDimensions.mjs
function getCssDimensions2(element) {
  const css = getComputedStyle2(element);
  let width = parseFloat(css.width) || 0;
  let height = parseFloat(css.height) || 0;
  const hasOffset = isHTMLElement(element);
  const offsetWidth = hasOffset ? element.offsetWidth : width;
  const offsetHeight = hasOffset ? element.offsetHeight : height;
  const shouldFallback = round(width) !== offsetWidth || round(height) !== offsetHeight;
  if (shouldFallback) {
    width = offsetWidth;
    height = offsetHeight;
  }
  return {
    width,
    height
  };
}

// node_modules/@base-ui/react/utils/usePopupAutoResize.mjs
function usePopupAutoResize(parameters) {
  const {
    popupElement,
    positionerElement,
    content,
    mounted,
    onMeasureLayout: onMeasureLayoutParam,
    onMeasureLayoutComplete: onMeasureLayoutCompleteParam,
    side,
    direction
  } = parameters;
  const runOnceAnimationsFinish = useAnimationsFinished(popupElement, true, false);
  const animationFrame = useAnimationFrame();
  const committedDimensionsRef = React43.useRef(null);
  const isInitialRenderRef = React43.useRef(true);
  const restoreAnchoringStylesRef = React43.useRef(NOOP);
  const onMeasureLayout = useStableCallback(onMeasureLayoutParam);
  const onMeasureLayoutComplete = useStableCallback(onMeasureLayoutCompleteParam);
  const anchoringStyles = React43.useMemo(() => {
    let isOriginSide = side === "top";
    let isPhysicalLeft = side === "left";
    if (direction === "rtl") {
      isOriginSide = isOriginSide || side === "inline-end";
      isPhysicalLeft = isPhysicalLeft || side === "inline-end";
    } else {
      isOriginSide = isOriginSide || side === "inline-start";
      isPhysicalLeft = isPhysicalLeft || side === "inline-start";
    }
    return isOriginSide ? {
      position: "absolute",
      [side === "top" ? "bottom" : "top"]: "0",
      [isPhysicalLeft ? "right" : "left"]: "0"
    } : EMPTY_OBJECT;
  }, [side, direction]);
  useIsoLayoutEffect(() => {
    if (!mounted) {
      restoreAnchoringStylesRef.current = NOOP;
      isInitialRenderRef.current = true;
      committedDimensionsRef.current = null;
      return void 0;
    }
    if (!popupElement || !positionerElement) {
      return void 0;
    }
    restoreAnchoringStylesRef.current = applyElementStyles(popupElement, anchoringStyles);
    setPopupCssSize(popupElement, "auto");
    const restorePopupPosition = overrideElementStyle(popupElement, "position", "static");
    const restorePopupTransform = overrideElementStyle(popupElement, "transform", "none");
    const restorePopupScale = overrideElementStyle(popupElement, "scale", "1");
    const restorePositionerAvailableSize = applyElementStyles(positionerElement, {
      "--available-width": "max-content",
      "--available-height": "max-content"
    });
    function restoreMeasurementOverrides() {
      restorePopupPosition();
      restorePopupTransform();
      restorePositionerAvailableSize();
    }
    function restoreMeasurementOverridesIncludingScale() {
      restoreMeasurementOverrides();
      restorePopupScale();
    }
    onMeasureLayout?.();
    if (isInitialRenderRef.current || committedDimensionsRef.current === null) {
      setPositionerCssSize(positionerElement, "max-content");
      const dimensions = getCssDimensions2(popupElement);
      committedDimensionsRef.current = dimensions;
      setPositionerCssSize(positionerElement, dimensions);
      restoreMeasurementOverridesIncludingScale();
      onMeasureLayoutComplete?.(null, dimensions);
      isInitialRenderRef.current = false;
      return () => {
        restoreAnchoringStylesRef.current();
        restoreAnchoringStylesRef.current = NOOP;
      };
    }
    setPositionerCssSize(positionerElement, "max-content");
    const previousDimensions = committedDimensionsRef.current;
    const newDimensions = getCssDimensions2(popupElement);
    committedDimensionsRef.current = newDimensions;
    setPopupCssSize(popupElement, previousDimensions);
    restoreMeasurementOverridesIncludingScale();
    onMeasureLayoutComplete?.(previousDimensions, newDimensions);
    setPositionerCssSize(positionerElement, newDimensions);
    const abortController = new AbortController();
    animationFrame.request(() => {
      setPopupCssSize(popupElement, newDimensions);
      runOnceAnimationsFinish(() => {
        popupElement.style.setProperty("--popup-width", "auto");
        popupElement.style.setProperty("--popup-height", "auto");
      }, abortController.signal);
    });
    return () => {
      abortController.abort();
      animationFrame.cancel();
      restoreAnchoringStylesRef.current();
      restoreAnchoringStylesRef.current = NOOP;
    };
  }, [content, popupElement, positionerElement, runOnceAnimationsFinish, animationFrame, mounted, onMeasureLayout, onMeasureLayoutComplete, anchoringStyles]);
}
function overrideElementStyle(element, property, value) {
  const originalValue = element.style.getPropertyValue(property);
  element.style.setProperty(property, value);
  return () => {
    element.style.setProperty(property, originalValue);
  };
}
function applyElementStyles(element, styles) {
  const restorers = [];
  for (const [key, value] of Object.entries(styles)) {
    restorers.push(overrideElementStyle(element, key, value));
  }
  return restorers.length ? () => {
    restorers.forEach((restore) => restore());
  } : NOOP;
}
function setPopupCssSize(popupElement, size4) {
  const width = size4 === "auto" ? "auto" : `${size4.width}px`;
  const height = size4 === "auto" ? "auto" : `${size4.height}px`;
  popupElement.style.setProperty("--popup-width", width);
  popupElement.style.setProperty("--popup-height", height);
}
function setPositionerCssSize(positionerElement, size4) {
  const width = size4 === "max-content" ? "max-content" : `${size4.width}px`;
  const height = size4 === "max-content" ? "max-content" : `${size4.height}px`;
  positionerElement.style.setProperty("--positioner-width", width);
  positionerElement.style.setProperty("--positioner-height", height);
}

// node_modules/@base-ui/react/utils/usePopupViewport.mjs
var import_jsx_runtime7 = __toESM(require_jsx_runtime(), 1);
function usePopupViewport(parameters) {
  const {
    store,
    side,
    cssVars,
    children
  } = parameters;
  const direction = useDirection();
  const activeTrigger = store.useState("activeTriggerElement");
  const activeTriggerId = store.useState("activeTriggerId");
  const open = store.useState("open");
  const payload = store.useState("payload");
  const mounted = store.useState("mounted");
  const popupElement = store.useState("popupElement");
  const positionerElement = store.useState("positionerElement");
  const previousActiveTrigger = usePreviousValue(open ? activeTrigger : null);
  const currentContentKey = usePopupContentKey(activeTriggerId, payload);
  const capturedNodeRef = React44.useRef(null);
  const [previousContentNode, setPreviousContentNode] = React44.useState(null);
  const [newTriggerOffset, setNewTriggerOffset] = React44.useState(null);
  const currentContainerRef = React44.useRef(null);
  const previousContainerRef = React44.useRef(null);
  const onAnimationsFinished = useAnimationsFinished(currentContainerRef, true, false);
  const cleanupFrame = useAnimationFrame();
  const [previousContentDimensions, setPreviousContentDimensions] = React44.useState(null);
  const [showStartingStyleAttribute, setShowStartingStyleAttribute] = React44.useState(false);
  useIsoLayoutEffect(() => {
    store.set("hasViewport", true);
    return () => {
      store.set("hasViewport", false);
    };
  }, [store]);
  const handleMeasureLayout = useStableCallback(() => {
    currentContainerRef.current?.style.setProperty("animation", "none");
    currentContainerRef.current?.style.setProperty("transition", "none");
    previousContainerRef.current?.style.setProperty("display", "none");
  });
  const handleMeasureLayoutComplete = useStableCallback((previousDimensions) => {
    currentContainerRef.current?.style.removeProperty("animation");
    currentContainerRef.current?.style.removeProperty("transition");
    previousContainerRef.current?.style.removeProperty("display");
    if (previousDimensions) {
      setPreviousContentDimensions(previousDimensions);
    }
  });
  const lastHandledTriggerRef = React44.useRef(null);
  useIsoLayoutEffect(() => {
    if (!open || !mounted) {
      lastHandledTriggerRef.current = null;
    }
  }, [open, mounted]);
  useIsoLayoutEffect(() => {
    if (activeTrigger && previousActiveTrigger && activeTrigger !== previousActiveTrigger && lastHandledTriggerRef.current !== activeTrigger && capturedNodeRef.current) {
      setPreviousContentNode(capturedNodeRef.current);
      setShowStartingStyleAttribute(true);
      const offset4 = calculateRelativePosition(previousActiveTrigger, activeTrigger);
      setNewTriggerOffset(offset4);
      cleanupFrame.request(() => {
        ReactDOM7.flushSync(() => {
          setShowStartingStyleAttribute(false);
        });
        onAnimationsFinished(() => {
          setPreviousContentNode(null);
          setPreviousContentDimensions(null);
          capturedNodeRef.current = null;
        });
      });
      lastHandledTriggerRef.current = activeTrigger;
    }
  }, [activeTrigger, previousActiveTrigger, previousContentNode, onAnimationsFinished, cleanupFrame]);
  useIsoLayoutEffect(() => {
    const source = currentContainerRef.current;
    if (!source) {
      return;
    }
    const wrapper = ownerDocument(source).createElement("div");
    for (const child of Array.from(source.childNodes)) {
      wrapper.appendChild(child.cloneNode(true));
    }
    capturedNodeRef.current = wrapper;
  });
  const isTransitioning = previousContentNode != null;
  let childrenToRender;
  if (!isTransitioning) {
    childrenToRender = /* @__PURE__ */ (0, import_jsx_runtime7.jsx)("div", {
      "data-current": true,
      ref: currentContainerRef,
      children
    }, currentContentKey);
  } else {
    childrenToRender = /* @__PURE__ */ (0, import_jsx_runtime7.jsxs)(React44.Fragment, {
      children: [/* @__PURE__ */ (0, import_jsx_runtime7.jsx)("div", {
        "data-previous": true,
        inert: inertValue(true),
        ref: previousContainerRef,
        style: {
          ...previousContentDimensions ? {
            [cssVars.popupWidth]: `${previousContentDimensions.width}px`,
            [cssVars.popupHeight]: `${previousContentDimensions.height}px`
          } : null,
          position: "absolute"
        },
        "data-ending-style": showStartingStyleAttribute ? void 0 : ""
      }, "previous"), /* @__PURE__ */ (0, import_jsx_runtime7.jsx)("div", {
        "data-current": true,
        ref: currentContainerRef,
        "data-starting-style": showStartingStyleAttribute ? "" : void 0,
        children
      }, currentContentKey)]
    });
  }
  useIsoLayoutEffect(() => {
    const container = previousContainerRef.current;
    if (!container || !previousContentNode) {
      return;
    }
    container.replaceChildren(...Array.from(previousContentNode.childNodes));
  }, [previousContentNode]);
  usePopupAutoResize({
    popupElement,
    positionerElement,
    mounted,
    content: payload,
    onMeasureLayout: handleMeasureLayout,
    onMeasureLayoutComplete: handleMeasureLayoutComplete,
    side,
    direction
  });
  const state = {
    activationDirection: getActivationDirection(newTriggerOffset),
    transitioning: isTransitioning
  };
  return {
    children: childrenToRender,
    state
  };
}
function getActivationDirection(offset4) {
  if (!offset4) {
    return void 0;
  }
  return `${getValueWithTolerance(offset4.horizontal, 5, "right", "left")} ${getValueWithTolerance(offset4.vertical, 5, "down", "up")}`;
}
function getValueWithTolerance(value, tolerance, positiveLabel, negativeLabel) {
  if (value > tolerance) {
    return positiveLabel;
  }
  if (value < -tolerance) {
    return negativeLabel;
  }
  return "";
}
function calculateRelativePosition(from, to) {
  const fromRect = from.getBoundingClientRect();
  const toRect = to.getBoundingClientRect();
  const fromCenter = {
    x: fromRect.left + fromRect.width / 2,
    y: fromRect.top + fromRect.height / 2
  };
  const toCenter = {
    x: toRect.left + toRect.width / 2,
    y: toRect.top + toRect.height / 2
  };
  return {
    horizontal: toCenter.x - fromCenter.x,
    vertical: toCenter.y - fromCenter.y
  };
}
function usePopupContentKey(activeTriggerId, payload) {
  const [contentKey, setContentKey] = React44.useState(0);
  const previousActiveTriggerIdRef = React44.useRef(activeTriggerId);
  const previousPayloadRef = React44.useRef(payload);
  const pendingPayloadUpdateRef = React44.useRef(false);
  useIsoLayoutEffect(() => {
    const previousActiveTriggerId = previousActiveTriggerIdRef.current;
    const previousPayload = previousPayloadRef.current;
    const triggerIdChanged = activeTriggerId !== previousActiveTriggerId;
    const payloadChanged = payload !== previousPayload;
    if (triggerIdChanged) {
      setContentKey((value) => value + 1);
      pendingPayloadUpdateRef.current = !payloadChanged;
    } else if (pendingPayloadUpdateRef.current && payloadChanged) {
      setContentKey((value) => value + 1);
      pendingPayloadUpdateRef.current = false;
    }
    previousActiveTriggerIdRef.current = activeTriggerId;
    previousPayloadRef.current = payload;
  }, [activeTriggerId, payload]);
  return `${activeTriggerId ?? "current"}-${contentKey}`;
}

// node_modules/@base-ui/react/popover/index.parts.mjs
var index_parts_exports = {};
__export(index_parts_exports, {
  Arrow: () => PopoverArrow,
  Backdrop: () => PopoverBackdrop,
  Close: () => PopoverClose,
  Description: () => PopoverDescription,
  Handle: () => PopoverHandle,
  Popup: () => PopoverPopup,
  Portal: () => PopoverPortal,
  Positioner: () => PopoverPositioner,
  Root: () => PopoverRoot,
  Title: () => PopoverTitle,
  Trigger: () => PopoverTrigger,
  Viewport: () => PopoverViewport,
  createHandle: () => createPopoverHandle
});

// node_modules/@base-ui/react/popover/root/PopoverRoot.mjs
var React47 = __toESM(require_react(), 1);

// node_modules/@base-ui/react/popover/root/PopoverRootContext.mjs
var React45 = __toESM(require_react(), 1);
var PopoverRootContext = /* @__PURE__ */ React45.createContext(void 0);
if (true) PopoverRootContext.displayName = "PopoverRootContext";
function usePopoverRootContext(optional) {
  const context = React45.useContext(PopoverRootContext);
  if (context === void 0 && !optional) {
    throw new Error(true ? "Base UI: PopoverRootContext is missing. Popover parts must be placed within <Popover.Root>." : formatErrorMessage_default(47));
  }
  return context;
}

// node_modules/@base-ui/react/popover/store/PopoverStore.mjs
var React46 = __toESM(require_react(), 1);
var ReactDOM8 = __toESM(require_react_dom(), 1);
function createInitialState() {
  return {
    ...createInitialPopupStoreState(),
    disabled: false,
    modal: false,
    focusManagerModal: false,
    instantType: void 0,
    openMethod: null,
    openChangeReason: null,
    titleElementId: void 0,
    descriptionElementId: void 0,
    stickIfOpen: true,
    nested: false,
    openOnHover: false,
    closeDelay: 0,
    hasViewport: false
  };
}
var selectors2 = {
  ...popupStoreSelectors,
  disabled: createSelector((state) => state.disabled),
  instantType: createSelector((state) => state.instantType),
  openMethod: createSelector((state) => state.openMethod),
  openChangeReason: createSelector((state) => state.openChangeReason),
  modal: createSelector((state) => state.modal),
  focusManagerModal: createSelector((state) => state.focusManagerModal),
  stickIfOpen: createSelector((state) => state.stickIfOpen),
  titleElementId: createSelector((state) => state.titleElementId),
  descriptionElementId: createSelector((state) => state.descriptionElementId),
  openOnHover: createSelector((state) => state.openOnHover),
  closeDelay: createSelector((state) => state.closeDelay),
  hasViewport: createSelector((state) => state.hasViewport)
};
var PopoverStore = class _PopoverStore extends ReactStore {
  constructor(initialState, floatingId, nested = false) {
    const initial2 = {
      ...createInitialState(),
      ...initialState
    };
    const triggerElements = new PopupTriggerMap();
    if (initial2.open && initialState?.mounted === void 0) {
      initial2.mounted = true;
    }
    initial2.floatingRootContext = createPopupFloatingRootContext(triggerElements, floatingId, nested);
    super(initial2, {
      popupRef: /* @__PURE__ */ React46.createRef(),
      backdropRef: /* @__PURE__ */ React46.createRef(),
      internalBackdropRef: /* @__PURE__ */ React46.createRef(),
      onOpenChange: void 0,
      onOpenChangeComplete: void 0,
      triggerFocusTargetRef: /* @__PURE__ */ React46.createRef(),
      beforeContentFocusGuardRef: /* @__PURE__ */ React46.createRef(),
      stickIfOpenTimeout: new Timeout(),
      triggerElements
    }, selectors2);
  }
  setOpen = (nextOpen, eventDetails) => {
    const isHover = eventDetails.reason === reason_parts_exports.triggerHover;
    const isKeyboardClick = eventDetails.reason === reason_parts_exports.triggerPress && eventDetails.event.detail === 0;
    const isDismissClose = !nextOpen && (eventDetails.reason === reason_parts_exports.escapeKey || eventDetails.reason == null);
    const shouldPreventUnmountOnClose = attachPreventUnmountOnClose(eventDetails);
    const activeTriggerId = this.select("activeTriggerId");
    if (!nextOpen && eventDetails.reason === reason_parts_exports.closePress && eventDetails.trigger == null && activeTriggerId != null) {
      eventDetails.trigger = this.context.triggerElements.getById(activeTriggerId) ?? this.select("activeTriggerElement") ?? void 0;
    }
    this.context.onOpenChange?.(nextOpen, eventDetails);
    if (eventDetails.isCanceled) {
      return;
    }
    this.state.floatingRootContext.dispatchOpenChange(nextOpen, eventDetails);
    const changeState = () => {
      const updatedState = {
        open: nextOpen,
        openChangeReason: eventDetails.reason
      };
      setPopupOpenState(updatedState, nextOpen, eventDetails.trigger, shouldPreventUnmountOnClose());
      this.update(updatedState);
    };
    if (isHover) {
      this.set("stickIfOpen", true);
      this.context.stickIfOpenTimeout.start(PATIENT_CLICK_THRESHOLD, () => {
        this.set("stickIfOpen", false);
      });
      ReactDOM8.flushSync(changeState);
    } else {
      changeState();
    }
    if (isKeyboardClick || isDismissClose) {
      this.set("instantType", isKeyboardClick ? "click" : "dismiss");
    } else if (eventDetails.reason === reason_parts_exports.focusOut) {
      this.set("instantType", "focus");
    } else {
      this.set("instantType", void 0);
    }
  };
  static useStore(externalStore, initialState) {
    const {
      store,
      internalStore
    } = usePopupStore(externalStore, (floatingId, nested) => new _PopoverStore(initialState, floatingId, nested));
    React46.useEffect(() => internalStore?.disposeEffect(), [internalStore]);
    return store;
  }
  disposeEffect = () => {
    return this.context.stickIfOpenTimeout.disposeEffect();
  };
};

// node_modules/@base-ui/react/popover/root/PopoverRoot.mjs
var import_jsx_runtime8 = __toESM(require_jsx_runtime(), 1);
function PopoverRootComponent({
  props
}) {
  const {
    children,
    open: openProp,
    defaultOpen = false,
    onOpenChange,
    onOpenChangeComplete,
    modal = false,
    handle,
    triggerId: triggerIdProp,
    defaultTriggerId: defaultTriggerIdProp = null
  } = props;
  const store = PopoverStore.useStore(handle?.store, {
    modal,
    open: defaultOpen,
    openProp,
    activeTriggerId: defaultTriggerIdProp,
    triggerIdProp
  });
  useInitialOpenSync(store, openProp, defaultOpen, defaultTriggerIdProp);
  store.useControlledProp("openProp", openProp);
  store.useControlledProp("triggerIdProp", triggerIdProp);
  const open = store.useState("open");
  const mounted = store.useState("mounted");
  const payload = store.useState("payload");
  const nested = useFloatingParentNodeId() != null;
  store.useContextCallback("onOpenChange", onOpenChange);
  store.useContextCallback("onOpenChangeComplete", onOpenChangeComplete);
  usePopupRootSync(store, open);
  useImplicitActiveTrigger(store);
  const {
    forceUnmount
  } = useOpenStateTransitions(open, store, () => {
    store.update({
      stickIfOpen: true,
      openChangeReason: null
    });
  });
  store.useSyncedValues({
    modal,
    nested
  });
  React47.useEffect(() => {
    if (!open) {
      store.context.stickIfOpenTimeout.clear();
    }
  }, [store, open]);
  const handleImperativeClose = React47.useCallback(() => {
    store.setOpen(false, createChangeEventDetails(reason_parts_exports.imperativeAction));
  }, [store]);
  React47.useImperativeHandle(props.actionsRef, () => ({
    unmount: forceUnmount,
    close: handleImperativeClose
  }), [forceUnmount, handleImperativeClose]);
  const shouldRenderInteractions = open || mounted;
  const popoverContext = React47.useMemo(() => ({
    store
  }), [store]);
  return /* @__PURE__ */ (0, import_jsx_runtime8.jsxs)(PopoverRootContext.Provider, {
    value: popoverContext,
    children: [shouldRenderInteractions && /* @__PURE__ */ (0, import_jsx_runtime8.jsx)(PopoverInteractions, {
      store,
      modal
    }), typeof children === "function" ? children({
      payload
    }) : children]
  });
}
function PopoverRoot(props) {
  if (usePopoverRootContext(true)) {
    return /* @__PURE__ */ (0, import_jsx_runtime8.jsx)(PopoverRootComponent, {
      props
    });
  }
  return /* @__PURE__ */ (0, import_jsx_runtime8.jsx)(FloatingTree, {
    children: /* @__PURE__ */ (0, import_jsx_runtime8.jsx)(PopoverRootComponent, {
      props
    })
  });
}
function PopoverInteractions({
  store,
  modal
}) {
  const floatingRootContext = store.useState("floatingRootContext");
  const dismiss = useDismiss(floatingRootContext, {
    outsidePressEvent: {
      // Ensure `aria-hidden` on outside elements is removed immediately
      // on outside press when trapping focus.
      mouse: modal === "trap-focus" ? "sloppy" : "intentional",
      touch: "sloppy"
    }
  });
  const activeTriggerProps = dismiss.reference ?? EMPTY_OBJECT;
  const inactiveTriggerProps = dismiss.trigger ?? EMPTY_OBJECT;
  const popupProps = React47.useMemo(() => mergeProps(FOCUSABLE_POPUP_PROPS, dismiss.floating), [dismiss.floating]);
  usePopupInteractionProps(store, {
    activeTriggerProps,
    inactiveTriggerProps,
    popupProps
  });
  return null;
}

// node_modules/@base-ui/react/popover/trigger/PopoverTrigger.mjs
var React48 = __toESM(require_react(), 1);

// node_modules/@base-ui/react/popover/utils/constants.mjs
var OPEN_DELAY = 300;

// node_modules/@base-ui/react/popover/trigger/PopoverTrigger.mjs
var import_jsx_runtime9 = __toESM(require_jsx_runtime(), 1);
var PopoverTrigger = /* @__PURE__ */ React48.forwardRef(function PopoverTrigger2(componentProps, forwardedRef) {
  const {
    render,
    className,
    style,
    disabled: disabled2 = false,
    nativeButton = true,
    handle,
    payload,
    openOnHover = false,
    delay = OPEN_DELAY,
    closeDelay = 0,
    id: idProp,
    ...elementProps
  } = componentProps;
  const rootContext = usePopoverRootContext(true);
  const store = handle?.store ?? rootContext?.store;
  if (!store) {
    throw new Error(true ? "Base UI: <Popover.Trigger> must be either used within a <Popover.Root> component or provided with a handle." : formatErrorMessage_default(74));
  }
  const thisTriggerId = useBaseUiId(idProp);
  const isTriggerActive = store.useState("isTriggerActive", thisTriggerId);
  const floatingContext = store.useState("floatingRootContext");
  const isOpenedByThisTrigger = store.useState("isOpenedByTrigger", thisTriggerId);
  const popupId = store.useState("triggerPopupId", thisTriggerId);
  const triggerElementRef = React48.useRef(null);
  const {
    registerTrigger,
    isMountedByThisTrigger
  } = useTriggerDataForwarding(thisTriggerId, triggerElementRef, store, {
    payload,
    disabled: disabled2,
    openOnHover,
    closeDelay
  });
  const openReason = store.useState("openChangeReason");
  const stickIfOpen = store.useState("stickIfOpen");
  const openMethod = store.useState("openMethod");
  const focusManagerModal = store.useState("focusManagerModal");
  const hoverProps = useHoverReferenceInteraction(floatingContext, {
    enabled: !disabled2 && floatingContext != null && openOnHover && (openMethod !== "touch" || openReason !== reason_parts_exports.triggerPress),
    mouseOnly: true,
    move: false,
    handleClose: safePolygon(),
    restMs: delay,
    delay: {
      close: closeDelay
    },
    triggerElementRef,
    isActiveTrigger: isTriggerActive,
    isClosing: () => store.select("transitionStatus") === "ending"
  });
  const click = useClick(floatingContext, {
    enabled: floatingContext != null,
    stickIfOpen
  });
  const interactionTypeProps = useOpenMethodTriggerProps(() => store.select("open"), (interactionType) => {
    store.set("openMethod", interactionType);
  });
  const rootTriggerProps = store.useState("triggerProps", isMountedByThisTrigger);
  const {
    getButtonProps,
    buttonRef
  } = useButton({
    disabled: disabled2,
    native: nativeButton
  });
  const stateAttributesMapping6 = {
    open(value) {
      if (value && openReason === reason_parts_exports.triggerPress) {
        return pressableTriggerOpenStateMapping.open(value);
      }
      return triggerOpenStateMapping.open(value);
    }
  };
  const {
    preFocusGuardRef,
    handlePreFocusGuardFocus,
    handleFocusTargetFocus
  } = useTriggerFocusGuards(store, triggerElementRef);
  const state = {
    disabled: disabled2,
    open: isOpenedByThisTrigger
  };
  const element = useRenderElement("button", componentProps, {
    state,
    ref: [buttonRef, forwardedRef, registerTrigger, triggerElementRef],
    props: [click.reference, hoverProps, rootTriggerProps, interactionTypeProps, {
      [CLICK_TRIGGER_IDENTIFIER]: "",
      id: thisTriggerId,
      "aria-haspopup": "dialog",
      "aria-expanded": isOpenedByThisTrigger,
      "aria-controls": popupId
    }, elementProps, getButtonProps],
    stateAttributesMapping: stateAttributesMapping6
  });
  if (isMountedByThisTrigger && !focusManagerModal) {
    return /* @__PURE__ */ (0, import_jsx_runtime9.jsxs)(React48.Fragment, {
      children: [/* @__PURE__ */ (0, import_jsx_runtime9.jsx)(FocusGuard, {
        ref: preFocusGuardRef,
        onFocus: handlePreFocusGuardFocus
      }), /* @__PURE__ */ (0, import_jsx_runtime9.jsx)(React48.Fragment, {
        children: element
      }, thisTriggerId), /* @__PURE__ */ (0, import_jsx_runtime9.jsx)(FocusGuard, {
        ref: store.context.triggerFocusTargetRef,
        onFocus: handleFocusTargetFocus
      })]
    });
  }
  return /* @__PURE__ */ (0, import_jsx_runtime9.jsx)(React48.Fragment, {
    children: element
  }, thisTriggerId);
});
if (true) PopoverTrigger.displayName = "PopoverTrigger";

// node_modules/@base-ui/react/popover/portal/PopoverPortal.mjs
var React50 = __toESM(require_react(), 1);

// node_modules/@base-ui/react/popover/portal/PopoverPortalContext.mjs
var React49 = __toESM(require_react(), 1);
var PopoverPortalContext = /* @__PURE__ */ React49.createContext(void 0);
if (true) PopoverPortalContext.displayName = "PopoverPortalContext";
function usePopoverPortalContext() {
  const value = React49.useContext(PopoverPortalContext);
  if (value === void 0) {
    throw new Error(true ? "Base UI: <Popover.Portal> is missing." : formatErrorMessage_default(45));
  }
  return value;
}

// node_modules/@base-ui/react/popover/portal/PopoverPortal.mjs
var import_jsx_runtime10 = __toESM(require_jsx_runtime(), 1);
var PopoverPortal = /* @__PURE__ */ React50.forwardRef(function PopoverPortal2(props, forwardedRef) {
  const {
    keepMounted = false,
    ...portalProps
  } = props;
  const {
    store
  } = usePopoverRootContext();
  const mounted = store.useState("mounted");
  const shouldRender = mounted || keepMounted;
  if (!shouldRender) {
    return null;
  }
  return /* @__PURE__ */ (0, import_jsx_runtime10.jsx)(PopoverPortalContext.Provider, {
    value: keepMounted,
    children: /* @__PURE__ */ (0, import_jsx_runtime10.jsx)(FloatingPortal, {
      ref: forwardedRef,
      ...portalProps
    })
  });
});
if (true) PopoverPortal.displayName = "PopoverPortal";

// node_modules/@base-ui/react/popover/positioner/PopoverPositioner.mjs
var React52 = __toESM(require_react(), 1);

// node_modules/@base-ui/react/popover/positioner/PopoverPositionerContext.mjs
var React51 = __toESM(require_react(), 1);
var PopoverPositionerContext = /* @__PURE__ */ React51.createContext(void 0);
if (true) PopoverPositionerContext.displayName = "PopoverPositionerContext";
function usePopoverPositionerContext() {
  const context = React51.useContext(PopoverPositionerContext);
  if (!context) {
    throw new Error(true ? "Base UI: PopoverPositionerContext is missing. PopoverPositioner parts must be placed within <Popover.Positioner>." : formatErrorMessage_default(46));
  }
  return context;
}

// node_modules/@base-ui/react/popover/positioner/PopoverPositioner.mjs
var import_jsx_runtime11 = __toESM(require_jsx_runtime(), 1);
var PopoverPositioner = /* @__PURE__ */ React52.forwardRef(function PopoverPositioner2(componentProps, forwardedRef) {
  const {
    render,
    className,
    style,
    anchor,
    positionMethod = "absolute",
    side = "bottom",
    align = "center",
    sideOffset = 0,
    alignOffset = 0,
    collisionBoundary = "clipping-ancestors",
    collisionPadding = 5,
    arrowPadding = 5,
    sticky = false,
    disableAnchorTracking = false,
    collisionAvoidance = POPUP_COLLISION_AVOIDANCE,
    ...elementProps
  } = componentProps;
  const {
    store
  } = usePopoverRootContext();
  const keepMounted = usePopoverPortalContext();
  const nodeId = useFloatingNodeId();
  const floatingRootContext = store.useState("floatingRootContext");
  const mounted = store.useState("mounted");
  const open = store.useState("open");
  const openReason = store.useState("openChangeReason");
  const triggerElement = store.useState("activeTriggerElement");
  const modal = store.useState("modal");
  const openMethod = store.useState("openMethod");
  const positionerElement = store.useState("positionerElement");
  const instantType = store.useState("instantType");
  const transitionStatus = store.useState("transitionStatus");
  const hasViewport = store.useState("hasViewport");
  const prevTriggerElementRef = React52.useRef(null);
  const runOnceAnimationsFinish = useAnimationsFinished(positionerElement, false, false);
  const positioning = useAnchorPositioning({
    anchor,
    floatingRootContext,
    positionMethod,
    mounted,
    side,
    sideOffset,
    align,
    alignOffset,
    arrowPadding,
    collisionBoundary,
    collisionPadding,
    sticky,
    disableAnchorTracking,
    keepMounted,
    nodeId,
    collisionAvoidance,
    adaptiveOrigin: hasViewport ? adaptiveOrigin : void 0
  });
  const domReference = floatingRootContext.useState("domReferenceElement");
  useIsoLayoutEffect(() => {
    const currentTriggerElement = domReference;
    const prevTriggerElement = prevTriggerElementRef.current;
    if (currentTriggerElement) {
      prevTriggerElementRef.current = currentTriggerElement;
    }
    if (prevTriggerElement && currentTriggerElement && currentTriggerElement !== prevTriggerElement) {
      store.set("instantType", void 0);
      const ac = new AbortController();
      runOnceAnimationsFinish(() => {
        store.set("instantType", "trigger-change");
      }, ac.signal);
      return () => {
        ac.abort();
      };
    }
    return void 0;
  }, [domReference, runOnceAnimationsFinish, store]);
  useAnchoredPopupScrollLock(open && modal === true && openReason !== reason_parts_exports.triggerHover, openMethod === "touch", positionerElement, triggerElement);
  const setPositionerElement = React52.useCallback((element2) => {
    store.set("positionerElement", element2);
  }, [store]);
  const state = {
    open,
    side: positioning.side,
    align: positioning.align,
    anchorHidden: positioning.anchorHidden,
    instant: instantType
  };
  const element = usePositioner(componentProps, state, {
    styles: positioning.positionerStyles,
    transitionStatus,
    props: elementProps,
    refs: [forwardedRef, setPositionerElement],
    hidden: !mounted,
    inert: !open
  });
  return /* @__PURE__ */ (0, import_jsx_runtime11.jsxs)(PopoverPositionerContext.Provider, {
    value: positioning,
    children: [mounted && modal === true && openReason !== reason_parts_exports.triggerHover && /* @__PURE__ */ (0, import_jsx_runtime11.jsx)(InternalBackdrop, {
      ref: store.context.internalBackdropRef,
      inert: inertValue(!open),
      cutout: triggerElement
    }), /* @__PURE__ */ (0, import_jsx_runtime11.jsx)(FloatingNode, {
      id: nodeId,
      children: element
    })]
  });
});
if (true) PopoverPositioner.displayName = "PopoverPositioner";

// node_modules/@base-ui/react/popover/popup/PopoverPopup.mjs
var React54 = __toESM(require_react(), 1);

// node_modules/@base-ui/react/utils/closePart.mjs
var React53 = __toESM(require_react(), 1);
var import_jsx_runtime12 = __toESM(require_jsx_runtime(), 1);
var ClosePartContext = /* @__PURE__ */ React53.createContext(void 0);
if (true) ClosePartContext.displayName = "ClosePartContext";
function useClosePartCount() {
  const [closePartCount, setClosePartCount] = React53.useState(0);
  const register2 = useStableCallback(() => {
    setClosePartCount((count) => count + 1);
    return () => {
      setClosePartCount((count) => Math.max(0, count - 1));
    };
  });
  const context = React53.useMemo(() => ({
    register: register2
  }), [register2]);
  return {
    context,
    hasClosePart: closePartCount > 0
  };
}
function ClosePartProvider(props) {
  const {
    value,
    children
  } = props;
  return /* @__PURE__ */ (0, import_jsx_runtime12.jsx)(ClosePartContext.Provider, {
    value,
    children
  });
}
function useClosePartRegistration() {
  const context = React53.useContext(ClosePartContext);
  useIsoLayoutEffect(() => {
    return context?.register();
  }, [context]);
}

// node_modules/@base-ui/react/popover/popup/PopoverPopup.mjs
var import_jsx_runtime13 = __toESM(require_jsx_runtime(), 1);
var stateAttributesMapping = {
  ...popupStateMapping,
  ...transitionStatusMapping
};
var PopoverPopup = /* @__PURE__ */ React54.forwardRef(function PopoverPopup2(componentProps, forwardedRef) {
  const {
    render,
    className,
    style,
    initialFocus,
    finalFocus,
    ...elementProps
  } = componentProps;
  const {
    store
  } = usePopoverRootContext();
  const positioner = usePopoverPositionerContext();
  const insideToolbar = useToolbarRootContext(true) != null;
  const {
    context: closePartContext,
    hasClosePart
  } = useClosePartCount();
  const open = store.useState("open");
  const openMethod = store.useState("openMethod");
  const instantType = store.useState("instantType");
  const transitionStatus = store.useState("transitionStatus");
  const popupProps = store.useState("popupProps");
  const titleId = store.useState("titleElementId");
  const descriptionId = store.useState("descriptionElementId");
  const modal = store.useState("modal");
  const mounted = store.useState("mounted");
  const openReason = store.useState("openChangeReason");
  const activeTriggerElement = store.useState("activeTriggerElement");
  const floatingContext = store.useState("floatingRootContext");
  const floatingId = floatingContext.useState("floatingId");
  const disabled2 = store.useState("disabled");
  const openOnHover = store.useState("openOnHover");
  const closeDelay = store.useState("closeDelay");
  const popupId = elementProps.id ?? floatingId;
  useOpenChangeComplete({
    open,
    ref: store.context.popupRef,
    onComplete() {
      if (open) {
        store.context.onOpenChangeComplete?.(true);
      }
    }
  });
  useHoverFloatingInteraction(floatingContext, {
    enabled: openOnHover && !disabled2,
    closeDelay
  });
  const resolvedInitialFocus = initialFocus === void 0 ? createDefaultInitialFocus(store.context.popupRef) : initialFocus;
  const focusManagerModal = modal !== false && hasClosePart;
  store.useSyncedValue("focusManagerModal", focusManagerModal);
  const setPopupElement = React54.useCallback((element2) => {
    store.set("popupElement", element2);
  }, [store]);
  const state = {
    open,
    side: positioner.side,
    align: positioner.align,
    instant: instantType,
    transitionStatus
  };
  const element = useRenderElement("div", componentProps, {
    state,
    ref: [forwardedRef, store.context.popupRef, setPopupElement],
    props: [popupProps, {
      id: popupId,
      role: "dialog",
      ...FOCUSABLE_POPUP_PROPS,
      "aria-labelledby": titleId,
      "aria-describedby": descriptionId,
      onKeyDown(event) {
        if (insideToolbar && COMPOSITE_KEYS.has(event.key)) {
          event.stopPropagation();
        }
      }
    }, getDisabledMountTransitionStyles(transitionStatus), elementProps],
    stateAttributesMapping
  });
  return /* @__PURE__ */ (0, import_jsx_runtime13.jsx)(FloatingFocusManager, {
    context: floatingContext,
    openInteractionType: openMethod,
    modal: focusManagerModal,
    disabled: !mounted || openReason === reason_parts_exports.triggerHover,
    initialFocus: resolvedInitialFocus,
    returnFocus: finalFocus,
    restoreFocus: "popup",
    previousFocusableElement: isHTMLElement(activeTriggerElement) ? activeTriggerElement : void 0,
    nextFocusableElement: store.context.triggerFocusTargetRef,
    beforeContentFocusGuardRef: store.context.beforeContentFocusGuardRef,
    children: /* @__PURE__ */ (0, import_jsx_runtime13.jsx)(ClosePartProvider, {
      value: closePartContext,
      children: element
    })
  });
});
if (true) PopoverPopup.displayName = "PopoverPopup";

// node_modules/@base-ui/react/popover/arrow/PopoverArrow.mjs
var React55 = __toESM(require_react(), 1);
var PopoverArrow = /* @__PURE__ */ React55.forwardRef(function PopoverArrow2(componentProps, forwardedRef) {
  const {
    render,
    className,
    style,
    ...elementProps
  } = componentProps;
  const {
    store
  } = usePopoverRootContext();
  const open = store.useState("open");
  const {
    arrowRef,
    side,
    align,
    arrowUncentered,
    arrowStyles
  } = usePopoverPositionerContext();
  const state = {
    open,
    side,
    align,
    uncentered: arrowUncentered
  };
  const element = useRenderElement("div", componentProps, {
    state,
    ref: [forwardedRef, arrowRef],
    props: [{
      style: arrowStyles,
      "aria-hidden": true
    }, elementProps],
    stateAttributesMapping: popupStateMapping
  });
  return element;
});
if (true) PopoverArrow.displayName = "PopoverArrow";

// node_modules/@base-ui/react/popover/backdrop/PopoverBackdrop.mjs
var React56 = __toESM(require_react(), 1);
var stateAttributesMapping2 = {
  ...popupStateMapping,
  ...transitionStatusMapping
};
var PopoverBackdrop = /* @__PURE__ */ React56.forwardRef(function PopoverBackdrop2(props, forwardedRef) {
  const {
    render,
    className,
    style,
    ...elementProps
  } = props;
  const {
    store
  } = usePopoverRootContext();
  const open = store.useState("open");
  const mounted = store.useState("mounted");
  const transitionStatus = store.useState("transitionStatus");
  const openReason = store.useState("openChangeReason");
  const state = {
    open,
    transitionStatus
  };
  const element = useRenderElement("div", props, {
    state,
    ref: [store.context.backdropRef, forwardedRef],
    props: [{
      role: "presentation",
      hidden: !mounted,
      style: {
        pointerEvents: openReason === reason_parts_exports.triggerHover ? "none" : void 0,
        userSelect: "none",
        WebkitUserSelect: "none"
      }
    }, elementProps],
    stateAttributesMapping: stateAttributesMapping2
  });
  return element;
});
if (true) PopoverBackdrop.displayName = "PopoverBackdrop";

// node_modules/@base-ui/react/popover/title/PopoverTitle.mjs
var React57 = __toESM(require_react(), 1);
var PopoverTitle = /* @__PURE__ */ React57.forwardRef(function PopoverTitle2(componentProps, forwardedRef) {
  const {
    render,
    className,
    style,
    ...elementProps
  } = componentProps;
  const {
    store
  } = usePopoverRootContext();
  const id = useBaseUiId(elementProps.id);
  store.useSyncedValueWithCleanup("titleElementId", id);
  const element = useRenderElement("h2", componentProps, {
    ref: forwardedRef,
    props: [{
      id
    }, elementProps]
  });
  return element;
});
if (true) PopoverTitle.displayName = "PopoverTitle";

// node_modules/@base-ui/react/popover/description/PopoverDescription.mjs
var React58 = __toESM(require_react(), 1);
var PopoverDescription = /* @__PURE__ */ React58.forwardRef(function PopoverDescription2(componentProps, forwardedRef) {
  const {
    render,
    className,
    style,
    ...elementProps
  } = componentProps;
  const {
    store
  } = usePopoverRootContext();
  const id = useBaseUiId(elementProps.id);
  store.useSyncedValueWithCleanup("descriptionElementId", id);
  const element = useRenderElement("p", componentProps, {
    ref: forwardedRef,
    props: [{
      id
    }, elementProps]
  });
  return element;
});
if (true) PopoverDescription.displayName = "PopoverDescription";

// node_modules/@base-ui/react/popover/close/PopoverClose.mjs
var React59 = __toESM(require_react(), 1);
var PopoverClose = /* @__PURE__ */ React59.forwardRef(function PopoverClose2(componentProps, forwardedRef) {
  const {
    render,
    className,
    style,
    disabled: disabled2 = false,
    nativeButton = true,
    ...elementProps
  } = componentProps;
  const {
    buttonRef,
    getButtonProps
  } = useButton({
    disabled: disabled2,
    focusableWhenDisabled: false,
    native: nativeButton
  });
  const {
    store
  } = usePopoverRootContext();
  useClosePartRegistration();
  const element = useRenderElement("button", componentProps, {
    ref: [forwardedRef, buttonRef],
    props: [{
      onClick(event) {
        store.setOpen(false, createChangeEventDetails(reason_parts_exports.closePress, event.nativeEvent));
      }
    }, elementProps, getButtonProps]
  });
  return element;
});
if (true) PopoverClose.displayName = "PopoverClose";

// node_modules/@base-ui/react/popover/viewport/PopoverViewport.mjs
var React60 = __toESM(require_react(), 1);

// node_modules/@base-ui/react/popover/viewport/PopoverViewportCssVars.mjs
var PopoverViewportCssVars = /* @__PURE__ */ (function(PopoverViewportCssVars2) {
  PopoverViewportCssVars2["popupWidth"] = "--popup-width";
  PopoverViewportCssVars2["popupHeight"] = "--popup-height";
  return PopoverViewportCssVars2;
})({});

// node_modules/@base-ui/react/popover/viewport/PopoverViewport.mjs
var stateAttributesMapping3 = {
  activationDirection: (value) => value ? {
    "data-activation-direction": value
  } : null
};
var PopoverViewport = /* @__PURE__ */ React60.forwardRef(function PopoverViewport2(componentProps, forwardedRef) {
  const {
    render,
    className,
    style,
    children,
    ...elementProps
  } = componentProps;
  const {
    store
  } = usePopoverRootContext();
  const {
    side
  } = usePopoverPositionerContext();
  const instantType = store.useState("instantType");
  const {
    children: childrenToRender,
    state: viewportState
  } = usePopupViewport({
    store,
    side,
    cssVars: PopoverViewportCssVars,
    children
  });
  const state = {
    activationDirection: viewportState.activationDirection,
    transitioning: viewportState.transitioning,
    instant: instantType
  };
  return useRenderElement("div", componentProps, {
    state,
    ref: forwardedRef,
    props: [elementProps, {
      children: childrenToRender
    }],
    stateAttributesMapping: stateAttributesMapping3
  });
});
if (true) PopoverViewport.displayName = "PopoverViewport";

// node_modules/@base-ui/react/popover/store/PopoverHandle.mjs
var PopoverHandle = class {
  /**
   * Internal store holding the popover's state.
   * @internal
   */
  constructor() {
    this.store = new PopoverStore();
  }
  /**
   * Opens the popover and associates it with the trigger with the given id.
   * The trigger must be a Popover.Trigger component with this handle passed as a prop.
   *
   * @param triggerId ID of the trigger to associate with the popover.
   */
  open(triggerId) {
    const triggerElement = triggerId ? this.store.context.triggerElements.getById(triggerId) ?? void 0 : void 0;
    if (triggerId && !triggerElement) {
      throw new Error(true ? `Base UI: PopoverHandle.open: No trigger found with id "${triggerId}".` : formatErrorMessage_default(80, triggerId));
    }
    this.store.setOpen(true, createChangeEventDetails(reason_parts_exports.imperativeAction, void 0, triggerElement));
  }
  /**
   * Closes the popover.
   */
  close() {
    this.store.setOpen(false, createChangeEventDetails(reason_parts_exports.imperativeAction, void 0, void 0));
  }
  /**
   * Indicates whether the popover is currently open.
   */
  get isOpen() {
    return this.store.select("open");
  }
};
function createPopoverHandle() {
  return new PopoverHandle();
}

// node_modules/@base-ui/react/utils/FloatingPortalLite.mjs
var React61 = __toESM(require_react(), 1);
var ReactDOM9 = __toESM(require_react_dom(), 1);
var import_jsx_runtime14 = __toESM(require_jsx_runtime(), 1);
var FloatingPortalLite = /* @__PURE__ */ React61.forwardRef(function FloatingPortalLite2(componentProps, forwardedRef) {
  const {
    children,
    container,
    className,
    render,
    style,
    ...elementProps
  } = componentProps;
  const {
    portalNode,
    portalSubtree
  } = useFloatingPortalNode({
    container,
    ref: forwardedRef,
    componentProps,
    elementProps
  });
  if (!portalSubtree && !portalNode) {
    return null;
  }
  return /* @__PURE__ */ (0, import_jsx_runtime14.jsxs)(React61.Fragment, {
    children: [portalSubtree, portalNode && /* @__PURE__ */ ReactDOM9.createPortal(children, portalNode)]
  });
});
if (true) FloatingPortalLite.displayName = "FloatingPortalLite";

// node_modules/@base-ui/react/tooltip/index.parts.mjs
var index_parts_exports2 = {};
__export(index_parts_exports2, {
  Arrow: () => TooltipArrow,
  Handle: () => TooltipHandle,
  Popup: () => TooltipPopup,
  Portal: () => TooltipPortal,
  Positioner: () => TooltipPositioner,
  Provider: () => TooltipProvider,
  Root: () => TooltipRoot,
  Trigger: () => TooltipTrigger,
  Viewport: () => TooltipViewport,
  createHandle: () => createTooltipHandle
});

// node_modules/@base-ui/react/tooltip/root/TooltipRoot.mjs
var React64 = __toESM(require_react(), 1);

// node_modules/@base-ui/react/tooltip/root/TooltipRootContext.mjs
var React62 = __toESM(require_react(), 1);
var TooltipRootContext = /* @__PURE__ */ React62.createContext(void 0);
if (true) TooltipRootContext.displayName = "TooltipRootContext";
function useTooltipRootContext(optional) {
  const context = React62.useContext(TooltipRootContext);
  if (context === void 0 && !optional) {
    throw new Error(true ? "Base UI: TooltipRootContext is missing. Tooltip parts must be placed within <Tooltip.Root>." : formatErrorMessage_default(72));
  }
  return context;
}

// node_modules/@base-ui/react/tooltip/store/TooltipStore.mjs
var React63 = __toESM(require_react(), 1);
var selectors3 = {
  ...popupStoreSelectors,
  disabled: createSelector((state) => state.disabled),
  instantType: createSelector((state) => state.instantType),
  isInstantPhase: createSelector((state) => state.isInstantPhase),
  trackCursorAxis: createSelector((state) => state.trackCursorAxis),
  disableHoverablePopup: createSelector((state) => state.disableHoverablePopup),
  lastOpenChangeReason: createSelector((state) => state.openChangeReason),
  closeOnClick: createSelector((state) => state.closeOnClick),
  closeDelay: createSelector((state) => state.closeDelay),
  hasViewport: createSelector((state) => state.hasViewport)
};
var TooltipStore = class _TooltipStore extends ReactStore {
  constructor(initialState, floatingId, nested = false) {
    const triggerElements = new PopupTriggerMap();
    const state = {
      ...createInitialState2(),
      ...initialState
    };
    state.floatingRootContext = createPopupFloatingRootContext(triggerElements, floatingId, nested);
    super(state, {
      popupRef: /* @__PURE__ */ React63.createRef(),
      onOpenChange: void 0,
      onOpenChangeComplete: void 0,
      triggerElements
    }, selectors3);
  }
  setOpen = (nextOpen, eventDetails) => {
    applyPopupOpenChange(this, nextOpen, eventDetails, {
      extraState: {
        openChangeReason: eventDetails.reason
      }
    });
  };
  // Used by trigger clicks to clear a delayed hover open without reporting a public open-state change.
  cancelPendingOpen(event) {
    this.state.floatingRootContext.dispatchOpenChange(false, createChangeEventDetails(reason_parts_exports.triggerPress, event));
  }
  static useStore(externalStore, initialState) {
    const store = usePopupStore(externalStore, (floatingId, nested) => new _TooltipStore(initialState, floatingId, nested)).store;
    return store;
  }
};
function createInitialState2() {
  return {
    ...createInitialPopupStoreState(),
    disabled: false,
    instantType: void 0,
    isInstantPhase: false,
    trackCursorAxis: "none",
    disableHoverablePopup: false,
    openChangeReason: null,
    closeOnClick: true,
    closeDelay: 0,
    hasViewport: false
  };
}

// node_modules/@base-ui/react/tooltip/root/TooltipRoot.mjs
var import_jsx_runtime15 = __toESM(require_jsx_runtime(), 1);
var TooltipRoot = fastComponent(function TooltipRoot2(props) {
  const {
    disabled: disabled2 = false,
    defaultOpen = false,
    open: openProp,
    disableHoverablePopup = false,
    trackCursorAxis = "none",
    actionsRef,
    onOpenChange,
    onOpenChangeComplete,
    handle,
    triggerId: triggerIdProp,
    defaultTriggerId: defaultTriggerIdProp = null,
    children
  } = props;
  const store = TooltipStore.useStore(handle?.store, {
    open: defaultOpen,
    openProp,
    activeTriggerId: defaultTriggerIdProp,
    triggerIdProp
  });
  useInitialOpenSync(store, openProp, defaultOpen, defaultTriggerIdProp);
  store.useControlledProp("openProp", openProp);
  store.useControlledProp("triggerIdProp", triggerIdProp);
  store.useContextCallback("onOpenChange", onOpenChange);
  store.useContextCallback("onOpenChangeComplete", onOpenChangeComplete);
  const openState = store.useState("open");
  const open = !disabled2 && openState;
  const activeTriggerId = store.useState("activeTriggerId");
  const mounted = store.useState("mounted");
  const payload = store.useState("payload");
  store.useSyncedValues({
    trackCursorAxis,
    disableHoverablePopup
  });
  store.useSyncedValue("disabled", disabled2);
  useImplicitActiveTrigger(store, {
    closeOnActiveTriggerUnmount: true
  });
  const {
    forceUnmount,
    transitionStatus
  } = useOpenStateTransitions(open, store);
  const isInstantPhase = store.useState("isInstantPhase");
  const instantType = store.useState("instantType");
  const lastOpenChangeReason = store.useState("lastOpenChangeReason");
  const previousInstantTypeRef = React64.useRef(null);
  useIsoLayoutEffect(() => {
    if (openState && disabled2) {
      store.setOpen(false, createChangeEventDetails(reason_parts_exports.disabled));
    }
  }, [openState, disabled2, store]);
  useIsoLayoutEffect(() => {
    if (transitionStatus === "ending" && lastOpenChangeReason === reason_parts_exports.none || transitionStatus !== "ending" && isInstantPhase) {
      if (instantType !== "delay") {
        previousInstantTypeRef.current = instantType;
      }
      store.set("instantType", "delay");
    } else if (previousInstantTypeRef.current !== null) {
      store.set("instantType", previousInstantTypeRef.current);
      previousInstantTypeRef.current = null;
    }
  }, [transitionStatus, isInstantPhase, lastOpenChangeReason, instantType, store]);
  useIsoLayoutEffect(() => {
    if (open) {
      if (activeTriggerId == null) {
        store.set("payload", void 0);
      }
    }
  }, [store, activeTriggerId, open]);
  const handleImperativeClose = React64.useCallback(() => {
    store.setOpen(false, createChangeEventDetails(reason_parts_exports.imperativeAction));
  }, [store]);
  React64.useImperativeHandle(actionsRef, () => ({
    unmount: forceUnmount,
    close: handleImperativeClose
  }), [forceUnmount, handleImperativeClose]);
  const shouldRenderInteractions = open || mounted || !disabled2 && trackCursorAxis !== "none";
  return /* @__PURE__ */ (0, import_jsx_runtime15.jsxs)(TooltipRootContext.Provider, {
    value: store,
    children: [shouldRenderInteractions && /* @__PURE__ */ (0, import_jsx_runtime15.jsx)(TooltipInteractions, {
      store,
      disabled: disabled2,
      trackCursorAxis
    }), typeof children === "function" ? children({
      payload
    }) : children]
  });
});
if (true) TooltipRoot.displayName = "TooltipRoot";
function TooltipInteractions({
  store,
  disabled: disabled2,
  trackCursorAxis
}) {
  const floatingRootContext = store.useState("floatingRootContext");
  const dismiss = useDismiss(floatingRootContext, {
    enabled: !disabled2,
    referencePress: () => store.select("closeOnClick")
  });
  const clientPoint = useClientPoint(floatingRootContext, {
    enabled: !disabled2 && trackCursorAxis !== "none",
    axis: trackCursorAxis === "none" ? void 0 : trackCursorAxis
  });
  const activeTriggerProps = React64.useMemo(() => mergeProps(clientPoint.reference, dismiss.reference), [clientPoint.reference, dismiss.reference]);
  const inactiveTriggerProps = React64.useMemo(() => mergeProps(clientPoint.trigger, dismiss.trigger), [clientPoint.trigger, dismiss.trigger]);
  const popupProps = React64.useMemo(() => mergeProps(FOCUSABLE_POPUP_PROPS, clientPoint.floating, dismiss.floating), [clientPoint.floating, dismiss.floating]);
  usePopupInteractionProps(store, {
    activeTriggerProps,
    inactiveTriggerProps,
    popupProps
  });
  return null;
}

// node_modules/@base-ui/react/tooltip/trigger/TooltipTrigger.mjs
var React66 = __toESM(require_react(), 1);

// node_modules/@base-ui/react/tooltip/provider/TooltipProviderContext.mjs
var React65 = __toESM(require_react(), 1);
var TooltipProviderContext = /* @__PURE__ */ React65.createContext(void 0);
if (true) TooltipProviderContext.displayName = "TooltipProviderContext";
function useTooltipProviderContext() {
  return React65.useContext(TooltipProviderContext);
}

// node_modules/@base-ui/react/tooltip/trigger/TooltipTriggerDataAttributes.mjs
var TooltipTriggerDataAttributes = (function(TooltipTriggerDataAttributes2) {
  TooltipTriggerDataAttributes2[TooltipTriggerDataAttributes2["popupOpen"] = CommonTriggerDataAttributes.popupOpen] = "popupOpen";
  TooltipTriggerDataAttributes2["triggerDisabled"] = "data-trigger-disabled";
  return TooltipTriggerDataAttributes2;
})({});

// node_modules/@base-ui/react/tooltip/utils/constants.mjs
var OPEN_DELAY2 = 600;

// node_modules/@base-ui/react/tooltip/trigger/TooltipTrigger.mjs
var TOOLTIP_TRIGGER_IDENTIFIER = "data-base-ui-tooltip-trigger";
function getTargetElement(event) {
  if ("composedPath" in event) {
    const path = event.composedPath();
    for (let i = 0; i < path.length; i += 1) {
      const element = path[i];
      if (isElement(element)) {
        return element;
      }
    }
  }
  const target = event.target;
  if (isElement(target)) {
    return target;
  }
  return null;
}
function closestEnabledTooltipTrigger(element) {
  let current = element;
  while (current) {
    if (current.hasAttribute(TOOLTIP_TRIGGER_IDENTIFIER)) {
      return current;
    }
    const parentElement = current.parentElement;
    if (parentElement) {
      current = parentElement;
      continue;
    }
    const root = current.getRootNode();
    current = "host" in root && isElement(root.host) ? root.host : null;
  }
  return null;
}
var TooltipTrigger = fastComponentRef(function TooltipTrigger2(componentProps, forwardedRef) {
  const {
    render,
    className,
    style,
    handle,
    payload,
    disabled: disabledProp,
    delay,
    closeOnClick = true,
    closeDelay,
    id: idProp,
    ...elementProps
  } = componentProps;
  const rootContext = useTooltipRootContext(true);
  const store = handle?.store ?? rootContext;
  if (!store) {
    throw new Error(true ? "Base UI: <Tooltip.Trigger> must be either used within a <Tooltip.Root> component or provided with a handle." : formatErrorMessage_default(82));
  }
  const thisTriggerId = useBaseUiId(idProp);
  const isTriggerActive = store.useState("isTriggerActive", thisTriggerId);
  const isOpenedByThisTrigger = store.useState("isOpenedByTrigger", thisTriggerId);
  const floatingRootContext = store.useState("floatingRootContext");
  const triggerElementRef = React66.useRef(null);
  const delayWithDefault = delay ?? OPEN_DELAY2;
  const closeDelayWithDefault = closeDelay ?? 0;
  const {
    registerTrigger,
    isMountedByThisTrigger
  } = useTriggerDataForwarding(thisTriggerId, triggerElementRef, store, {
    payload,
    closeOnClick,
    closeDelay: closeDelayWithDefault
  });
  const providerContext = useTooltipProviderContext();
  const {
    delayRef,
    isInstantPhase,
    hasProvider
  } = useDelayGroup(floatingRootContext, {
    open: isOpenedByThisTrigger
  });
  const hoverInteraction = useHoverInteractionSharedState(floatingRootContext);
  store.useSyncedValue("isInstantPhase", isInstantPhase);
  const rootDisabled = store.useState("disabled");
  const disabled2 = disabledProp ?? rootDisabled;
  const disabledRef = useValueAsRef(disabled2);
  const trackCursorAxis = store.useState("trackCursorAxis");
  const disableHoverablePopup = store.useState("disableHoverablePopup");
  const isNestedTriggerHoveredRef = React66.useRef(false);
  const nestedTriggerOpenTimeout = useTimeout();
  const pointerTypeRef = React66.useRef(void 0);
  function getOpenDelay() {
    const providerDelay = providerContext?.delay;
    const groupOpenValue = typeof delayRef.current === "object" ? delayRef.current.open : void 0;
    let computedOpenDelay = delayWithDefault;
    if (hasProvider) {
      if (groupOpenValue !== 0) {
        computedOpenDelay = delay ?? providerDelay ?? delayWithDefault;
      } else {
        computedOpenDelay = 0;
      }
    }
    return computedOpenDelay;
  }
  function isEnabledNestedTriggerTarget(target) {
    const triggerEl = triggerElementRef.current;
    if (!triggerEl || !target) {
      return false;
    }
    const nearestTrigger = closestEnabledTooltipTrigger(target);
    return nearestTrigger !== null && nearestTrigger !== triggerEl && contains(triggerEl, nearestTrigger);
  }
  function detectNestedTriggerHover(target) {
    const nestedTriggerHovered = isEnabledNestedTriggerTarget(target);
    isNestedTriggerHoveredRef.current = nestedTriggerHovered;
    if (nestedTriggerHovered) {
      hoverInteraction.openChangeTimeout.clear();
      hoverInteraction.restTimeout.clear();
      hoverInteraction.restTimeoutPending = false;
      nestedTriggerOpenTimeout.clear();
    }
    return nestedTriggerHovered;
  }
  const hoverProps = useHoverReferenceInteraction(floatingRootContext, {
    enabled: !disabled2,
    mouseOnly: true,
    move: false,
    handleClose: !disableHoverablePopup && trackCursorAxis !== "both" ? safePolygon() : null,
    restMs: getOpenDelay,
    delay() {
      const closeValue = typeof delayRef.current === "object" ? delayRef.current.close : void 0;
      let computedCloseDelay = closeDelayWithDefault;
      if (closeDelay == null && hasProvider) {
        computedCloseDelay = closeValue;
      }
      return {
        close: computedCloseDelay
      };
    },
    triggerElementRef,
    isActiveTrigger: isTriggerActive,
    isClosing: () => store.select("transitionStatus") === "ending",
    shouldOpen() {
      return !isNestedTriggerHoveredRef.current;
    }
  });
  const focusProps = useFocus(floatingRootContext, {
    enabled: !disabled2
  }).reference;
  const handleNestedTriggerHover = (event) => {
    const wasNestedTriggerHovered = isNestedTriggerHoveredRef.current;
    const target = getTargetElement(event);
    const nestedTriggerHovered = detectNestedTriggerHover(target);
    const triggerEl = triggerElementRef.current;
    const targetInsideTrigger = triggerEl && target && contains(triggerEl, target);
    if (nestedTriggerHovered && store.select("open") && store.select("lastOpenChangeReason") === reason_parts_exports.triggerHover) {
      store.setOpen(false, createChangeEventDetails(reason_parts_exports.triggerHover, event));
      return;
    }
    if (wasNestedTriggerHovered && !nestedTriggerHovered && targetInsideTrigger && !disabledRef.current && !store.select("open") && triggerEl && // Match the hover hook's non-strict mouse fallback for mouse-only event sequences.
    isMouseLikePointerType(pointerTypeRef.current)) {
      const open = () => {
        if (!isNestedTriggerHoveredRef.current && !disabledRef.current && !store.select("open")) {
          store.setOpen(true, createChangeEventDetails(reason_parts_exports.triggerHover, event, triggerEl));
        }
      };
      const openDelay = getOpenDelay();
      if (openDelay === 0) {
        nestedTriggerOpenTimeout.clear();
        open();
      } else {
        nestedTriggerOpenTimeout.start(openDelay, open);
      }
    }
  };
  const rootTriggerProps = store.useState("triggerProps", isMountedByThisTrigger);
  const shouldApplyRootTriggerProps = isMountedByThisTrigger || trackCursorAxis !== "none";
  const state = {
    open: isOpenedByThisTrigger
  };
  const element = useRenderElement("button", componentProps, {
    state,
    ref: [forwardedRef, registerTrigger, triggerElementRef],
    props: [hoverProps, focusProps, shouldApplyRootTriggerProps ? rootTriggerProps : void 0, {
      onMouseOver(event) {
        handleNestedTriggerHover(event.nativeEvent);
      },
      onFocus(event) {
        if (isEnabledNestedTriggerTarget(getTargetElement(event.nativeEvent))) {
          event.preventBaseUIHandler();
        }
      },
      onMouseLeave() {
        isNestedTriggerHoveredRef.current = false;
        nestedTriggerOpenTimeout.clear();
        pointerTypeRef.current = void 0;
      },
      onPointerEnter(event) {
        pointerTypeRef.current = event.pointerType;
      },
      onPointerDown(event) {
        pointerTypeRef.current = event.pointerType;
        store.set("closeOnClick", closeOnClick);
        if (closeOnClick && !store.select("open")) {
          store.cancelPendingOpen(event.nativeEvent);
        }
      },
      onClick(event) {
        if (closeOnClick && !store.select("open")) {
          store.cancelPendingOpen(event.nativeEvent);
        }
      },
      id: thisTriggerId,
      [TooltipTriggerDataAttributes.triggerDisabled]: disabled2 ? "" : void 0,
      [TOOLTIP_TRIGGER_IDENTIFIER]: disabled2 ? void 0 : ""
    }, elementProps],
    stateAttributesMapping: triggerOpenStateMapping
  });
  return element;
});
if (true) TooltipTrigger.displayName = "TooltipTrigger";

// node_modules/@base-ui/react/tooltip/portal/TooltipPortal.mjs
var React68 = __toESM(require_react(), 1);

// node_modules/@base-ui/react/tooltip/portal/TooltipPortalContext.mjs
var React67 = __toESM(require_react(), 1);
var TooltipPortalContext = /* @__PURE__ */ React67.createContext(void 0);
if (true) TooltipPortalContext.displayName = "TooltipPortalContext";
function useTooltipPortalContext() {
  const value = React67.useContext(TooltipPortalContext);
  if (value === void 0) {
    throw new Error(true ? "Base UI: <Tooltip.Portal> is missing." : formatErrorMessage_default(70));
  }
  return value;
}

// node_modules/@base-ui/react/tooltip/portal/TooltipPortal.mjs
var import_jsx_runtime16 = __toESM(require_jsx_runtime(), 1);
var TooltipPortal = /* @__PURE__ */ React68.forwardRef(function TooltipPortal2(props, forwardedRef) {
  const {
    keepMounted = false,
    ...portalProps
  } = props;
  const store = useTooltipRootContext();
  const mounted = store.useState("mounted");
  const shouldRender = mounted || keepMounted;
  if (!shouldRender) {
    return null;
  }
  return /* @__PURE__ */ (0, import_jsx_runtime16.jsx)(TooltipPortalContext.Provider, {
    value: keepMounted,
    children: /* @__PURE__ */ (0, import_jsx_runtime16.jsx)(FloatingPortalLite, {
      ref: forwardedRef,
      ...portalProps
    })
  });
});
if (true) TooltipPortal.displayName = "TooltipPortal";

// node_modules/@base-ui/react/tooltip/positioner/TooltipPositioner.mjs
var React70 = __toESM(require_react(), 1);

// node_modules/@base-ui/react/tooltip/positioner/TooltipPositionerContext.mjs
var React69 = __toESM(require_react(), 1);
var TooltipPositionerContext = /* @__PURE__ */ React69.createContext(void 0);
if (true) TooltipPositionerContext.displayName = "TooltipPositionerContext";
function useTooltipPositionerContext() {
  const context = React69.useContext(TooltipPositionerContext);
  if (context === void 0) {
    throw new Error(true ? "Base UI: TooltipPositionerContext is missing. TooltipPositioner parts must be placed within <Tooltip.Positioner>." : formatErrorMessage_default(71));
  }
  return context;
}

// node_modules/@base-ui/react/tooltip/positioner/TooltipPositioner.mjs
var import_jsx_runtime17 = __toESM(require_jsx_runtime(), 1);
var TooltipPositioner = /* @__PURE__ */ React70.forwardRef(function TooltipPositioner2(componentProps, forwardedRef) {
  const {
    render,
    className,
    anchor,
    positionMethod = "absolute",
    side = "top",
    align = "center",
    sideOffset = 0,
    alignOffset = 0,
    collisionBoundary = "clipping-ancestors",
    collisionPadding = 5,
    arrowPadding = 5,
    sticky = false,
    disableAnchorTracking = false,
    collisionAvoidance = POPUP_COLLISION_AVOIDANCE,
    style,
    ...elementProps
  } = componentProps;
  const store = useTooltipRootContext();
  const keepMounted = useTooltipPortalContext();
  const open = store.useState("open");
  const mounted = store.useState("mounted");
  const trackCursorAxis = store.useState("trackCursorAxis");
  const disableHoverablePopup = store.useState("disableHoverablePopup");
  const floatingRootContext = store.useState("floatingRootContext");
  const instantType = store.useState("instantType");
  const transitionStatus = store.useState("transitionStatus");
  const hasViewport = store.useState("hasViewport");
  const positioning = useAnchorPositioning({
    anchor,
    positionMethod,
    floatingRootContext,
    mounted,
    side,
    sideOffset,
    align,
    alignOffset,
    collisionBoundary,
    collisionPadding,
    sticky,
    arrowPadding,
    disableAnchorTracking,
    keepMounted,
    collisionAvoidance,
    adaptiveOrigin: hasViewport ? adaptiveOrigin : void 0
  });
  const state = React70.useMemo(() => ({
    open,
    side: positioning.side,
    align: positioning.align,
    anchorHidden: positioning.anchorHidden,
    instant: trackCursorAxis !== "none" ? "tracking-cursor" : instantType
  }), [open, positioning.side, positioning.align, positioning.anchorHidden, trackCursorAxis, instantType]);
  const element = usePositioner(componentProps, state, {
    styles: positioning.positionerStyles,
    transitionStatus,
    props: elementProps,
    refs: [forwardedRef, store.useStateSetter("positionerElement")],
    hidden: !mounted,
    inert: !open || trackCursorAxis === "both" || disableHoverablePopup
  });
  return /* @__PURE__ */ (0, import_jsx_runtime17.jsx)(TooltipPositionerContext.Provider, {
    value: positioning,
    children: element
  });
});
if (true) TooltipPositioner.displayName = "TooltipPositioner";

// node_modules/@base-ui/react/tooltip/popup/TooltipPopup.mjs
var React71 = __toESM(require_react(), 1);
var stateAttributesMapping4 = {
  ...popupStateMapping,
  ...transitionStatusMapping
};
var TooltipPopup = /* @__PURE__ */ React71.forwardRef(function TooltipPopup2(componentProps, forwardedRef) {
  const {
    render,
    className,
    style,
    ...elementProps
  } = componentProps;
  const store = useTooltipRootContext();
  const {
    side,
    align
  } = useTooltipPositionerContext();
  const open = store.useState("open");
  const instantType = store.useState("instantType");
  const transitionStatus = store.useState("transitionStatus");
  const popupProps = store.useState("popupProps");
  const floatingContext = store.useState("floatingRootContext");
  const disabled2 = store.useState("disabled");
  const closeDelay = store.useState("closeDelay");
  useOpenChangeComplete({
    open,
    ref: store.context.popupRef,
    onComplete() {
      if (open) {
        store.context.onOpenChangeComplete?.(true);
      }
    }
  });
  useHoverFloatingInteraction(floatingContext, {
    enabled: !disabled2,
    closeDelay
  });
  const setPopupElement = store.useStateSetter("popupElement");
  const state = {
    open,
    side,
    align,
    instant: instantType,
    transitionStatus
  };
  const element = useRenderElement("div", componentProps, {
    state,
    ref: [forwardedRef, store.context.popupRef, setPopupElement],
    props: [popupProps, getDisabledMountTransitionStyles(transitionStatus), elementProps],
    stateAttributesMapping: stateAttributesMapping4
  });
  return element;
});
if (true) TooltipPopup.displayName = "TooltipPopup";

// node_modules/@base-ui/react/tooltip/arrow/TooltipArrow.mjs
var React72 = __toESM(require_react(), 1);
var TooltipArrow = /* @__PURE__ */ React72.forwardRef(function TooltipArrow2(componentProps, forwardedRef) {
  const {
    render,
    className,
    style,
    ...elementProps
  } = componentProps;
  const store = useTooltipRootContext();
  const {
    arrowRef,
    side,
    align,
    arrowUncentered,
    arrowStyles
  } = useTooltipPositionerContext();
  const open = store.useState("open");
  const instantType = store.useState("instantType");
  const state = {
    open,
    side,
    align,
    uncentered: arrowUncentered,
    instant: instantType
  };
  const element = useRenderElement("div", componentProps, {
    state,
    ref: [forwardedRef, arrowRef],
    props: [{
      style: arrowStyles,
      "aria-hidden": true
    }, elementProps],
    stateAttributesMapping: popupStateMapping
  });
  return element;
});
if (true) TooltipArrow.displayName = "TooltipArrow";

// node_modules/@base-ui/react/tooltip/provider/TooltipProvider.mjs
var React73 = __toESM(require_react(), 1);
var import_jsx_runtime18 = __toESM(require_jsx_runtime(), 1);
var TooltipProvider = function TooltipProvider2(props) {
  const {
    delay,
    closeDelay,
    timeout = 400
  } = props;
  const contextValue = React73.useMemo(() => ({
    delay,
    closeDelay
  }), [delay, closeDelay]);
  const delayValue = React73.useMemo(() => ({
    open: delay,
    close: closeDelay
  }), [delay, closeDelay]);
  return /* @__PURE__ */ (0, import_jsx_runtime18.jsx)(TooltipProviderContext.Provider, {
    value: contextValue,
    children: /* @__PURE__ */ (0, import_jsx_runtime18.jsx)(FloatingDelayGroup, {
      delay: delayValue,
      timeoutMs: timeout,
      children: props.children
    })
  });
};
if (true) TooltipProvider.displayName = "TooltipProvider";

// node_modules/@base-ui/react/tooltip/viewport/TooltipViewport.mjs
var React74 = __toESM(require_react(), 1);

// node_modules/@base-ui/react/tooltip/viewport/TooltipViewportCssVars.mjs
var TooltipViewportCssVars = /* @__PURE__ */ (function(TooltipViewportCssVars2) {
  TooltipViewportCssVars2["popupWidth"] = "--popup-width";
  TooltipViewportCssVars2["popupHeight"] = "--popup-height";
  return TooltipViewportCssVars2;
})({});

// node_modules/@base-ui/react/tooltip/viewport/TooltipViewport.mjs
var stateAttributesMapping5 = {
  activationDirection: (value) => value ? {
    "data-activation-direction": value
  } : null
};
var TooltipViewport = /* @__PURE__ */ React74.forwardRef(function TooltipViewport2(componentProps, forwardedRef) {
  const {
    render,
    className,
    style,
    children,
    ...elementProps
  } = componentProps;
  const store = useTooltipRootContext();
  const positioner = useTooltipPositionerContext();
  const instantType = store.useState("instantType");
  const {
    children: childrenToRender,
    state: viewportState
  } = usePopupViewport({
    store,
    side: positioner.side,
    cssVars: TooltipViewportCssVars,
    children
  });
  const state = {
    activationDirection: viewportState.activationDirection,
    transitioning: viewportState.transitioning,
    instant: instantType
  };
  return useRenderElement("div", componentProps, {
    state,
    ref: forwardedRef,
    props: [elementProps, {
      children: childrenToRender
    }],
    stateAttributesMapping: stateAttributesMapping5
  });
});
if (true) TooltipViewport.displayName = "TooltipViewport";

// node_modules/@base-ui/react/tooltip/store/TooltipHandle.mjs
var TooltipHandle = class {
  /**
   * Internal store holding the tooltip state.
   * @internal
   */
  constructor() {
    this.store = new TooltipStore();
  }
  /**
   * Opens the tooltip and associates it with the trigger with the given ID.
   * The trigger must be a Tooltip.Trigger component with this handle passed as a prop.
   *
   * This method should only be called in an event handler or an effect (not during rendering).
   *
   * @param triggerId ID of the trigger to associate with the tooltip.
   */
  open(triggerId) {
    const triggerElement = triggerId ? this.store.context.triggerElements.getById(triggerId) : void 0;
    if (triggerId && !triggerElement) {
      throw new Error(true ? `Base UI: TooltipHandle.open: No trigger found with id "${triggerId}".` : formatErrorMessage_default(81, triggerId));
    }
    this.store.setOpen(true, createChangeEventDetails(reason_parts_exports.imperativeAction, void 0, triggerElement));
  }
  /**
   * Closes the tooltip.
   */
  close() {
    this.store.setOpen(false, createChangeEventDetails(reason_parts_exports.imperativeAction, void 0, void 0));
  }
  /**
   * Indicates whether the tooltip is currently open.
   */
  get isOpen() {
    return this.store.select("open");
  }
};
function createTooltipHandle() {
  return new TooltipHandle();
}

// node_modules/@base-ui/react/use-render/useRender.mjs
function useRender(params) {
  return useRenderElement(params.defaultTagName ?? "div", params, params);
}

// packages/ui/build-module/text/text.mjs
var import_element12 = __toESM(require_element(), 1);
var STYLE_HASH_ATTRIBUTE = "data-wp-hash";
function getRuntime() {
  const globalScope = globalThis;
  if (globalScope.__wpStyleRuntime) {
    return globalScope.__wpStyleRuntime;
  }
  globalScope.__wpStyleRuntime = {
    documents: /* @__PURE__ */ new Map(),
    styles: /* @__PURE__ */ new Map(),
    injectedStyles: /* @__PURE__ */ new WeakMap()
  };
  if (typeof document !== "undefined") {
    registerDocument(document);
  }
  return globalScope.__wpStyleRuntime;
}
function documentContainsStyleHash(targetDocument, hash) {
  if (!targetDocument.head) {
    return false;
  }
  for (const style of targetDocument.head.querySelectorAll(
    `style[${STYLE_HASH_ATTRIBUTE}]`
  )) {
    if (style.getAttribute(STYLE_HASH_ATTRIBUTE) === hash) {
      return true;
    }
  }
  return false;
}
function injectStyle(targetDocument, hash, css) {
  if (!targetDocument.head) {
    return;
  }
  const runtime = getRuntime();
  let injectedStyles = runtime.injectedStyles.get(targetDocument);
  if (!injectedStyles) {
    injectedStyles = /* @__PURE__ */ new Set();
    runtime.injectedStyles.set(targetDocument, injectedStyles);
  }
  if (injectedStyles.has(hash)) {
    return;
  }
  if (documentContainsStyleHash(targetDocument, hash)) {
    injectedStyles.add(hash);
    return;
  }
  const style = targetDocument.createElement("style");
  style.setAttribute(STYLE_HASH_ATTRIBUTE, hash);
  style.appendChild(targetDocument.createTextNode(css));
  targetDocument.head.appendChild(style);
  injectedStyles.add(hash);
}
function registerDocument(targetDocument) {
  const runtime = getRuntime();
  runtime.documents.set(
    targetDocument,
    (runtime.documents.get(targetDocument) ?? 0) + 1
  );
  for (const [hash, css] of runtime.styles) {
    injectStyle(targetDocument, hash, css);
  }
  return () => {
    const count = runtime.documents.get(targetDocument);
    if (count === void 0) {
      return;
    }
    if (count <= 1) {
      runtime.documents.delete(targetDocument);
      return;
    }
    runtime.documents.set(targetDocument, count - 1);
  };
}
function registerStyle(hash, css) {
  const runtime = getRuntime();
  runtime.styles.set(hash, css);
  for (const targetDocument of runtime.documents.keys()) {
    injectStyle(targetDocument, hash, css);
  }
}
if (typeof process === "undefined" || true) {
  registerStyle("a495f9d138", '@layer wp-ui{@layer utilities, components, compositions, overrides;@layer components{._83ed8a8da5dd50ea__text{margin:0}._14437cfb77831647__heading-2xl{--_gcd-heading-font-size:var(--wpds-typography-font-size-2xl,32px);--_gcd-heading-font-weight:var(--wpds-typography-font-weight-emphasis,600);--_gcd-p-font-size:var(--wpds-typography-font-size-2xl,32px);--_gcd-p-line-height:var(--wpds-typography-line-height-2xl,40px);font-size:var(--wpds-typography-font-size-2xl,32px);line-height:var(--wpds-typography-line-height-2xl,40px)}._14437cfb77831647__heading-2xl,._3c78b7fa9b4072dd__heading-xl{font-family:var(--wpds-typography-font-family-heading,-apple-system,system-ui,"Segoe UI","Roboto","Oxygen-Sans","Ubuntu","Cantarell","Helvetica Neue",sans-serif);font-weight:var(--wpds-typography-font-weight-emphasis,600)}._3c78b7fa9b4072dd__heading-xl{--_gcd-heading-font-size:var(--wpds-typography-font-size-xl,20px);--_gcd-heading-font-weight:var(--wpds-typography-font-weight-emphasis,600);--_gcd-p-font-size:var(--wpds-typography-font-size-xl,20px);--_gcd-p-line-height:var(--wpds-typography-line-height-md,24px);font-size:var(--wpds-typography-font-size-xl,20px);line-height:var(--wpds-typography-line-height-md,24px)}.aa58f227716bcde2__heading-lg{--_gcd-heading-font-size:var(--wpds-typography-font-size-lg,15px);--_gcd-heading-font-weight:var(--wpds-typography-font-weight-emphasis,600);--_gcd-p-font-size:var(--wpds-typography-font-size-lg,15px);--_gcd-p-line-height:var(--wpds-typography-line-height-sm,20px);font-size:var(--wpds-typography-font-size-lg,15px)}.aa58f227716bcde2__heading-lg,.fc4da56d8dfe52c4__heading-md{font-family:var(--wpds-typography-font-family-heading,-apple-system,system-ui,"Segoe UI","Roboto","Oxygen-Sans","Ubuntu","Cantarell","Helvetica Neue",sans-serif);font-weight:var(--wpds-typography-font-weight-emphasis,600);line-height:var(--wpds-typography-line-height-sm,20px)}.fc4da56d8dfe52c4__heading-md{--_gcd-heading-font-size:var(--wpds-typography-font-size-md,13px);--_gcd-heading-font-weight:var(--wpds-typography-font-weight-emphasis,600);--_gcd-p-font-size:var(--wpds-typography-font-size-md,13px);--_gcd-p-line-height:var(--wpds-typography-line-height-sm,20px);font-size:var(--wpds-typography-font-size-md,13px)}.a9b78c7c82e8dff7__heading-sm{--_gcd-heading-font-size:var(--wpds-typography-font-size-xs,11px);--_gcd-heading-font-weight:var(--wpds-typography-font-weight-emphasis,600);--_gcd-p-font-size:var(--wpds-typography-font-size-xs,11px);--_gcd-p-line-height:var(--wpds-typography-line-height-xs,16px);font-family:var(--wpds-typography-font-family-heading,-apple-system,system-ui,"Segoe UI","Roboto","Oxygen-Sans","Ubuntu","Cantarell","Helvetica Neue",sans-serif);font-size:var(--wpds-typography-font-size-xs,11px);font-weight:var(--wpds-typography-font-weight-emphasis,600);line-height:var(--wpds-typography-line-height-xs,16px);text-transform:uppercase}._305ff559e52180d5__body-xl{--_gcd-heading-font-size:var(--wpds-typography-font-size-xl,20px);--_gcd-heading-font-weight:var(--wpds-typography-font-weight-default,400);--_gcd-p-font-size:var(--wpds-typography-font-size-xl,20px);--_gcd-p-line-height:var(--wpds-typography-line-height-xl,32px);font-size:var(--wpds-typography-font-size-xl,20px);line-height:var(--wpds-typography-line-height-xl,32px)}._305ff559e52180d5__body-xl,.ca1aa3fc2029e958__body-lg{font-family:var(--wpds-typography-font-family-body,-apple-system,system-ui,"Segoe UI","Roboto","Oxygen-Sans","Ubuntu","Cantarell","Helvetica Neue",sans-serif);font-weight:var(--wpds-typography-font-weight-default,400)}.ca1aa3fc2029e958__body-lg{--_gcd-heading-font-size:var(--wpds-typography-font-size-lg,15px);--_gcd-heading-font-weight:var(--wpds-typography-font-weight-default,400);--_gcd-p-font-size:var(--wpds-typography-font-size-lg,15px);--_gcd-p-line-height:var(--wpds-typography-line-height-md,24px);font-size:var(--wpds-typography-font-size-lg,15px);line-height:var(--wpds-typography-line-height-md,24px)}._131101940be12424__body-md{--_gcd-heading-font-size:var(--wpds-typography-font-size-md,13px);--_gcd-heading-font-weight:var(--wpds-typography-font-weight-default,400);--_gcd-p-font-size:var(--wpds-typography-font-size-md,13px);--_gcd-p-line-height:var(--wpds-typography-line-height-sm,20px);font-size:var(--wpds-typography-font-size-md,13px);line-height:var(--wpds-typography-line-height-sm,20px)}._0e8d87a42c1f75fa__body-sm,._131101940be12424__body-md{font-family:var(--wpds-typography-font-family-body,-apple-system,system-ui,"Segoe UI","Roboto","Oxygen-Sans","Ubuntu","Cantarell","Helvetica Neue",sans-serif);font-weight:var(--wpds-typography-font-weight-default,400)}._0e8d87a42c1f75fa__body-sm{--_gcd-heading-font-size:var(--wpds-typography-font-size-sm,12px);--_gcd-heading-font-weight:var(--wpds-typography-font-weight-default,400);--_gcd-p-font-size:var(--wpds-typography-font-size-sm,12px);--_gcd-p-line-height:var(--wpds-typography-line-height-xs,16px);font-size:var(--wpds-typography-font-size-sm,12px);line-height:var(--wpds-typography-line-height-xs,16px)}}}');
}
var style_default = { "text": "_83ed8a8da5dd50ea__text", "heading-2xl": "_14437cfb77831647__heading-2xl", "heading-xl": "_3c78b7fa9b4072dd__heading-xl", "heading-lg": "aa58f227716bcde2__heading-lg", "heading-md": "fc4da56d8dfe52c4__heading-md", "heading-sm": "a9b78c7c82e8dff7__heading-sm", "body-xl": "_305ff559e52180d5__body-xl", "body-lg": "ca1aa3fc2029e958__body-lg", "body-md": "_131101940be12424__body-md", "body-sm": "_0e8d87a42c1f75fa__body-sm" };
if (typeof process === "undefined" || true) {
  registerStyle("af6d9984a6", "._6defc79820e382c6__button{box-sizing:var(--_gcd-button-box-sizing,border-box);font-family:var(--_gcd-button-font-family,inherit);font-size:var(--_gcd-button-font-size,inherit);font-weight:var(--_gcd-button-font-weight,inherit)}.d2cff2e5dea83bd1__input{box-sizing:var(--_gcd-input-box-sizing,border-box);font-family:var(--_gcd-input-font-family,inherit);font-size:var(--_gcd-input-font-size,inherit);font-weight:var(--_gcd-input-font-weight,inherit);margin:var(--_gcd-input-margin,0);&:is(textarea,[type=text],[type=password],[type=color],[type=date],[type=datetime],[type=datetime-local],[type=email],[type=month],[type=number],[type=search],[type=tel],[type=time],[type=url],[type=week]){background-color:var(--_gcd-input-background-color,transparent);border:var(--_gcd-input-border,none);border-radius:var(--_gcd-input-border-radius,0);box-shadow:var(--_gcd-input-box-shadow,0 0 0 transparent);color:var(--_gcd-input-color,var(--wpds-color-foreground-interactive-neutral,#1e1e1e));&:focus{border-color:var(--_gcd-input-border-color-focus,var(--wp-admin-theme-color));box-shadow:var(--_gcd-input-box-shadow-focus,none);outline:var(--_gcd-input-outline-focus,none)}&:disabled{background:var(--_gcd-input-background-disabled,transparent);border-color:var(--_gcd-input-border-color-disabled,transparent);box-shadow:var(--_gcd-input-box-shadow-disabled,none);color:var(--_gcd-input-color-disabled,var(--wpds-color-foreground-interactive-neutral-disabled,#8d8d8d))}&::placeholder{color:var(--_gcd-input-placeholder-color,var(--wpds-color-foreground-interactive-neutral-disabled,#8d8d8d))}}&:is(textarea,[type=text],[type=password],[type=date],[type=datetime],[type=datetime-local],[type=email],[type=month],[type=number],[type=search],[type=tel],[type=time],[type=url],[type=week]){line-height:var(--_gcd-input-line-height,inherit);min-height:var(--_gcd-input-min-height,auto);padding:var(--_gcd-input-padding,0)}}._547d86373d02e108__textarea{box-sizing:var(--_gcd-textarea-box-sizing,border-box);overflow:var(--_gcd-textarea-overflow,auto);resize:var(--_gcd-textarea-resize,block)}._8c15fd0ed9f28ba4__div{outline:var(--_gcd-div-outline,0 solid transparent)}p._43cec3e1eec1066d__p{font-size:var(--_gcd-p-font-size,13px);line-height:var(--_gcd-p-line-height,1.5);margin:var(--_gcd-p-margin,0)}:is(h1,h2,h3,h4,h5,h6).e97669c6d9a38497__heading{color:var(--_gcd-heading-color,var(--wpds-color-foreground-content-neutral,#1e1e1e));font-size:var(--_gcd-heading-font-size,inherit);font-weight:var(--_gcd-heading-font-weight,var(--wpds-typography-font-weight-emphasis,600));margin:var(--_gcd-heading-margin,0)}._2c0831b0499dbd6e__a,._2c0831b0499dbd6e__a:is(:hover,:focus,:active){border-radius:var(--_gcd-a-border-radius,0);box-shadow:var(--_gcd-a-box-shadow,none);color:var(--_gcd-a-color,inherit);outline:var(--_gcd-a-outline,0 solid transparent);transition:var(--_gcd-a-transition,none)}");
}
var global_css_defense_default = { "button": "_6defc79820e382c6__button", "input": "d2cff2e5dea83bd1__input", "textarea": "_547d86373d02e108__textarea", "div": "_8c15fd0ed9f28ba4__div", "p": "_43cec3e1eec1066d__p", "heading": "e97669c6d9a38497__heading", "a": "_2c0831b0499dbd6e__a" };
var Text = (0, import_element12.forwardRef)(function Text2({ variant = "body-md", render, className, ...props }, ref) {
  const element = useRender({
    render,
    defaultTagName: "span",
    ref,
    props: mergeProps(props, {
      className: clsx_default(
        style_default.text,
        global_css_defense_default.heading,
        global_css_defense_default.p,
        style_default[variant],
        className
      )
    })
  });
  return element;
});

// packages/ui/build-module/badge/badge.mjs
var import_jsx_runtime19 = __toESM(require_jsx_runtime(), 1);
var STYLE_HASH_ATTRIBUTE2 = "data-wp-hash";
function getRuntime2() {
  const globalScope = globalThis;
  if (globalScope.__wpStyleRuntime) {
    return globalScope.__wpStyleRuntime;
  }
  globalScope.__wpStyleRuntime = {
    documents: /* @__PURE__ */ new Map(),
    styles: /* @__PURE__ */ new Map(),
    injectedStyles: /* @__PURE__ */ new WeakMap()
  };
  if (typeof document !== "undefined") {
    registerDocument2(document);
  }
  return globalScope.__wpStyleRuntime;
}
function documentContainsStyleHash2(targetDocument, hash) {
  if (!targetDocument.head) {
    return false;
  }
  for (const style of targetDocument.head.querySelectorAll(
    `style[${STYLE_HASH_ATTRIBUTE2}]`
  )) {
    if (style.getAttribute(STYLE_HASH_ATTRIBUTE2) === hash) {
      return true;
    }
  }
  return false;
}
function injectStyle2(targetDocument, hash, css) {
  if (!targetDocument.head) {
    return;
  }
  const runtime = getRuntime2();
  let injectedStyles = runtime.injectedStyles.get(targetDocument);
  if (!injectedStyles) {
    injectedStyles = /* @__PURE__ */ new Set();
    runtime.injectedStyles.set(targetDocument, injectedStyles);
  }
  if (injectedStyles.has(hash)) {
    return;
  }
  if (documentContainsStyleHash2(targetDocument, hash)) {
    injectedStyles.add(hash);
    return;
  }
  const style = targetDocument.createElement("style");
  style.setAttribute(STYLE_HASH_ATTRIBUTE2, hash);
  style.appendChild(targetDocument.createTextNode(css));
  targetDocument.head.appendChild(style);
  injectedStyles.add(hash);
}
function registerDocument2(targetDocument) {
  const runtime = getRuntime2();
  runtime.documents.set(
    targetDocument,
    (runtime.documents.get(targetDocument) ?? 0) + 1
  );
  for (const [hash, css] of runtime.styles) {
    injectStyle2(targetDocument, hash, css);
  }
  return () => {
    const count = runtime.documents.get(targetDocument);
    if (count === void 0) {
      return;
    }
    if (count <= 1) {
      runtime.documents.delete(targetDocument);
      return;
    }
    runtime.documents.set(targetDocument, count - 1);
  };
}
function registerStyle2(hash, css) {
  const runtime = getRuntime2();
  runtime.styles.set(hash, css);
  for (const targetDocument of runtime.documents.keys()) {
    injectStyle2(targetDocument, hash, css);
  }
}
if (typeof process === "undefined" || true) {
  registerStyle2("9db2873e7f", "@layer wp-ui{@layer utilities, components, compositions, overrides;@layer components{._96e6251aad1a6136__badge{border-radius:var(--wpds-border-radius-lg,8px);padding-block:var(--wpds-dimension-padding-xs,4px);padding-inline:var(--wpds-dimension-padding-sm,8px)}._99f7158cb520f750__is-high-intent{background-color:var(--wpds-color-background-surface-error,#f6e6e3);color:var(--wpds-color-foreground-content-error,#470000)}.c20ebef2365bc8b7__is-medium-intent{background-color:var(--wpds-color-background-surface-warning,#fde6be);color:var(--wpds-color-foreground-content-warning,#2e1900)}._365e1626c6202e52__is-low-intent{background-color:var(--wpds-color-background-surface-caution,#fee995);color:var(--wpds-color-foreground-content-caution,#281d00)}._33f8198127ddf4ef__is-stable-intent{background-color:var(--wpds-color-background-surface-success,#c6f7cd);color:var(--wpds-color-foreground-content-success,#002900)}._04c1aca8fc449412__is-informational-intent{background-color:var(--wpds-color-background-surface-info,#deebfa);color:var(--wpds-color-foreground-content-info,#001b4f)}._90726e69d495ec19__is-draft-intent{background-color:var(--wpds-color-background-surface-neutral-weak,#f4f4f4);color:var(--wpds-color-foreground-content-neutral,#1e1e1e)}._898f4a544993bd39__is-none-intent{background-color:var(--wpds-color-background-surface-neutral-strong,#fff);border:var(--wpds-border-width-xs,1px) solid var(--wpds-color-stroke-surface-neutral,#dbdbdb);color:var(--wpds-color-foreground-content-neutral,#1e1e1e);padding-block:calc(var(--wpds-dimension-padding-xs, 4px) - var(--wpds-border-width-xs, 1px));padding-inline:calc(var(--wpds-dimension-padding-sm, 8px) - var(--wpds-border-width-xs, 1px))}}}");
}
var style_default2 = { "badge": "_96e6251aad1a6136__badge", "is-high-intent": "_99f7158cb520f750__is-high-intent", "is-medium-intent": "c20ebef2365bc8b7__is-medium-intent", "is-low-intent": "_365e1626c6202e52__is-low-intent", "is-stable-intent": "_33f8198127ddf4ef__is-stable-intent", "is-informational-intent": "_04c1aca8fc449412__is-informational-intent", "is-draft-intent": "_90726e69d495ec19__is-draft-intent", "is-none-intent": "_898f4a544993bd39__is-none-intent" };
var Badge = (0, import_element13.forwardRef)(function Badge2({ intent = "none", className, ...props }, ref) {
  return /* @__PURE__ */ (0, import_jsx_runtime19.jsx)(
    Text,
    {
      ref,
      className: clsx_default(
        style_default2.badge,
        style_default2[`is-${intent}-intent`],
        className
      ),
      ...props,
      variant: "body-sm"
    }
  );
});

// packages/ui/build-module/button/button.mjs
var import_element14 = __toESM(require_element(), 1);
var import_i18n = __toESM(require_i18n(), 1);
var import_jsx_runtime20 = __toESM(require_jsx_runtime(), 1);
import { speak } from "@wordpress/a11y";
var STYLE_HASH_ATTRIBUTE3 = "data-wp-hash";
function getRuntime3() {
  const globalScope = globalThis;
  if (globalScope.__wpStyleRuntime) {
    return globalScope.__wpStyleRuntime;
  }
  globalScope.__wpStyleRuntime = {
    documents: /* @__PURE__ */ new Map(),
    styles: /* @__PURE__ */ new Map(),
    injectedStyles: /* @__PURE__ */ new WeakMap()
  };
  if (typeof document !== "undefined") {
    registerDocument3(document);
  }
  return globalScope.__wpStyleRuntime;
}
function documentContainsStyleHash3(targetDocument, hash) {
  if (!targetDocument.head) {
    return false;
  }
  for (const style of targetDocument.head.querySelectorAll(
    `style[${STYLE_HASH_ATTRIBUTE3}]`
  )) {
    if (style.getAttribute(STYLE_HASH_ATTRIBUTE3) === hash) {
      return true;
    }
  }
  return false;
}
function injectStyle3(targetDocument, hash, css) {
  if (!targetDocument.head) {
    return;
  }
  const runtime = getRuntime3();
  let injectedStyles = runtime.injectedStyles.get(targetDocument);
  if (!injectedStyles) {
    injectedStyles = /* @__PURE__ */ new Set();
    runtime.injectedStyles.set(targetDocument, injectedStyles);
  }
  if (injectedStyles.has(hash)) {
    return;
  }
  if (documentContainsStyleHash3(targetDocument, hash)) {
    injectedStyles.add(hash);
    return;
  }
  const style = targetDocument.createElement("style");
  style.setAttribute(STYLE_HASH_ATTRIBUTE3, hash);
  style.appendChild(targetDocument.createTextNode(css));
  targetDocument.head.appendChild(style);
  injectedStyles.add(hash);
}
function registerDocument3(targetDocument) {
  const runtime = getRuntime3();
  runtime.documents.set(
    targetDocument,
    (runtime.documents.get(targetDocument) ?? 0) + 1
  );
  for (const [hash, css] of runtime.styles) {
    injectStyle3(targetDocument, hash, css);
  }
  return () => {
    const count = runtime.documents.get(targetDocument);
    if (count === void 0) {
      return;
    }
    if (count <= 1) {
      runtime.documents.delete(targetDocument);
      return;
    }
    runtime.documents.set(targetDocument, count - 1);
  };
}
function registerStyle3(hash, css) {
  const runtime = getRuntime3();
  runtime.styles.set(hash, css);
  for (const targetDocument of runtime.documents.keys()) {
    injectStyle3(targetDocument, hash, css);
  }
}
if (typeof process === "undefined" || true) {
  registerStyle3("b74f1ac304", '@layer wp-ui{@layer utilities, components, compositions, overrides;@layer components{._97b0fc33c028be1a__button,.abbb272e2ce49bd6__is-unstyled{appearance:none;padding:0}._97b0fc33c028be1a__button{--wp-ui-button-font-weight:var(--wpds-typography-font-weight-emphasis,600);--wp-ui-button-background-color:var(--wpds-color-background-interactive-brand-strong,var(--wp-admin-theme-color,#3858e9));--wp-ui-button-background-color-active:var(--wpds-color-background-interactive-brand-strong-active,color-mix(in oklch,var(--wp-admin-theme-color,#3858e9) 93%,#000));--wp-ui-button-background-color-disabled:var(--wpds-color-background-interactive-brand-strong-disabled,#e6e6e6);--wp-ui-button-foreground-color:var(--wpds-color-foreground-interactive-brand-strong,#fff);--wp-ui-button-foreground-color-active:var(--wpds-color-foreground-interactive-brand-strong-active,#fff);--wp-ui-button-foreground-color-disabled:var(--wpds-color-foreground-interactive-brand-strong-disabled,#8d8d8d);--wp-ui-button-padding-block:var(--wpds-dimension-padding-xs,4px);--wp-ui-button-padding-inline:var(--wpds-dimension-padding-md,12px);--wp-ui-button-height:var(--wpds-dimension-size-lg,40px);--wp-ui-button-aspect-ratio:auto;--wp-ui-button-font-size:var(--wpds-typography-font-size-md,13px);--wp-ui-button-min-width:calc(4ch + var(--wp-ui-button-padding-inline)*2);--wp-ui-button-icon-margin:calc((var(--wpds-dimension-size-2xs, 16px) - var(--wpds-dimension-size-sm, 24px))/2);--wp-ui-button-border-color:var(--wp-ui-button-background-color);--wp-ui-button-border-color-active:var(--wp-ui-button-background-color-active);--wp-ui-button-border-color-disabled:var(--wp-ui-button-background-color-disabled);--_gcd-button-font-family:var(--wpds-typography-font-family-body,-apple-system,system-ui,"Segoe UI","Roboto","Oxygen-Sans","Ubuntu","Cantarell","Helvetica Neue",sans-serif);--_gcd-button-font-size:var(--wp-ui-button-font-size);--_gcd-button-font-weight:var(--wp-ui-button-font-weight);align-items:center;aspect-ratio:var(--wp-ui-button-aspect-ratio);background-clip:border-box;background-color:var(--wp-ui-button-background-color);border-color:var(--wp-ui-button-border-color);border-radius:var(--wpds-border-radius-sm,2px);border-style:solid;border-width:1px;color:var(--wp-ui-button-foreground-color);display:inline-flex;font-family:var(--wpds-typography-font-family-body,-apple-system,system-ui,"Segoe UI","Roboto","Oxygen-Sans","Ubuntu","Cantarell","Helvetica Neue",sans-serif);font-size:var(--wp-ui-button-font-size);font-weight:var(--wp-ui-button-font-weight);gap:var(--wpds-dimension-gap-sm,8px);justify-content:center;line-height:var(--wpds-typography-line-height-sm,20px);max-width:100%;min-height:var(--wp-ui-button-height);min-width:var(--wp-ui-button-min-width);overflow-wrap:anywhere;padding-block:var(--wp-ui-button-padding-block);padding-inline:var(--wp-ui-button-padding-inline);position:relative;text-align:center;text-decoration:none;&:not([data-disabled]){cursor:var(--wpds-cursor-control,pointer)}@media not (prefers-reduced-motion){transition:color .1s ease-out;*{transition:opacity .1s ease-out}}&[href]{cursor:pointer}[href]{color:inherit;text-decoration:inherit}&:not([data-disabled]):is(:hover,:active,:focus){background-color:var(--wp-ui-button-background-color-active);border-color:var(--wp-ui-button-border-color-active);color:var(--wp-ui-button-foreground-color-active)}&[data-disabled]:not(._914b42f315c0e580__is-loading){background-color:var(--wp-ui-button-background-color-disabled);border-color:var(--wp-ui-button-border-color-disabled);color:var(--wp-ui-button-foreground-color-disabled);@media (forced-colors:active){border-bottom-color:GrayText;border-left-color:GrayText;border-right-color:GrayText;border-top-color:GrayText;color:GrayText}}&:before{aspect-ratio:1;border:var(--wpds-border-width-focus,var(--wp-admin-border-width-focus,2px)) solid;border-block-end-color:transparent;border-block-start-color:var(--wp-ui-button-foreground-color);border-inline-end-color:var(--wp-ui-button-foreground-color);border-inline-start-color:transparent;border-radius:50%;box-sizing:border-box;content:"";display:block;height:var(--wp-ui-button-font-size);inset-inline-start:50%;opacity:0;pointer-events:none;position:absolute;top:50%;transform:translate(-50%,-50%);@media not (prefers-reduced-motion){transition:opacity .1s ease-out}@media (forced-colors:active){border-block-end-style:none;border-bottom-color:ButtonText;border-inline-start-style:none;border-left-color:ButtonText;border-right-color:ButtonText;border-top-color:ButtonText}}}._908205475f9f2a92__is-small{--wp-ui-button-padding-block:0px;--wp-ui-button-padding-inline:var(--wpds-dimension-padding-sm,8px);--wp-ui-button-height:var(--wpds-dimension-size-sm,24px)}._9f6fc6553aeb36fe__icon{margin:var(--wp-ui-button-icon-margin)}.dd460c965226cc77__is-brand{&._62d5a778b7b258ee__is-outline,&.ad0619a3217c6a5b__is-minimal{--wp-ui-button-foreground-color:var(--wpds-color-foreground-interactive-brand,var(--wp-admin-theme-color,#3858e9));--wp-ui-button-foreground-color-active:var(--wpds-color-foreground-interactive-brand-active,color-mix(in oklch,var(--wp-admin-theme-color,#3858e9) 52%,#000));--wp-ui-button-foreground-color-disabled:var(--wpds-color-foreground-interactive-brand-disabled,#8d8d8d)}&._62d5a778b7b258ee__is-outline{--wp-ui-button-background-color:var(--wpds-color-background-interactive-brand-weak,#0000);--wp-ui-button-background-color-active:var(--wpds-color-background-interactive-brand-weak-active,color-mix(in oklch,var(--wp-admin-theme-color,#3858e9) 12%,#fff));--wp-ui-button-background-color-disabled:var(--wpds-color-background-interactive-brand-weak-disabled,#0000);--wp-ui-button-border-color:var(--wpds-color-stroke-interactive-brand,var(--wp-admin-theme-color,#3858e9));--wp-ui-button-border-color-active:var(--wpds-color-stroke-interactive-brand-active,color-mix(in oklch,var(--wp-admin-theme-color,#3858e9) 85%,#000));--wp-ui-button-border-color-disabled:var(--wpds-color-stroke-interactive-brand-disabled,#dbdbdb)}&.ad0619a3217c6a5b__is-minimal{--wp-ui-button-background-color:var(--wpds-color-background-interactive-brand-weak,#0000);--wp-ui-button-background-color-active:var(--wpds-color-background-interactive-brand-weak-active,color-mix(in oklch,var(--wp-admin-theme-color,#3858e9) 12%,#fff));--wp-ui-button-background-color-disabled:var(--wpds-color-background-interactive-brand-weak-disabled,#0000)}}.e722a8f96726aa99__is-neutral{&.ad0619a3217c6a5b__is-minimal[aria-pressed=true],&.b50b3358c5fb4d0b__is-solid{--wp-ui-button-background-color:var(--wpds-color-background-interactive-neutral-strong,#2d2d2d);--wp-ui-button-background-color-active:var(--wpds-color-background-interactive-neutral-strong-active,#1e1e1e);--wp-ui-button-background-color-disabled:var(--wpds-color-background-interactive-neutral-strong-disabled,#e6e6e6);--wp-ui-button-foreground-color:var(--wpds-color-foreground-interactive-neutral-strong,#f0f0f0);--wp-ui-button-foreground-color-active:var(--wpds-color-foreground-interactive-neutral-strong-active,#f0f0f0);--wp-ui-button-foreground-color-disabled:var(--wpds-color-foreground-interactive-neutral-strong-disabled,#8d8d8d)}&._62d5a778b7b258ee__is-outline,&.ad0619a3217c6a5b__is-minimal:not([aria-pressed=true]){--wp-ui-button-foreground-color:var(--wpds-color-foreground-interactive-neutral,#1e1e1e);--wp-ui-button-foreground-color-active:var(--wpds-color-foreground-interactive-neutral-active,#1e1e1e);--wp-ui-button-foreground-color-disabled:var(--wpds-color-foreground-interactive-neutral-disabled,#8d8d8d)}&._62d5a778b7b258ee__is-outline{--wp-ui-button-background-color:var(--wpds-color-background-interactive-neutral-weak,#0000);--wp-ui-button-background-color-active:var(--wpds-color-background-interactive-neutral-weak-active,#ededed);--wp-ui-button-background-color-disabled:var(--wpds-color-background-interactive-neutral-weak-disabled,#0000);--wp-ui-button-border-color:var(--wpds-color-stroke-interactive-neutral,#8d8d8d);--wp-ui-button-border-color-active:var(--wpds-color-stroke-interactive-neutral-active,#6e6e6e);--wp-ui-button-border-color-disabled:var(--wpds-color-stroke-interactive-neutral-disabled,#dbdbdb)}&.ad0619a3217c6a5b__is-minimal:not([aria-pressed=true]){--wp-ui-button-background-color:var(--wpds-color-background-interactive-neutral-weak,#0000);--wp-ui-button-background-color-active:var(--wpds-color-background-interactive-neutral-weak-active,#ededed);--wp-ui-button-background-color-disabled:var(--wpds-color-background-interactive-neutral-weak-disabled,#0000)}}.abbb272e2ce49bd6__is-unstyled{background:none;border:none;min-width:unset}.cf59cf1b69629838__is-compact{--wp-ui-button-height:var(--wpds-dimension-size-md,32px)}._914b42f315c0e580__is-loading:not(.abbb272e2ce49bd6__is-unstyled){color:transparent;&:not([data-disabled]):is(:hover,:active,:focus){color:transparent}@media (forced-colors:active){color:ButtonFace}*{opacity:0}&:before{opacity:1;transition-delay:.05s;@media not (prefers-reduced-motion){animation:_5a1d53da6f830c8d__loading-animation 1s linear infinite}}}}@keyframes _5a1d53da6f830c8d__loading-animation{0%{transform:translate(-50%,-50%) rotate(0deg)}to{transform:translate(-50%,-50%) rotate(1turn)}}}');
}
var style_default3 = { "button": "_97b0fc33c028be1a__button", "is-unstyled": "abbb272e2ce49bd6__is-unstyled", "is-loading": "_914b42f315c0e580__is-loading", "is-small": "_908205475f9f2a92__is-small", "icon": "_9f6fc6553aeb36fe__icon", "is-brand": "dd460c965226cc77__is-brand", "is-outline": "_62d5a778b7b258ee__is-outline", "is-minimal": "ad0619a3217c6a5b__is-minimal", "is-neutral": "e722a8f96726aa99__is-neutral", "is-solid": "b50b3358c5fb4d0b__is-solid", "is-compact": "cf59cf1b69629838__is-compact", "loading-animation": "_5a1d53da6f830c8d__loading-animation" };
if (typeof process === "undefined" || true) {
  registerStyle3("10f3806643", "@layer wp-ui{@layer utilities, components, compositions, overrides;@layer utilities{._336cd3e4e743482f__box-sizing{box-sizing:border-box;*,:after,:before{box-sizing:inherit}}}}");
}
var resets_default = { "box-sizing": "_336cd3e4e743482f__box-sizing" };
if (typeof process === "undefined" || true) {
  registerStyle3("da99a163ac", "@layer wp-ui{@layer utilities, components, compositions, overrides;@layer utilities{._08e8a2e44959f892__outset-ring--focus:focus,.c5cb3ee4bddaa8e4__outset-ring--focus-within-visible:focus-within:has(:focus-visible),.cd83dfc2126a0846__outset-ring--focus-within:focus-within,.d0541bc9dd9dc7b6__outset-ring--focus-visible:focus-visible,:focus-visible .ecadb9e080e2dfa5__outset-ring--focus-parent-visible{--_gcd-a-outline:var(--wpds-border-width-focus,var(--wp-admin-border-width-focus,2px)) solid var(--wpds-color-stroke-focus,var(--wp-admin-theme-color,#3858e9));--_gcd-div-outline:var(--wpds-border-width-focus,var(--wp-admin-border-width-focus,2px)) solid var(--wpds-color-stroke-focus,var(--wp-admin-theme-color,#3858e9));outline:var(--wpds-border-width-focus,var(--wp-admin-border-width-focus,2px)) solid var(--wpds-color-stroke-focus,var(--wp-admin-theme-color,#3858e9));outline-offset:var(--wpds-border-width-focus,var(--wp-admin-border-width-focus,2px))}._970d04df7376df67__outset-ring--focus-within-except-active:focus-within,.e25b2bdd7aa21721__outset-ring--focus-except-active:focus{outline:none}._970d04df7376df67__outset-ring--focus-within-except-active:focus-within:not(:has(:active)),.e25b2bdd7aa21721__outset-ring--focus-except-active:focus:not(:active){@include mixins.focus-ring()}}}");
}
var focus_default = { "outset-ring--focus": "_08e8a2e44959f892__outset-ring--focus", "outset-ring--focus-visible": "d0541bc9dd9dc7b6__outset-ring--focus-visible", "outset-ring--focus-within": "cd83dfc2126a0846__outset-ring--focus-within", "outset-ring--focus-within-visible": "c5cb3ee4bddaa8e4__outset-ring--focus-within-visible", "outset-ring--focus-parent-visible": "ecadb9e080e2dfa5__outset-ring--focus-parent-visible", "outset-ring--focus-except-active": "e25b2bdd7aa21721__outset-ring--focus-except-active", "outset-ring--focus-within-except-active": "_970d04df7376df67__outset-ring--focus-within-except-active" };
if (typeof process === "undefined" || true) {
  registerStyle3("af6d9984a6", "._6defc79820e382c6__button{box-sizing:var(--_gcd-button-box-sizing,border-box);font-family:var(--_gcd-button-font-family,inherit);font-size:var(--_gcd-button-font-size,inherit);font-weight:var(--_gcd-button-font-weight,inherit)}.d2cff2e5dea83bd1__input{box-sizing:var(--_gcd-input-box-sizing,border-box);font-family:var(--_gcd-input-font-family,inherit);font-size:var(--_gcd-input-font-size,inherit);font-weight:var(--_gcd-input-font-weight,inherit);margin:var(--_gcd-input-margin,0);&:is(textarea,[type=text],[type=password],[type=color],[type=date],[type=datetime],[type=datetime-local],[type=email],[type=month],[type=number],[type=search],[type=tel],[type=time],[type=url],[type=week]){background-color:var(--_gcd-input-background-color,transparent);border:var(--_gcd-input-border,none);border-radius:var(--_gcd-input-border-radius,0);box-shadow:var(--_gcd-input-box-shadow,0 0 0 transparent);color:var(--_gcd-input-color,var(--wpds-color-foreground-interactive-neutral,#1e1e1e));&:focus{border-color:var(--_gcd-input-border-color-focus,var(--wp-admin-theme-color));box-shadow:var(--_gcd-input-box-shadow-focus,none);outline:var(--_gcd-input-outline-focus,none)}&:disabled{background:var(--_gcd-input-background-disabled,transparent);border-color:var(--_gcd-input-border-color-disabled,transparent);box-shadow:var(--_gcd-input-box-shadow-disabled,none);color:var(--_gcd-input-color-disabled,var(--wpds-color-foreground-interactive-neutral-disabled,#8d8d8d))}&::placeholder{color:var(--_gcd-input-placeholder-color,var(--wpds-color-foreground-interactive-neutral-disabled,#8d8d8d))}}&:is(textarea,[type=text],[type=password],[type=date],[type=datetime],[type=datetime-local],[type=email],[type=month],[type=number],[type=search],[type=tel],[type=time],[type=url],[type=week]){line-height:var(--_gcd-input-line-height,inherit);min-height:var(--_gcd-input-min-height,auto);padding:var(--_gcd-input-padding,0)}}._547d86373d02e108__textarea{box-sizing:var(--_gcd-textarea-box-sizing,border-box);overflow:var(--_gcd-textarea-overflow,auto);resize:var(--_gcd-textarea-resize,block)}._8c15fd0ed9f28ba4__div{outline:var(--_gcd-div-outline,0 solid transparent)}p._43cec3e1eec1066d__p{font-size:var(--_gcd-p-font-size,13px);line-height:var(--_gcd-p-line-height,1.5);margin:var(--_gcd-p-margin,0)}:is(h1,h2,h3,h4,h5,h6).e97669c6d9a38497__heading{color:var(--_gcd-heading-color,var(--wpds-color-foreground-content-neutral,#1e1e1e));font-size:var(--_gcd-heading-font-size,inherit);font-weight:var(--_gcd-heading-font-weight,var(--wpds-typography-font-weight-emphasis,600));margin:var(--_gcd-heading-margin,0)}._2c0831b0499dbd6e__a,._2c0831b0499dbd6e__a:is(:hover,:focus,:active){border-radius:var(--_gcd-a-border-radius,0);box-shadow:var(--_gcd-a-box-shadow,none);color:var(--_gcd-a-color,inherit);outline:var(--_gcd-a-outline,0 solid transparent);transition:var(--_gcd-a-transition,none)}");
}
var global_css_defense_default2 = { "button": "_6defc79820e382c6__button", "input": "d2cff2e5dea83bd1__input", "textarea": "_547d86373d02e108__textarea", "div": "_8c15fd0ed9f28ba4__div", "p": "_43cec3e1eec1066d__p", "heading": "e97669c6d9a38497__heading", "a": "_2c0831b0499dbd6e__a" };
var Button3 = (0, import_element14.forwardRef)(
  function Button22({
    tone = "brand",
    variant = "solid",
    size: size4 = "default",
    className,
    focusableWhenDisabled = true,
    disabled: disabled2,
    loading,
    loadingAnnouncement = (0, import_i18n.__)("Loading"),
    children,
    ...props
  }, ref) {
    const mergedClassName = clsx_default(
      global_css_defense_default2.button,
      resets_default["box-sizing"],
      focus_default["outset-ring--focus-except-active"],
      variant !== "unstyled" && style_default3.button,
      style_default3[`is-${tone}`],
      style_default3[`is-${variant}`],
      style_default3[`is-${size4}`],
      loading && style_default3["is-loading"],
      className
    );
    (0, import_element14.useEffect)(() => {
      if (loading && loadingAnnouncement) {
        speak(loadingAnnouncement);
      }
    }, [loading, loadingAnnouncement]);
    return /* @__PURE__ */ (0, import_jsx_runtime20.jsx)(
      Button,
      {
        ref,
        className: mergedClassName,
        focusableWhenDisabled,
        disabled: disabled2 ?? loading,
        ...props,
        children
      }
    );
  }
);

// packages/ui/build-module/button/icon.mjs
var import_element16 = __toESM(require_element(), 1);

// packages/ui/build-module/icon/icon.mjs
var import_element15 = __toESM(require_element(), 1);
var import_primitives = __toESM(require_primitives(), 1);
var import_jsx_runtime21 = __toESM(require_jsx_runtime(), 1);
var Icon = (0, import_element15.forwardRef)(function Icon2({ icon, size: size4 = 24, ...restProps }, ref) {
  return /* @__PURE__ */ (0, import_jsx_runtime21.jsx)(
    import_primitives.SVG,
    {
      ref,
      ...icon.props,
      ...restProps,
      width: size4,
      height: size4
    }
  );
});

// packages/ui/build-module/button/icon.mjs
var import_jsx_runtime22 = __toESM(require_jsx_runtime(), 1);
var STYLE_HASH_ATTRIBUTE4 = "data-wp-hash";
function getRuntime4() {
  const globalScope = globalThis;
  if (globalScope.__wpStyleRuntime) {
    return globalScope.__wpStyleRuntime;
  }
  globalScope.__wpStyleRuntime = {
    documents: /* @__PURE__ */ new Map(),
    styles: /* @__PURE__ */ new Map(),
    injectedStyles: /* @__PURE__ */ new WeakMap()
  };
  if (typeof document !== "undefined") {
    registerDocument4(document);
  }
  return globalScope.__wpStyleRuntime;
}
function documentContainsStyleHash4(targetDocument, hash) {
  if (!targetDocument.head) {
    return false;
  }
  for (const style of targetDocument.head.querySelectorAll(
    `style[${STYLE_HASH_ATTRIBUTE4}]`
  )) {
    if (style.getAttribute(STYLE_HASH_ATTRIBUTE4) === hash) {
      return true;
    }
  }
  return false;
}
function injectStyle4(targetDocument, hash, css) {
  if (!targetDocument.head) {
    return;
  }
  const runtime = getRuntime4();
  let injectedStyles = runtime.injectedStyles.get(targetDocument);
  if (!injectedStyles) {
    injectedStyles = /* @__PURE__ */ new Set();
    runtime.injectedStyles.set(targetDocument, injectedStyles);
  }
  if (injectedStyles.has(hash)) {
    return;
  }
  if (documentContainsStyleHash4(targetDocument, hash)) {
    injectedStyles.add(hash);
    return;
  }
  const style = targetDocument.createElement("style");
  style.setAttribute(STYLE_HASH_ATTRIBUTE4, hash);
  style.appendChild(targetDocument.createTextNode(css));
  targetDocument.head.appendChild(style);
  injectedStyles.add(hash);
}
function registerDocument4(targetDocument) {
  const runtime = getRuntime4();
  runtime.documents.set(
    targetDocument,
    (runtime.documents.get(targetDocument) ?? 0) + 1
  );
  for (const [hash, css] of runtime.styles) {
    injectStyle4(targetDocument, hash, css);
  }
  return () => {
    const count = runtime.documents.get(targetDocument);
    if (count === void 0) {
      return;
    }
    if (count <= 1) {
      runtime.documents.delete(targetDocument);
      return;
    }
    runtime.documents.set(targetDocument, count - 1);
  };
}
function registerStyle4(hash, css) {
  const runtime = getRuntime4();
  runtime.styles.set(hash, css);
  for (const targetDocument of runtime.documents.keys()) {
    injectStyle4(targetDocument, hash, css);
  }
}
if (typeof process === "undefined" || true) {
  registerStyle4("b74f1ac304", '@layer wp-ui{@layer utilities, components, compositions, overrides;@layer components{._97b0fc33c028be1a__button,.abbb272e2ce49bd6__is-unstyled{appearance:none;padding:0}._97b0fc33c028be1a__button{--wp-ui-button-font-weight:var(--wpds-typography-font-weight-emphasis,600);--wp-ui-button-background-color:var(--wpds-color-background-interactive-brand-strong,var(--wp-admin-theme-color,#3858e9));--wp-ui-button-background-color-active:var(--wpds-color-background-interactive-brand-strong-active,color-mix(in oklch,var(--wp-admin-theme-color,#3858e9) 93%,#000));--wp-ui-button-background-color-disabled:var(--wpds-color-background-interactive-brand-strong-disabled,#e6e6e6);--wp-ui-button-foreground-color:var(--wpds-color-foreground-interactive-brand-strong,#fff);--wp-ui-button-foreground-color-active:var(--wpds-color-foreground-interactive-brand-strong-active,#fff);--wp-ui-button-foreground-color-disabled:var(--wpds-color-foreground-interactive-brand-strong-disabled,#8d8d8d);--wp-ui-button-padding-block:var(--wpds-dimension-padding-xs,4px);--wp-ui-button-padding-inline:var(--wpds-dimension-padding-md,12px);--wp-ui-button-height:var(--wpds-dimension-size-lg,40px);--wp-ui-button-aspect-ratio:auto;--wp-ui-button-font-size:var(--wpds-typography-font-size-md,13px);--wp-ui-button-min-width:calc(4ch + var(--wp-ui-button-padding-inline)*2);--wp-ui-button-icon-margin:calc((var(--wpds-dimension-size-2xs, 16px) - var(--wpds-dimension-size-sm, 24px))/2);--wp-ui-button-border-color:var(--wp-ui-button-background-color);--wp-ui-button-border-color-active:var(--wp-ui-button-background-color-active);--wp-ui-button-border-color-disabled:var(--wp-ui-button-background-color-disabled);--_gcd-button-font-family:var(--wpds-typography-font-family-body,-apple-system,system-ui,"Segoe UI","Roboto","Oxygen-Sans","Ubuntu","Cantarell","Helvetica Neue",sans-serif);--_gcd-button-font-size:var(--wp-ui-button-font-size);--_gcd-button-font-weight:var(--wp-ui-button-font-weight);align-items:center;aspect-ratio:var(--wp-ui-button-aspect-ratio);background-clip:border-box;background-color:var(--wp-ui-button-background-color);border-color:var(--wp-ui-button-border-color);border-radius:var(--wpds-border-radius-sm,2px);border-style:solid;border-width:1px;color:var(--wp-ui-button-foreground-color);display:inline-flex;font-family:var(--wpds-typography-font-family-body,-apple-system,system-ui,"Segoe UI","Roboto","Oxygen-Sans","Ubuntu","Cantarell","Helvetica Neue",sans-serif);font-size:var(--wp-ui-button-font-size);font-weight:var(--wp-ui-button-font-weight);gap:var(--wpds-dimension-gap-sm,8px);justify-content:center;line-height:var(--wpds-typography-line-height-sm,20px);max-width:100%;min-height:var(--wp-ui-button-height);min-width:var(--wp-ui-button-min-width);overflow-wrap:anywhere;padding-block:var(--wp-ui-button-padding-block);padding-inline:var(--wp-ui-button-padding-inline);position:relative;text-align:center;text-decoration:none;&:not([data-disabled]){cursor:var(--wpds-cursor-control,pointer)}@media not (prefers-reduced-motion){transition:color .1s ease-out;*{transition:opacity .1s ease-out}}&[href]{cursor:pointer}[href]{color:inherit;text-decoration:inherit}&:not([data-disabled]):is(:hover,:active,:focus){background-color:var(--wp-ui-button-background-color-active);border-color:var(--wp-ui-button-border-color-active);color:var(--wp-ui-button-foreground-color-active)}&[data-disabled]:not(._914b42f315c0e580__is-loading){background-color:var(--wp-ui-button-background-color-disabled);border-color:var(--wp-ui-button-border-color-disabled);color:var(--wp-ui-button-foreground-color-disabled);@media (forced-colors:active){border-bottom-color:GrayText;border-left-color:GrayText;border-right-color:GrayText;border-top-color:GrayText;color:GrayText}}&:before{aspect-ratio:1;border:var(--wpds-border-width-focus,var(--wp-admin-border-width-focus,2px)) solid;border-block-end-color:transparent;border-block-start-color:var(--wp-ui-button-foreground-color);border-inline-end-color:var(--wp-ui-button-foreground-color);border-inline-start-color:transparent;border-radius:50%;box-sizing:border-box;content:"";display:block;height:var(--wp-ui-button-font-size);inset-inline-start:50%;opacity:0;pointer-events:none;position:absolute;top:50%;transform:translate(-50%,-50%);@media not (prefers-reduced-motion){transition:opacity .1s ease-out}@media (forced-colors:active){border-block-end-style:none;border-bottom-color:ButtonText;border-inline-start-style:none;border-left-color:ButtonText;border-right-color:ButtonText;border-top-color:ButtonText}}}._908205475f9f2a92__is-small{--wp-ui-button-padding-block:0px;--wp-ui-button-padding-inline:var(--wpds-dimension-padding-sm,8px);--wp-ui-button-height:var(--wpds-dimension-size-sm,24px)}._9f6fc6553aeb36fe__icon{margin:var(--wp-ui-button-icon-margin)}.dd460c965226cc77__is-brand{&._62d5a778b7b258ee__is-outline,&.ad0619a3217c6a5b__is-minimal{--wp-ui-button-foreground-color:var(--wpds-color-foreground-interactive-brand,var(--wp-admin-theme-color,#3858e9));--wp-ui-button-foreground-color-active:var(--wpds-color-foreground-interactive-brand-active,color-mix(in oklch,var(--wp-admin-theme-color,#3858e9) 52%,#000));--wp-ui-button-foreground-color-disabled:var(--wpds-color-foreground-interactive-brand-disabled,#8d8d8d)}&._62d5a778b7b258ee__is-outline{--wp-ui-button-background-color:var(--wpds-color-background-interactive-brand-weak,#0000);--wp-ui-button-background-color-active:var(--wpds-color-background-interactive-brand-weak-active,color-mix(in oklch,var(--wp-admin-theme-color,#3858e9) 12%,#fff));--wp-ui-button-background-color-disabled:var(--wpds-color-background-interactive-brand-weak-disabled,#0000);--wp-ui-button-border-color:var(--wpds-color-stroke-interactive-brand,var(--wp-admin-theme-color,#3858e9));--wp-ui-button-border-color-active:var(--wpds-color-stroke-interactive-brand-active,color-mix(in oklch,var(--wp-admin-theme-color,#3858e9) 85%,#000));--wp-ui-button-border-color-disabled:var(--wpds-color-stroke-interactive-brand-disabled,#dbdbdb)}&.ad0619a3217c6a5b__is-minimal{--wp-ui-button-background-color:var(--wpds-color-background-interactive-brand-weak,#0000);--wp-ui-button-background-color-active:var(--wpds-color-background-interactive-brand-weak-active,color-mix(in oklch,var(--wp-admin-theme-color,#3858e9) 12%,#fff));--wp-ui-button-background-color-disabled:var(--wpds-color-background-interactive-brand-weak-disabled,#0000)}}.e722a8f96726aa99__is-neutral{&.ad0619a3217c6a5b__is-minimal[aria-pressed=true],&.b50b3358c5fb4d0b__is-solid{--wp-ui-button-background-color:var(--wpds-color-background-interactive-neutral-strong,#2d2d2d);--wp-ui-button-background-color-active:var(--wpds-color-background-interactive-neutral-strong-active,#1e1e1e);--wp-ui-button-background-color-disabled:var(--wpds-color-background-interactive-neutral-strong-disabled,#e6e6e6);--wp-ui-button-foreground-color:var(--wpds-color-foreground-interactive-neutral-strong,#f0f0f0);--wp-ui-button-foreground-color-active:var(--wpds-color-foreground-interactive-neutral-strong-active,#f0f0f0);--wp-ui-button-foreground-color-disabled:var(--wpds-color-foreground-interactive-neutral-strong-disabled,#8d8d8d)}&._62d5a778b7b258ee__is-outline,&.ad0619a3217c6a5b__is-minimal:not([aria-pressed=true]){--wp-ui-button-foreground-color:var(--wpds-color-foreground-interactive-neutral,#1e1e1e);--wp-ui-button-foreground-color-active:var(--wpds-color-foreground-interactive-neutral-active,#1e1e1e);--wp-ui-button-foreground-color-disabled:var(--wpds-color-foreground-interactive-neutral-disabled,#8d8d8d)}&._62d5a778b7b258ee__is-outline{--wp-ui-button-background-color:var(--wpds-color-background-interactive-neutral-weak,#0000);--wp-ui-button-background-color-active:var(--wpds-color-background-interactive-neutral-weak-active,#ededed);--wp-ui-button-background-color-disabled:var(--wpds-color-background-interactive-neutral-weak-disabled,#0000);--wp-ui-button-border-color:var(--wpds-color-stroke-interactive-neutral,#8d8d8d);--wp-ui-button-border-color-active:var(--wpds-color-stroke-interactive-neutral-active,#6e6e6e);--wp-ui-button-border-color-disabled:var(--wpds-color-stroke-interactive-neutral-disabled,#dbdbdb)}&.ad0619a3217c6a5b__is-minimal:not([aria-pressed=true]){--wp-ui-button-background-color:var(--wpds-color-background-interactive-neutral-weak,#0000);--wp-ui-button-background-color-active:var(--wpds-color-background-interactive-neutral-weak-active,#ededed);--wp-ui-button-background-color-disabled:var(--wpds-color-background-interactive-neutral-weak-disabled,#0000)}}.abbb272e2ce49bd6__is-unstyled{background:none;border:none;min-width:unset}.cf59cf1b69629838__is-compact{--wp-ui-button-height:var(--wpds-dimension-size-md,32px)}._914b42f315c0e580__is-loading:not(.abbb272e2ce49bd6__is-unstyled){color:transparent;&:not([data-disabled]):is(:hover,:active,:focus){color:transparent}@media (forced-colors:active){color:ButtonFace}*{opacity:0}&:before{opacity:1;transition-delay:.05s;@media not (prefers-reduced-motion){animation:_5a1d53da6f830c8d__loading-animation 1s linear infinite}}}}@keyframes _5a1d53da6f830c8d__loading-animation{0%{transform:translate(-50%,-50%) rotate(0deg)}to{transform:translate(-50%,-50%) rotate(1turn)}}}');
}
var style_default4 = { "button": "_97b0fc33c028be1a__button", "is-unstyled": "abbb272e2ce49bd6__is-unstyled", "is-loading": "_914b42f315c0e580__is-loading", "is-small": "_908205475f9f2a92__is-small", "icon": "_9f6fc6553aeb36fe__icon", "is-brand": "dd460c965226cc77__is-brand", "is-outline": "_62d5a778b7b258ee__is-outline", "is-minimal": "ad0619a3217c6a5b__is-minimal", "is-neutral": "e722a8f96726aa99__is-neutral", "is-solid": "b50b3358c5fb4d0b__is-solid", "is-compact": "cf59cf1b69629838__is-compact", "loading-animation": "_5a1d53da6f830c8d__loading-animation" };
var ButtonIcon = (0, import_element16.forwardRef)(
  function ButtonIcon2({ className, icon, ...props }, ref) {
    return /* @__PURE__ */ (0, import_jsx_runtime22.jsx)(
      Icon,
      {
        ref,
        icon,
        className: clsx_default(style_default4.icon, className),
        size: 24,
        ...props
      }
    );
  }
);

// packages/ui/build-module/button/index.mjs
ButtonIcon.displayName = "Button.Icon";
var Button4 = Object.assign(Button3, {
  /**
   * An icon component specifically designed to work well when rendered inside
   * a `Button` component.
   */
  Icon: ButtonIcon
});

// packages/icons/build-module/library/caution.mjs
var import_primitives2 = __toESM(require_primitives(), 1);
var import_jsx_runtime23 = __toESM(require_jsx_runtime(), 1);
var caution_default = /* @__PURE__ */ (0, import_jsx_runtime23.jsx)(import_primitives2.SVG, { xmlns: "http://www.w3.org/2000/svg", viewBox: "0 0 24 24", fill: "currentColor", children: /* @__PURE__ */ (0, import_jsx_runtime23.jsx)(import_primitives2.Path, { fillRule: "evenodd", clipRule: "evenodd", d: "M5.5 12a6.5 6.5 0 1 0 13 0 6.5 6.5 0 0 0-13 0ZM12 4a8 8 0 1 0 0 16 8 8 0 0 0 0-16Zm-.75 12v-1.5h1.5V16h-1.5Zm0-8v5h1.5V8h-1.5Z" }) });

// packages/icons/build-module/library/close-small.mjs
var import_primitives3 = __toESM(require_primitives(), 1);
var import_jsx_runtime24 = __toESM(require_jsx_runtime(), 1);
var close_small_default = /* @__PURE__ */ (0, import_jsx_runtime24.jsx)(import_primitives3.SVG, { xmlns: "http://www.w3.org/2000/svg", viewBox: "0 0 24 24", fill: "currentColor", children: /* @__PURE__ */ (0, import_jsx_runtime24.jsx)(import_primitives3.Path, { d: "M12 13.06l3.712 3.713 1.061-1.06L13.061 12l3.712-3.712-1.06-1.06L12 10.938 8.288 7.227l-1.061 1.06L10.939 12l-3.712 3.712 1.06 1.061L12 13.061z" }) });

// packages/icons/build-module/library/copy.mjs
var import_primitives4 = __toESM(require_primitives(), 1);
var import_jsx_runtime25 = __toESM(require_jsx_runtime(), 1);
var copy_default = /* @__PURE__ */ (0, import_jsx_runtime25.jsx)(import_primitives4.SVG, { xmlns: "http://www.w3.org/2000/svg", viewBox: "0 0 24 24", fill: "currentColor", children: /* @__PURE__ */ (0, import_jsx_runtime25.jsx)(import_primitives4.Path, { fillRule: "evenodd", clipRule: "evenodd", d: "M5 4.5h11a.5.5 0 0 1 .5.5v11a.5.5 0 0 1-.5.5H5a.5.5 0 0 1-.5-.5V5a.5.5 0 0 1 .5-.5ZM3 5a2 2 0 0 1 2-2h11a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5Zm17 3v10.75c0 .69-.56 1.25-1.25 1.25H6v1.5h12.75a2.75 2.75 0 0 0 2.75-2.75V8H20Z" }) });

// packages/icons/build-module/library/error.mjs
var import_primitives5 = __toESM(require_primitives(), 1);
var import_jsx_runtime26 = __toESM(require_jsx_runtime(), 1);
var error_default = /* @__PURE__ */ (0, import_jsx_runtime26.jsx)(import_primitives5.SVG, { xmlns: "http://www.w3.org/2000/svg", viewBox: "0 0 24 24", fill: "currentColor", children: /* @__PURE__ */ (0, import_jsx_runtime26.jsx)(import_primitives5.Path, { fillRule: "evenodd", clipRule: "evenodd", d: "M12.218 5.377a.25.25 0 0 0-.436 0l-7.29 12.96a.25.25 0 0 0 .218.373h14.58a.25.25 0 0 0 .218-.372l-7.29-12.96Zm-1.743-.735c.669-1.19 2.381-1.19 3.05 0l7.29 12.96a1.75 1.75 0 0 1-1.525 2.608H4.71a1.75 1.75 0 0 1-1.525-2.608l7.29-12.96ZM12.75 17.46h-1.5v-1.5h1.5v1.5Zm-1.5-3h1.5v-5h-1.5v5Z" }) });

// packages/icons/build-module/library/info.mjs
var import_primitives6 = __toESM(require_primitives(), 1);
var import_jsx_runtime27 = __toESM(require_jsx_runtime(), 1);
var info_default = /* @__PURE__ */ (0, import_jsx_runtime27.jsx)(import_primitives6.SVG, { xmlns: "http://www.w3.org/2000/svg", viewBox: "0 0 24 24", fill: "currentColor", children: /* @__PURE__ */ (0, import_jsx_runtime27.jsx)(import_primitives6.Path, { fillRule: "evenodd", clipRule: "evenodd", d: "M5.5 12a6.5 6.5 0 1 0 13 0 6.5 6.5 0 0 0-13 0ZM12 4a8 8 0 1 0 0 16 8 8 0 0 0 0-16Zm.75 4v1.5h-1.5V8h1.5Zm0 8v-5h-1.5v5h1.5Z" }) });

// packages/icons/build-module/library/pencil.mjs
var import_primitives7 = __toESM(require_primitives(), 1);
var import_jsx_runtime28 = __toESM(require_jsx_runtime(), 1);
var pencil_default = /* @__PURE__ */ (0, import_jsx_runtime28.jsx)(import_primitives7.SVG, { xmlns: "http://www.w3.org/2000/svg", viewBox: "0 0 24 24", fill: "currentColor", children: /* @__PURE__ */ (0, import_jsx_runtime28.jsx)(import_primitives7.Path, { d: "m19 7-3-3-8.5 8.5-1 4 4-1L19 7Zm-7 11.5H5V20h7v-1.5Z" }) });

// packages/icons/build-module/library/published.mjs
var import_primitives8 = __toESM(require_primitives(), 1);
var import_jsx_runtime29 = __toESM(require_jsx_runtime(), 1);
var published_default = /* @__PURE__ */ (0, import_jsx_runtime29.jsx)(import_primitives8.SVG, { xmlns: "http://www.w3.org/2000/svg", viewBox: "0 0 24 24", fill: "currentColor", children: /* @__PURE__ */ (0, import_jsx_runtime29.jsx)(import_primitives8.Path, { fillRule: "evenodd", clipRule: "evenodd", d: "M12 18.5a6.5 6.5 0 1 1 0-13 6.5 6.5 0 0 1 0 13ZM4 12a8 8 0 1 1 16 0 8 8 0 0 1-16 0Zm11.53-1.47-1.06-1.06L11 12.94l-1.47-1.47-1.06 1.06L11 15.06l4.53-4.53Z" }) });

// packages/icons/build-module/library/trash.mjs
var import_primitives9 = __toESM(require_primitives(), 1);
var import_jsx_runtime30 = __toESM(require_jsx_runtime(), 1);
var trash_default = /* @__PURE__ */ (0, import_jsx_runtime30.jsx)(import_primitives9.SVG, { xmlns: "http://www.w3.org/2000/svg", viewBox: "0 0 24 24", fill: "currentColor", children: /* @__PURE__ */ (0, import_jsx_runtime30.jsx)(import_primitives9.Path, { fillRule: "evenodd", clipRule: "evenodd", d: "M12 5.5A2.25 2.25 0 0 0 9.878 7h4.244A2.251 2.251 0 0 0 12 5.5ZM12 4a3.751 3.751 0 0 0-3.675 3H5v1.5h1.27l.818 8.997a2.75 2.75 0 0 0 2.739 2.501h4.347a2.75 2.75 0 0 0 2.738-2.5L17.73 8.5H19V7h-3.325A3.751 3.751 0 0 0 12 4Zm4.224 4.5H7.776l.806 8.861a1.25 1.25 0 0 0 1.245 1.137h4.347a1.25 1.25 0 0 0 1.245-1.137l.805-8.861Z" }) });

// packages/ui/build-module/utils/render-slot-with-children.mjs
var import_element17 = __toESM(require_element(), 1);
function renderSlotWithChildren(slot, defaultSlot, children) {
  return (0, import_element17.cloneElement)(slot ?? defaultSlot, { children });
}

// packages/ui/build-module/utils/use-deprioritized-initial-focus.mjs
var import_element18 = __toESM(require_element(), 1);

// node_modules/tabbable/dist/index.esm.js
var candidateSelectors = ["input:not([inert]):not([inert] *)", "select:not([inert]):not([inert] *)", "textarea:not([inert]):not([inert] *)", "a[href]:not([inert]):not([inert] *)", "button:not([inert]):not([inert] *)", "[tabindex]:not(slot):not([inert]):not([inert] *)", "audio[controls]:not([inert]):not([inert] *)", "video[controls]:not([inert]):not([inert] *)", '[contenteditable]:not([contenteditable="false"]):not([inert]):not([inert] *)', "details>summary:first-of-type:not([inert]):not([inert] *)", "details:not([inert]):not([inert] *)"];
var candidateSelector = /* @__PURE__ */ candidateSelectors.join(",");
var NoElement = typeof Element === "undefined";
var matches = NoElement ? function() {
} : Element.prototype.matches || Element.prototype.msMatchesSelector || Element.prototype.webkitMatchesSelector;
var getRootNode = !NoElement && Element.prototype.getRootNode ? function(element) {
  var _element$getRootNode;
  return element === null || element === void 0 ? void 0 : (_element$getRootNode = element.getRootNode) === null || _element$getRootNode === void 0 ? void 0 : _element$getRootNode.call(element);
} : function(element) {
  return element === null || element === void 0 ? void 0 : element.ownerDocument;
};
var _isInert = function isInert(node, lookUp) {
  var _node$getAttribute;
  if (lookUp === void 0) {
    lookUp = true;
  }
  var inertAtt = node === null || node === void 0 ? void 0 : (_node$getAttribute = node.getAttribute) === null || _node$getAttribute === void 0 ? void 0 : _node$getAttribute.call(node, "inert");
  var inert = inertAtt === "" || inertAtt === "true";
  var result = inert || lookUp && node && // closest does not exist on shadow roots, so we fall back to a manual
  // lookup upward, in case it is not defined.
  (typeof node.closest === "function" ? node.closest("[inert]") : _isInert(node.parentNode));
  return result;
};
var isContentEditable = function isContentEditable2(node) {
  var _node$getAttribute2;
  var attValue = node === null || node === void 0 ? void 0 : (_node$getAttribute2 = node.getAttribute) === null || _node$getAttribute2 === void 0 ? void 0 : _node$getAttribute2.call(node, "contenteditable");
  return attValue === "" || attValue === "true";
};
var getCandidates = function getCandidates2(el, includeContainer, filter) {
  if (_isInert(el)) {
    return [];
  }
  var candidates = Array.prototype.slice.apply(el.querySelectorAll(candidateSelector));
  if (includeContainer && matches.call(el, candidateSelector)) {
    candidates.unshift(el);
  }
  candidates = candidates.filter(filter);
  return candidates;
};
var _getCandidatesIteratively = function getCandidatesIteratively(elements, includeContainer, options) {
  var candidates = [];
  var elementsToCheck = Array.from(elements);
  while (elementsToCheck.length) {
    var element = elementsToCheck.shift();
    if (_isInert(element, false)) {
      continue;
    }
    if (element.tagName === "SLOT") {
      var assigned = element.assignedElements();
      var content = assigned.length ? assigned : element.children;
      var nestedCandidates = _getCandidatesIteratively(content, true, options);
      if (options.flatten) {
        candidates.push.apply(candidates, nestedCandidates);
      } else {
        candidates.push({
          scopeParent: element,
          candidates: nestedCandidates
        });
      }
    } else {
      var validCandidate = matches.call(element, candidateSelector);
      if (validCandidate && options.filter(element) && (includeContainer || !elements.includes(element))) {
        candidates.push(element);
      }
      var shadowRoot = element.shadowRoot || // check for an undisclosed shadow
      typeof options.getShadowRoot === "function" && options.getShadowRoot(element);
      var validShadowRoot = !_isInert(shadowRoot, false) && (!options.shadowRootFilter || options.shadowRootFilter(element));
      if (shadowRoot && validShadowRoot) {
        var _nestedCandidates = _getCandidatesIteratively(shadowRoot === true ? element.children : shadowRoot.children, true, options);
        if (options.flatten) {
          candidates.push.apply(candidates, _nestedCandidates);
        } else {
          candidates.push({
            scopeParent: element,
            candidates: _nestedCandidates
          });
        }
      } else {
        elementsToCheck.unshift.apply(elementsToCheck, element.children);
      }
    }
  }
  return candidates;
};
var hasTabIndex = function hasTabIndex2(node) {
  return !isNaN(parseInt(node.getAttribute("tabindex"), 10));
};
var getTabIndex2 = function getTabIndex3(node) {
  if (!node) {
    throw new Error("No node provided");
  }
  if (node.tabIndex < 0) {
    if ((/^(AUDIO|VIDEO|DETAILS)$/.test(node.tagName) || isContentEditable(node)) && !hasTabIndex(node)) {
      return 0;
    }
  }
  return node.tabIndex;
};
var getSortOrderTabIndex = function getSortOrderTabIndex2(node, isScope) {
  var tabIndex = getTabIndex2(node);
  if (tabIndex < 0 && isScope && !hasTabIndex(node)) {
    return 0;
  }
  return tabIndex;
};
var sortOrderedTabbables = function sortOrderedTabbables2(a, b) {
  return a.tabIndex === b.tabIndex ? a.documentOrder - b.documentOrder : a.tabIndex - b.tabIndex;
};
var isInput = function isInput2(node) {
  return node.tagName === "INPUT";
};
var isHiddenInput = function isHiddenInput2(node) {
  return isInput(node) && node.type === "hidden";
};
var isDetailsWithSummary = function isDetailsWithSummary2(node) {
  var r2 = node.tagName === "DETAILS" && Array.prototype.slice.apply(node.children).some(function(child) {
    return child.tagName === "SUMMARY";
  });
  return r2;
};
var getCheckedRadio = function getCheckedRadio2(nodes, form) {
  for (var i = 0; i < nodes.length; i++) {
    if (nodes[i].checked && nodes[i].form === form) {
      return nodes[i];
    }
  }
};
var isTabbableRadio2 = function isTabbableRadio3(node) {
  if (!node.name) {
    return true;
  }
  var radioScope = node.form || getRootNode(node);
  var queryRadios = function queryRadios2(name) {
    return radioScope.querySelectorAll('input[type="radio"][name="' + name + '"]');
  };
  var radioSet;
  if (typeof window !== "undefined" && typeof window.CSS !== "undefined" && typeof window.CSS.escape === "function") {
    radioSet = queryRadios(window.CSS.escape(node.name));
  } else {
    try {
      radioSet = queryRadios(node.name);
    } catch (err) {
      console.error("Looks like you have a radio button with a name attribute containing invalid CSS selector characters and need the CSS.escape polyfill: %s", err.message);
      return false;
    }
  }
  var checked = getCheckedRadio(radioSet, node.form);
  return !checked || checked === node;
};
var isRadio = function isRadio2(node) {
  return isInput(node) && node.type === "radio";
};
var isNonTabbableRadio = function isNonTabbableRadio2(node) {
  return isRadio(node) && !isTabbableRadio2(node);
};
var isNodeAttached = function isNodeAttached2(node) {
  var _nodeRoot;
  var nodeRoot = node && getRootNode(node);
  var nodeRootHost = (_nodeRoot = nodeRoot) === null || _nodeRoot === void 0 ? void 0 : _nodeRoot.host;
  var attached = false;
  if (nodeRoot && nodeRoot !== node) {
    var _nodeRootHost, _nodeRootHost$ownerDo, _node$ownerDocument;
    attached = !!((_nodeRootHost = nodeRootHost) !== null && _nodeRootHost !== void 0 && (_nodeRootHost$ownerDo = _nodeRootHost.ownerDocument) !== null && _nodeRootHost$ownerDo !== void 0 && _nodeRootHost$ownerDo.contains(nodeRootHost) || node !== null && node !== void 0 && (_node$ownerDocument = node.ownerDocument) !== null && _node$ownerDocument !== void 0 && _node$ownerDocument.contains(node));
    while (!attached && nodeRootHost) {
      var _nodeRoot2, _nodeRootHost2, _nodeRootHost2$ownerD;
      nodeRoot = getRootNode(nodeRootHost);
      nodeRootHost = (_nodeRoot2 = nodeRoot) === null || _nodeRoot2 === void 0 ? void 0 : _nodeRoot2.host;
      attached = !!((_nodeRootHost2 = nodeRootHost) !== null && _nodeRootHost2 !== void 0 && (_nodeRootHost2$ownerD = _nodeRootHost2.ownerDocument) !== null && _nodeRootHost2$ownerD !== void 0 && _nodeRootHost2$ownerD.contains(nodeRootHost));
    }
  }
  return attached;
};
var isZeroArea = function isZeroArea2(node) {
  var _node$getBoundingClie = node.getBoundingClientRect(), width = _node$getBoundingClie.width, height = _node$getBoundingClie.height;
  return width === 0 && height === 0;
};
var isHidden = function isHidden2(node, _ref) {
  var displayCheck = _ref.displayCheck, getShadowRoot = _ref.getShadowRoot;
  if (displayCheck === "full-native") {
    if ("checkVisibility" in node) {
      var visible = node.checkVisibility({
        // Checking opacity might be desirable for some use cases, but natively,
        // opacity zero elements _are_ focusable and tabbable.
        checkOpacity: false,
        opacityProperty: false,
        contentVisibilityAuto: true,
        visibilityProperty: true,
        // This is an alias for `visibilityProperty`. Contemporary browsers
        // support both. However, this alias has wider browser support (Chrome
        // >= 105 and Firefox >= 106, vs. Chrome >= 121 and Firefox >= 122), so
        // we include it anyway.
        checkVisibilityCSS: true
      });
      return !visible;
    }
  }
  if (getComputedStyle(node).visibility === "hidden") {
    return true;
  }
  var isDirectSummary = matches.call(node, "details>summary:first-of-type");
  var nodeUnderDetails = isDirectSummary ? node.parentElement : node;
  if (matches.call(nodeUnderDetails, "details:not([open]) *")) {
    return true;
  }
  if (!displayCheck || displayCheck === "full" || // full-native can run this branch when it falls through in case
  // Element#checkVisibility is unsupported
  displayCheck === "full-native" || displayCheck === "legacy-full") {
    if (typeof getShadowRoot === "function") {
      var originalNode = node;
      while (node) {
        var parentElement = node.parentElement;
        var rootNode = getRootNode(node);
        if (parentElement && !parentElement.shadowRoot && getShadowRoot(parentElement) === true) {
          return isZeroArea(node);
        } else if (node.assignedSlot) {
          node = node.assignedSlot;
        } else if (!parentElement && rootNode !== node.ownerDocument) {
          node = rootNode.host;
        } else {
          node = parentElement;
        }
      }
      node = originalNode;
    }
    if (isNodeAttached(node)) {
      return !node.getClientRects().length;
    }
    if (displayCheck !== "legacy-full") {
      return true;
    }
  } else if (displayCheck === "non-zero-area") {
    return isZeroArea(node);
  }
  return false;
};
var isDisabledFromFieldset = function isDisabledFromFieldset2(node) {
  if (/^(INPUT|BUTTON|SELECT|TEXTAREA)$/.test(node.tagName)) {
    var parentNode = node.parentElement;
    while (parentNode) {
      if (parentNode.tagName === "FIELDSET" && parentNode.disabled) {
        for (var i = 0; i < parentNode.children.length; i++) {
          var child = parentNode.children.item(i);
          if (child.tagName === "LEGEND") {
            return matches.call(parentNode, "fieldset[disabled] *") ? true : !child.contains(node);
          }
        }
        return true;
      }
      parentNode = parentNode.parentElement;
    }
  }
  return false;
};
var isNodeMatchingSelectorFocusable = function isNodeMatchingSelectorFocusable2(options, node) {
  if (node.disabled || isHiddenInput(node) || isHidden(node, options) || // For a details element with a summary, the summary element gets the focus
  isDetailsWithSummary(node) || isDisabledFromFieldset(node)) {
    return false;
  }
  return true;
};
var isNodeMatchingSelectorTabbable = function isNodeMatchingSelectorTabbable2(options, node) {
  if (isNonTabbableRadio(node) || getTabIndex2(node) < 0 || !isNodeMatchingSelectorFocusable(options, node)) {
    return false;
  }
  return true;
};
var isShadowRootTabbable = function isShadowRootTabbable2(shadowHostNode) {
  var tabIndex = parseInt(shadowHostNode.getAttribute("tabindex"), 10);
  if (isNaN(tabIndex) || tabIndex >= 0) {
    return true;
  }
  return false;
};
var _sortByOrder = function sortByOrder(candidates) {
  var regularTabbables = [];
  var orderedTabbables = [];
  candidates.forEach(function(item, i) {
    var isScope = !!item.scopeParent;
    var element = isScope ? item.scopeParent : item;
    var candidateTabindex = getSortOrderTabIndex(element, isScope);
    var elements = isScope ? _sortByOrder(item.candidates) : element;
    if (candidateTabindex === 0) {
      isScope ? regularTabbables.push.apply(regularTabbables, elements) : regularTabbables.push(element);
    } else {
      orderedTabbables.push({
        documentOrder: i,
        tabIndex: candidateTabindex,
        item,
        isScope,
        content: elements
      });
    }
  });
  return orderedTabbables.sort(sortOrderedTabbables).reduce(function(acc, sortable) {
    sortable.isScope ? acc.push.apply(acc, sortable.content) : acc.push(sortable.content);
    return acc;
  }, []).concat(regularTabbables);
};
var tabbable2 = function tabbable3(container, options) {
  options = options || {};
  var candidates;
  if (options.getShadowRoot) {
    candidates = _getCandidatesIteratively([container], options.includeContainer, {
      filter: isNodeMatchingSelectorTabbable.bind(null, options),
      flatten: false,
      getShadowRoot: options.getShadowRoot,
      shadowRootFilter: isShadowRootTabbable
    });
  } else {
    candidates = getCandidates(container, options.includeContainer, isNodeMatchingSelectorTabbable.bind(null, options));
  }
  return _sortByOrder(candidates);
};

// packages/ui/build-module/utils/use-deprioritized-initial-focus.mjs
var getTabbableOptions = () => ({
  getShadowRoot: true,
  displayCheck: typeof ResizeObserver === "function" && ResizeObserver.toString().includes("[native code]") ? "full" : "none"
});
function useDeprioritizedInitialFocus({
  initialFocus,
  deprioritizedAttributes
}) {
  const popupRef = (0, import_element18.useRef)(null);
  let resolvedInitialFocus = initialFocus;
  if (initialFocus === void 0 || initialFocus === true) {
    resolvedInitialFocus = (interactionType) => {
      if (interactionType === "touch") {
        return popupRef.current ?? true;
      }
      const popup = popupRef.current;
      if (!popup) {
        return true;
      }
      const tabbables = tabbable2(popup, getTabbableOptions());
      for (const el of tabbables) {
        if (el instanceof HTMLElement && !deprioritizedAttributes.some(
          (attr2) => el.hasAttribute(attr2)
        )) {
          return el;
        }
      }
      return true;
    };
  }
  return { resolvedInitialFocus, popupRef };
}

// packages/ui/build-module/utils/theme-provider.mjs
var theme = __toESM(require_theme(), 1);

// packages/ui/build-module/lock-unlock.mjs
var import_private_apis = __toESM(require_private_apis(), 1);
var { lock, unlock } = (0, import_private_apis.__dangerousOptInToUnstableAPIsOnlyForCoreModules)(
  "I acknowledge private features are not for use in themes or plugins and doing so will break in the next version of Retraceur.",
  "@wordpress/ui"
);

// packages/ui/build-module/utils/theme-provider.mjs
function getThemeProvider() {
  const themePackage = theme;
  if (themePackage.ThemeProvider) {
    return themePackage.ThemeProvider;
  }
  if (!themePackage.privateApis) {
    throw new Error(
      "@wordpress/ui: @wordpress/theme must expose `ThemeProvider` or `privateApis.ThemeProvider`."
    );
  }
  return unlock(
    themePackage.privateApis
  ).ThemeProvider;
}
var ThemeProvider = getThemeProvider();

// packages/ui/build-module/stack/stack.mjs
var import_element19 = __toESM(require_element(), 1);
var STYLE_HASH_ATTRIBUTE5 = "data-wp-hash";
function getRuntime5() {
  const globalScope = globalThis;
  if (globalScope.__wpStyleRuntime) {
    return globalScope.__wpStyleRuntime;
  }
  globalScope.__wpStyleRuntime = {
    documents: /* @__PURE__ */ new Map(),
    styles: /* @__PURE__ */ new Map(),
    injectedStyles: /* @__PURE__ */ new WeakMap()
  };
  if (typeof document !== "undefined") {
    registerDocument5(document);
  }
  return globalScope.__wpStyleRuntime;
}
function documentContainsStyleHash5(targetDocument, hash) {
  if (!targetDocument.head) {
    return false;
  }
  for (const style of targetDocument.head.querySelectorAll(
    `style[${STYLE_HASH_ATTRIBUTE5}]`
  )) {
    if (style.getAttribute(STYLE_HASH_ATTRIBUTE5) === hash) {
      return true;
    }
  }
  return false;
}
function injectStyle5(targetDocument, hash, css) {
  if (!targetDocument.head) {
    return;
  }
  const runtime = getRuntime5();
  let injectedStyles = runtime.injectedStyles.get(targetDocument);
  if (!injectedStyles) {
    injectedStyles = /* @__PURE__ */ new Set();
    runtime.injectedStyles.set(targetDocument, injectedStyles);
  }
  if (injectedStyles.has(hash)) {
    return;
  }
  if (documentContainsStyleHash5(targetDocument, hash)) {
    injectedStyles.add(hash);
    return;
  }
  const style = targetDocument.createElement("style");
  style.setAttribute(STYLE_HASH_ATTRIBUTE5, hash);
  style.appendChild(targetDocument.createTextNode(css));
  targetDocument.head.appendChild(style);
  injectedStyles.add(hash);
}
function registerDocument5(targetDocument) {
  const runtime = getRuntime5();
  runtime.documents.set(
    targetDocument,
    (runtime.documents.get(targetDocument) ?? 0) + 1
  );
  for (const [hash, css] of runtime.styles) {
    injectStyle5(targetDocument, hash, css);
  }
  return () => {
    const count = runtime.documents.get(targetDocument);
    if (count === void 0) {
      return;
    }
    if (count <= 1) {
      runtime.documents.delete(targetDocument);
      return;
    }
    runtime.documents.set(targetDocument, count - 1);
  };
}
function registerStyle5(hash, css) {
  const runtime = getRuntime5();
  runtime.styles.set(hash, css);
  for (const targetDocument of runtime.documents.keys()) {
    injectStyle5(targetDocument, hash, css);
  }
}
if (typeof process === "undefined" || true) {
  registerStyle5("32aba35fe1", "@layer wp-ui{@layer utilities, components, compositions, overrides;@layer components{._19ce0419607e1896__stack{display:flex}}}");
}
var style_default5 = { "stack": "_19ce0419607e1896__stack" };
var gapTokens = {
  xs: "var(--wpds-dimension-gap-xs, 4px)",
  sm: "var(--wpds-dimension-gap-sm, 8px)",
  md: "var(--wpds-dimension-gap-md, 12px)",
  lg: "var(--wpds-dimension-gap-lg, 16px)",
  xl: "var(--wpds-dimension-gap-xl, 24px)",
  "2xl": "var(--wpds-dimension-gap-2xl, 32px)",
  "3xl": "var(--wpds-dimension-gap-3xl, 40px)"
};
var Stack = (0, import_element19.forwardRef)(function Stack2({ direction, gap, align, justify, wrap, render, ...props }, ref) {
  const style = {
    gap: gap && gapTokens[gap],
    alignItems: align,
    justifyContent: justify,
    flexDirection: direction,
    flexWrap: wrap
  };
  const element = useRender({
    render,
    ref,
    props: mergeProps(props, { style, className: style_default5.stack })
  });
  return element;
});

// packages/ui/build-module/icon-button/icon-button.mjs
var import_element24 = __toESM(require_element(), 1);

// packages/ui/build-module/tooltip/index.mjs
var tooltip_exports = {};
__export(tooltip_exports, {
  Popup: () => Popup,
  Portal: () => Portal,
  Positioner: () => Positioner,
  Provider: () => Provider,
  Root: () => Root,
  Trigger: () => Trigger
});

// packages/ui/build-module/tooltip/popup.mjs
var import_element22 = __toESM(require_element(), 1);

// packages/ui/build-module/tooltip/portal.mjs
var import_element20 = __toESM(require_element(), 1);

// packages/ui/build-module/utils/wp-compat-overlay-slot.mjs
var STYLE_HASH_ATTRIBUTE6 = "data-wp-hash";
function getRuntime6() {
  const globalScope = globalThis;
  if (globalScope.__wpStyleRuntime) {
    return globalScope.__wpStyleRuntime;
  }
  globalScope.__wpStyleRuntime = {
    documents: /* @__PURE__ */ new Map(),
    styles: /* @__PURE__ */ new Map(),
    injectedStyles: /* @__PURE__ */ new WeakMap()
  };
  if (typeof document !== "undefined") {
    registerDocument6(document);
  }
  return globalScope.__wpStyleRuntime;
}
function documentContainsStyleHash6(targetDocument, hash) {
  if (!targetDocument.head) {
    return false;
  }
  for (const style of targetDocument.head.querySelectorAll(
    `style[${STYLE_HASH_ATTRIBUTE6}]`
  )) {
    if (style.getAttribute(STYLE_HASH_ATTRIBUTE6) === hash) {
      return true;
    }
  }
  return false;
}
function injectStyle6(targetDocument, hash, css) {
  if (!targetDocument.head) {
    return;
  }
  const runtime = getRuntime6();
  let injectedStyles = runtime.injectedStyles.get(targetDocument);
  if (!injectedStyles) {
    injectedStyles = /* @__PURE__ */ new Set();
    runtime.injectedStyles.set(targetDocument, injectedStyles);
  }
  if (injectedStyles.has(hash)) {
    return;
  }
  if (documentContainsStyleHash6(targetDocument, hash)) {
    injectedStyles.add(hash);
    return;
  }
  const style = targetDocument.createElement("style");
  style.setAttribute(STYLE_HASH_ATTRIBUTE6, hash);
  style.appendChild(targetDocument.createTextNode(css));
  targetDocument.head.appendChild(style);
  injectedStyles.add(hash);
}
function registerDocument6(targetDocument) {
  const runtime = getRuntime6();
  runtime.documents.set(
    targetDocument,
    (runtime.documents.get(targetDocument) ?? 0) + 1
  );
  for (const [hash, css] of runtime.styles) {
    injectStyle6(targetDocument, hash, css);
  }
  return () => {
    const count = runtime.documents.get(targetDocument);
    if (count === void 0) {
      return;
    }
    if (count <= 1) {
      runtime.documents.delete(targetDocument);
      return;
    }
    runtime.documents.set(targetDocument, count - 1);
  };
}
function registerStyle6(hash, css) {
  const runtime = getRuntime6();
  runtime.styles.set(hash, css);
  for (const targetDocument of runtime.documents.keys()) {
    injectStyle6(targetDocument, hash, css);
  }
}
if (typeof process === "undefined" || true) {
  registerStyle6("be37f31c1e", "._11fc52b637ff8a7e__slot{inset:0;isolation:isolate;pointer-events:none;position:fixed;z-index:1000000003}@layer wp-ui{@layer utilities, components, compositions, overrides;@layer utilities{._11fc52b637ff8a7e__slot>*{pointer-events:auto}}}");
}
var wp_compat_overlay_slot_default = { "slot": "_11fc52b637ff8a7e__slot" };
var WP_COMPAT_OVERLAY_SLOT_ATTRIBUTE = "data-wp-compat-overlay-slot";
function resolveOwnerDocument() {
  return typeof document === "undefined" ? null : document;
}
function isInWPEnvironment() {
  let topWp;
  try {
    topWp = window.top?.wp;
  } catch {
  }
  const wp = topWp ?? window.wp;
  return typeof wp?.components === "object" && wp.components !== null;
}
var cachedSlot = null;
function ensureSlotIsAccessible(element) {
  element.setAttribute("aria-hidden", "false");
  return element;
}
function createSlot(ownerDocument2) {
  const element = ownerDocument2.createElement("div");
  element.setAttribute(WP_COMPAT_OVERLAY_SLOT_ATTRIBUTE, "");
  if (wp_compat_overlay_slot_default.slot) {
    element.classList.add(wp_compat_overlay_slot_default.slot);
  }
  ownerDocument2.body.appendChild(element);
  return element;
}
function getWpCompatOverlaySlot() {
  if (typeof window === "undefined") {
    return void 0;
  }
  if (!isInWPEnvironment() && window.__wpUiCompatOverlaySlotEnabled !== true) {
    return void 0;
  }
  const ownerDocument2 = resolveOwnerDocument();
  if (!ownerDocument2 || !ownerDocument2.body) {
    return void 0;
  }
  if (cachedSlot && cachedSlot.ownerDocument === ownerDocument2 && cachedSlot.isConnected) {
    return ensureSlotIsAccessible(cachedSlot);
  }
  const existing = ownerDocument2.querySelector(
    `[${WP_COMPAT_OVERLAY_SLOT_ATTRIBUTE}]`
  );
  if (existing instanceof HTMLDivElement) {
    cachedSlot = ensureSlotIsAccessible(existing);
    return cachedSlot;
  }
  if (cachedSlot?.isConnected) {
    cachedSlot.remove();
  }
  cachedSlot = ensureSlotIsAccessible(createSlot(ownerDocument2));
  return cachedSlot;
}

// packages/ui/build-module/tooltip/portal.mjs
var import_jsx_runtime31 = __toESM(require_jsx_runtime(), 1);
var Portal = (0, import_element20.forwardRef)(
  function TooltipPortal3({ container, ...restProps }, ref) {
    return /* @__PURE__ */ (0, import_jsx_runtime31.jsx)(
      index_parts_exports2.Portal,
      {
        container: container ?? getWpCompatOverlaySlot(),
        ...restProps,
        ref
      }
    );
  }
);

// packages/ui/build-module/tooltip/positioner.mjs
var import_element21 = __toESM(require_element(), 1);
var import_jsx_runtime32 = __toESM(require_jsx_runtime(), 1);
var STYLE_HASH_ATTRIBUTE7 = "data-wp-hash";
function getRuntime7() {
  const globalScope = globalThis;
  if (globalScope.__wpStyleRuntime) {
    return globalScope.__wpStyleRuntime;
  }
  globalScope.__wpStyleRuntime = {
    documents: /* @__PURE__ */ new Map(),
    styles: /* @__PURE__ */ new Map(),
    injectedStyles: /* @__PURE__ */ new WeakMap()
  };
  if (typeof document !== "undefined") {
    registerDocument7(document);
  }
  return globalScope.__wpStyleRuntime;
}
function documentContainsStyleHash7(targetDocument, hash) {
  if (!targetDocument.head) {
    return false;
  }
  for (const style of targetDocument.head.querySelectorAll(
    `style[${STYLE_HASH_ATTRIBUTE7}]`
  )) {
    if (style.getAttribute(STYLE_HASH_ATTRIBUTE7) === hash) {
      return true;
    }
  }
  return false;
}
function injectStyle7(targetDocument, hash, css) {
  if (!targetDocument.head) {
    return;
  }
  const runtime = getRuntime7();
  let injectedStyles = runtime.injectedStyles.get(targetDocument);
  if (!injectedStyles) {
    injectedStyles = /* @__PURE__ */ new Set();
    runtime.injectedStyles.set(targetDocument, injectedStyles);
  }
  if (injectedStyles.has(hash)) {
    return;
  }
  if (documentContainsStyleHash7(targetDocument, hash)) {
    injectedStyles.add(hash);
    return;
  }
  const style = targetDocument.createElement("style");
  style.setAttribute(STYLE_HASH_ATTRIBUTE7, hash);
  style.appendChild(targetDocument.createTextNode(css));
  targetDocument.head.appendChild(style);
  injectedStyles.add(hash);
}
function registerDocument7(targetDocument) {
  const runtime = getRuntime7();
  runtime.documents.set(
    targetDocument,
    (runtime.documents.get(targetDocument) ?? 0) + 1
  );
  for (const [hash, css] of runtime.styles) {
    injectStyle7(targetDocument, hash, css);
  }
  return () => {
    const count = runtime.documents.get(targetDocument);
    if (count === void 0) {
      return;
    }
    if (count <= 1) {
      runtime.documents.delete(targetDocument);
      return;
    }
    runtime.documents.set(targetDocument, count - 1);
  };
}
function registerStyle7(hash, css) {
  const runtime = getRuntime7();
  runtime.styles.set(hash, css);
  for (const targetDocument of runtime.documents.keys()) {
    injectStyle7(targetDocument, hash, css);
  }
}
if (typeof process === "undefined" || true) {
  registerStyle7("10f3806643", "@layer wp-ui{@layer utilities, components, compositions, overrides;@layer utilities{._336cd3e4e743482f__box-sizing{box-sizing:border-box;*,:after,:before{box-sizing:inherit}}}}");
}
var resets_default2 = { "box-sizing": "_336cd3e4e743482f__box-sizing" };
if (typeof process === "undefined" || true) {
  registerStyle7("19fcc06039", '@layer wp-ui{@layer utilities, components, compositions, overrides;@layer components{._480b748dd3510e64__positioner{z-index:var(--wp-ui-tooltip-z-index,initial)}._50096b232db7709d__popup{--_wp-ui-elevation-sm:0 1px 2px rgba(0,0,0,.05),0 2px 3px rgba(0,0,0,.04),0 6px 6px rgba(0,0,0,.03),0 8px 8px rgba(0,0,0,.02);background-color:var(--wpds-color-background-surface-neutral-strong,#fff);border-radius:var(--wpds-border-radius-md,4px);box-shadow:var(--_wp-ui-elevation-sm);color:var(--wpds-color-foreground-content-neutral,#1e1e1e);font-family:var(--wpds-typography-font-family-body,-apple-system,system-ui,"Segoe UI","Roboto","Oxygen-Sans","Ubuntu","Cantarell","Helvetica Neue",sans-serif);font-size:var(--wpds-typography-font-size-sm,12px);line-height:1.4;padding:var(--wpds-dimension-padding-xs,4px) var(--wpds-dimension-padding-sm,8px);@media (forced-colors:active){border-bottom-color:CanvasText;border-bottom-style:solid;border-bottom-width:1px;border-left-color:CanvasText;border-left-style:solid;border-left-width:1px;border-right-color:CanvasText;border-right-style:solid;border-right-width:1px;border-top-color:CanvasText;border-top-style:solid;border-top-width:1px}}}}');
}
var style_default6 = { "positioner": "_480b748dd3510e64__positioner", "popup": "_50096b232db7709d__popup" };
var Positioner = (0, import_element21.forwardRef)(
  function TooltipPositioner3({ align = "center", className, side = "top", sideOffset = 4, ...props }, ref) {
    return /* @__PURE__ */ (0, import_jsx_runtime32.jsx)(
      index_parts_exports2.Positioner,
      {
        ref,
        align,
        side,
        sideOffset,
        ...props,
        className: clsx_default(
          resets_default2["box-sizing"],
          style_default6.positioner,
          className
        )
      }
    );
  }
);

// packages/ui/build-module/tooltip/popup.mjs
var import_jsx_runtime33 = __toESM(require_jsx_runtime(), 1);
var STYLE_HASH_ATTRIBUTE8 = "data-wp-hash";
function getRuntime8() {
  const globalScope = globalThis;
  if (globalScope.__wpStyleRuntime) {
    return globalScope.__wpStyleRuntime;
  }
  globalScope.__wpStyleRuntime = {
    documents: /* @__PURE__ */ new Map(),
    styles: /* @__PURE__ */ new Map(),
    injectedStyles: /* @__PURE__ */ new WeakMap()
  };
  if (typeof document !== "undefined") {
    registerDocument8(document);
  }
  return globalScope.__wpStyleRuntime;
}
function documentContainsStyleHash8(targetDocument, hash) {
  if (!targetDocument.head) {
    return false;
  }
  for (const style of targetDocument.head.querySelectorAll(
    `style[${STYLE_HASH_ATTRIBUTE8}]`
  )) {
    if (style.getAttribute(STYLE_HASH_ATTRIBUTE8) === hash) {
      return true;
    }
  }
  return false;
}
function injectStyle8(targetDocument, hash, css) {
  if (!targetDocument.head) {
    return;
  }
  const runtime = getRuntime8();
  let injectedStyles = runtime.injectedStyles.get(targetDocument);
  if (!injectedStyles) {
    injectedStyles = /* @__PURE__ */ new Set();
    runtime.injectedStyles.set(targetDocument, injectedStyles);
  }
  if (injectedStyles.has(hash)) {
    return;
  }
  if (documentContainsStyleHash8(targetDocument, hash)) {
    injectedStyles.add(hash);
    return;
  }
  const style = targetDocument.createElement("style");
  style.setAttribute(STYLE_HASH_ATTRIBUTE8, hash);
  style.appendChild(targetDocument.createTextNode(css));
  targetDocument.head.appendChild(style);
  injectedStyles.add(hash);
}
function registerDocument8(targetDocument) {
  const runtime = getRuntime8();
  runtime.documents.set(
    targetDocument,
    (runtime.documents.get(targetDocument) ?? 0) + 1
  );
  for (const [hash, css] of runtime.styles) {
    injectStyle8(targetDocument, hash, css);
  }
  return () => {
    const count = runtime.documents.get(targetDocument);
    if (count === void 0) {
      return;
    }
    if (count <= 1) {
      runtime.documents.delete(targetDocument);
      return;
    }
    runtime.documents.set(targetDocument, count - 1);
  };
}
function registerStyle8(hash, css) {
  const runtime = getRuntime8();
  runtime.styles.set(hash, css);
  for (const targetDocument of runtime.documents.keys()) {
    injectStyle8(targetDocument, hash, css);
  }
}
if (typeof process === "undefined" || true) {
  registerStyle8("19fcc06039", '@layer wp-ui{@layer utilities, components, compositions, overrides;@layer components{._480b748dd3510e64__positioner{z-index:var(--wp-ui-tooltip-z-index,initial)}._50096b232db7709d__popup{--_wp-ui-elevation-sm:0 1px 2px rgba(0,0,0,.05),0 2px 3px rgba(0,0,0,.04),0 6px 6px rgba(0,0,0,.03),0 8px 8px rgba(0,0,0,.02);background-color:var(--wpds-color-background-surface-neutral-strong,#fff);border-radius:var(--wpds-border-radius-md,4px);box-shadow:var(--_wp-ui-elevation-sm);color:var(--wpds-color-foreground-content-neutral,#1e1e1e);font-family:var(--wpds-typography-font-family-body,-apple-system,system-ui,"Segoe UI","Roboto","Oxygen-Sans","Ubuntu","Cantarell","Helvetica Neue",sans-serif);font-size:var(--wpds-typography-font-size-sm,12px);line-height:1.4;padding:var(--wpds-dimension-padding-xs,4px) var(--wpds-dimension-padding-sm,8px);@media (forced-colors:active){border-bottom-color:CanvasText;border-bottom-style:solid;border-bottom-width:1px;border-left-color:CanvasText;border-left-style:solid;border-left-width:1px;border-right-color:CanvasText;border-right-style:solid;border-right-width:1px;border-top-color:CanvasText;border-top-style:solid;border-top-width:1px}}}}');
}
var style_default7 = { "positioner": "_480b748dd3510e64__positioner", "popup": "_50096b232db7709d__popup" };
var POPUP_COLOR = { background: "#1e1e1e" };
var Popup = (0, import_element22.forwardRef)(function TooltipPopup3({ portal, positioner, children, className, ...props }, ref) {
  const popupContent = /* @__PURE__ */ (0, import_jsx_runtime33.jsx)(ThemeProvider, { color: POPUP_COLOR, children: /* @__PURE__ */ (0, import_jsx_runtime33.jsx)(
    index_parts_exports2.Popup,
    {
      ref,
      className: clsx_default(style_default7.popup, className),
      ...props,
      children
    }
  ) });
  const positionedPopup = renderSlotWithChildren(
    positioner,
    /* @__PURE__ */ (0, import_jsx_runtime33.jsx)(Positioner, {}),
    popupContent
  );
  return renderSlotWithChildren(portal, /* @__PURE__ */ (0, import_jsx_runtime33.jsx)(Portal, {}), positionedPopup);
});

// packages/ui/build-module/tooltip/trigger.mjs
var import_element23 = __toESM(require_element(), 1);
var import_jsx_runtime34 = __toESM(require_jsx_runtime(), 1);
var Trigger = (0, import_element23.forwardRef)(
  function TooltipTrigger3(props, ref) {
    return /* @__PURE__ */ (0, import_jsx_runtime34.jsx)(index_parts_exports2.Trigger, { ref, ...props });
  }
);

// packages/ui/build-module/tooltip/root.mjs
var import_jsx_runtime35 = __toESM(require_jsx_runtime(), 1);
function Root(props) {
  return /* @__PURE__ */ (0, import_jsx_runtime35.jsx)(index_parts_exports2.Root, { ...props });
}

// packages/ui/build-module/tooltip/provider.mjs
var import_jsx_runtime36 = __toESM(require_jsx_runtime(), 1);
function Provider({ ...props }) {
  return /* @__PURE__ */ (0, import_jsx_runtime36.jsx)(index_parts_exports2.Provider, { ...props });
}

// packages/ui/build-module/icon-button/icon-button.mjs
var import_jsx_runtime37 = __toESM(require_jsx_runtime(), 1);
var STYLE_HASH_ATTRIBUTE9 = "data-wp-hash";
function getRuntime9() {
  const globalScope = globalThis;
  if (globalScope.__wpStyleRuntime) {
    return globalScope.__wpStyleRuntime;
  }
  globalScope.__wpStyleRuntime = {
    documents: /* @__PURE__ */ new Map(),
    styles: /* @__PURE__ */ new Map(),
    injectedStyles: /* @__PURE__ */ new WeakMap()
  };
  if (typeof document !== "undefined") {
    registerDocument9(document);
  }
  return globalScope.__wpStyleRuntime;
}
function documentContainsStyleHash9(targetDocument, hash) {
  if (!targetDocument.head) {
    return false;
  }
  for (const style of targetDocument.head.querySelectorAll(
    `style[${STYLE_HASH_ATTRIBUTE9}]`
  )) {
    if (style.getAttribute(STYLE_HASH_ATTRIBUTE9) === hash) {
      return true;
    }
  }
  return false;
}
function injectStyle9(targetDocument, hash, css) {
  if (!targetDocument.head) {
    return;
  }
  const runtime = getRuntime9();
  let injectedStyles = runtime.injectedStyles.get(targetDocument);
  if (!injectedStyles) {
    injectedStyles = /* @__PURE__ */ new Set();
    runtime.injectedStyles.set(targetDocument, injectedStyles);
  }
  if (injectedStyles.has(hash)) {
    return;
  }
  if (documentContainsStyleHash9(targetDocument, hash)) {
    injectedStyles.add(hash);
    return;
  }
  const style = targetDocument.createElement("style");
  style.setAttribute(STYLE_HASH_ATTRIBUTE9, hash);
  style.appendChild(targetDocument.createTextNode(css));
  targetDocument.head.appendChild(style);
  injectedStyles.add(hash);
}
function registerDocument9(targetDocument) {
  const runtime = getRuntime9();
  runtime.documents.set(
    targetDocument,
    (runtime.documents.get(targetDocument) ?? 0) + 1
  );
  for (const [hash, css] of runtime.styles) {
    injectStyle9(targetDocument, hash, css);
  }
  return () => {
    const count = runtime.documents.get(targetDocument);
    if (count === void 0) {
      return;
    }
    if (count <= 1) {
      runtime.documents.delete(targetDocument);
      return;
    }
    runtime.documents.set(targetDocument, count - 1);
  };
}
function registerStyle9(hash, css) {
  const runtime = getRuntime9();
  runtime.styles.set(hash, css);
  for (const targetDocument of runtime.documents.keys()) {
    injectStyle9(targetDocument, hash, css);
  }
}
if (typeof process === "undefined" || true) {
  registerStyle9("c5cdafb1bc", "@layer wp-ui{@layer utilities, components, compositions, overrides;@layer compositions{._28cfdc260e755391__icon-button{--wp-ui-button-aspect-ratio:1;--wp-ui-button-padding-inline:0px;--wp-ui-button-min-width:unset}.f1c70d719989a85a__icon{margin:-1px}}}");
}
var style_default8 = { "icon-button": "_28cfdc260e755391__icon-button", "icon": "f1c70d719989a85a__icon" };
var IconButton = (0, import_element24.forwardRef)(
  function IconButton2({
    label,
    className,
    // Prevent accidental forwarding of `children`
    children: _children,
    disabled: disabled2,
    focusableWhenDisabled = true,
    icon,
    size: size4,
    shortcut,
    positioner,
    ...restProps
  }, ref) {
    const classes = clsx_default(style_default8["icon-button"], className);
    return /* @__PURE__ */ (0, import_jsx_runtime37.jsxs)(Root, { children: [
      /* @__PURE__ */ (0, import_jsx_runtime37.jsx)(
        Trigger,
        {
          ref,
          disabled: disabled2 && !focusableWhenDisabled,
          render: /* @__PURE__ */ (0, import_jsx_runtime37.jsx)(
            Button4,
            {
              ...restProps,
              size: size4,
              "aria-label": label,
              "aria-keyshortcuts": shortcut?.ariaKeyShortcut,
              disabled: disabled2,
              focusableWhenDisabled
            }
          ),
          className: classes,
          children: /* @__PURE__ */ (0, import_jsx_runtime37.jsx)(Icon, { icon, size: 24, className: style_default8.icon })
        }
      ),
      /* @__PURE__ */ (0, import_jsx_runtime37.jsxs)(Popup, { positioner, children: [
        label,
        shortcut && /* @__PURE__ */ (0, import_jsx_runtime37.jsxs)(import_jsx_runtime37.Fragment, { children: [
          " ",
          /* @__PURE__ */ (0, import_jsx_runtime37.jsx)("span", { "aria-hidden": "true", children: shortcut.displayShortcut })
        ] })
      ] })
    ] });
  }
);

// packages/ui/build-module/utils/create-overlay-title-validation.mjs
var import_element26 = __toESM(require_element(), 1);

// packages/ui/build-module/utils/use-schedule-validation.mjs
var import_element25 = __toESM(require_element(), 1);
function useScheduleValidation(validate) {
  const validateRef = (0, import_element25.useRef)(validate);
  validateRef.current = validate;
  const timerRef = (0, import_element25.useRef)(null);
  const unmountedRef = (0, import_element25.useRef)(false);
  const scheduleValidation = (0, import_element25.useCallback)(() => {
    if (unmountedRef.current) {
      return;
    }
    if (timerRef.current) {
      clearTimeout(timerRef.current);
    }
    timerRef.current = setTimeout(() => {
      validateRef.current();
      timerRef.current = null;
    }, 0);
  }, []);
  (0, import_element25.useEffect)(() => {
    unmountedRef.current = false;
    return () => {
      unmountedRef.current = true;
      if (timerRef.current) {
        clearTimeout(timerRef.current);
      }
    };
  }, []);
  return scheduleValidation;
}

// packages/ui/build-module/utils/create-overlay-title-validation.mjs
var import_jsx_runtime38 = __toESM(require_jsx_runtime(), 1);
var VALIDATION_ENABLED = true;
function createOverlayTitleValidation(componentName) {
  const componentNameLowerCase = componentName.toLowerCase();
  const OverlayValidationContext = VALIDATION_ENABLED ? (0, import_element26.createContext)(null) : null;
  function useValidationContextDev() {
    return (0, import_element26.useContext)(OverlayValidationContext);
  }
  function useValidationContextProd() {
    return null;
  }
  const useValidationContext = VALIDATION_ENABLED ? useValidationContextDev : useValidationContextProd;
  function ValidationProviderDev({
    children
  }) {
    const titleElementRef = (0, import_element26.useRef)(null);
    const scheduleValidation = useScheduleValidation(() => {
      const titleElement = titleElementRef.current;
      if (!titleElement) {
        throw new Error(
          `${componentName}: Missing <${componentName}.Title>. For accessibility, every ${componentNameLowerCase} requires a title. If needed, the title can be visually hidden but must not be omitted.`
        );
      }
      const textContent = titleElement.textContent?.trim();
      if (!textContent) {
        throw new Error(
          `${componentName}: <${componentName}.Title> cannot be empty. Provide meaningful text content for the ${componentNameLowerCase} title.`
        );
      }
    });
    const registerTitle = (0, import_element26.useCallback)(
      (element) => {
        titleElementRef.current = element;
        scheduleValidation();
        return () => {
          titleElementRef.current = null;
          scheduleValidation();
        };
      },
      [scheduleValidation]
    );
    const contextValue = (0, import_element26.useMemo)(
      () => ({ registerTitle }),
      [registerTitle]
    );
    (0, import_element26.useEffect)(() => {
      scheduleValidation();
    }, [scheduleValidation]);
    return /* @__PURE__ */ (0, import_jsx_runtime38.jsx)(OverlayValidationContext.Provider, { value: contextValue, children });
  }
  function ValidationProviderProd({
    children
  }) {
    return /* @__PURE__ */ (0, import_jsx_runtime38.jsx)(import_jsx_runtime38.Fragment, { children });
  }
  const ValidationProvider = VALIDATION_ENABLED ? ValidationProviderDev : ValidationProviderProd;
  return {
    ValidationProvider,
    useValidationContext
  };
}

// packages/ui/build-module/visually-hidden/visually-hidden.mjs
var import_element27 = __toESM(require_element(), 1);
var STYLE_HASH_ATTRIBUTE10 = "data-wp-hash";
function getRuntime10() {
  const globalScope = globalThis;
  if (globalScope.__wpStyleRuntime) {
    return globalScope.__wpStyleRuntime;
  }
  globalScope.__wpStyleRuntime = {
    documents: /* @__PURE__ */ new Map(),
    styles: /* @__PURE__ */ new Map(),
    injectedStyles: /* @__PURE__ */ new WeakMap()
  };
  if (typeof document !== "undefined") {
    registerDocument10(document);
  }
  return globalScope.__wpStyleRuntime;
}
function documentContainsStyleHash10(targetDocument, hash) {
  if (!targetDocument.head) {
    return false;
  }
  for (const style of targetDocument.head.querySelectorAll(
    `style[${STYLE_HASH_ATTRIBUTE10}]`
  )) {
    if (style.getAttribute(STYLE_HASH_ATTRIBUTE10) === hash) {
      return true;
    }
  }
  return false;
}
function injectStyle10(targetDocument, hash, css) {
  if (!targetDocument.head) {
    return;
  }
  const runtime = getRuntime10();
  let injectedStyles = runtime.injectedStyles.get(targetDocument);
  if (!injectedStyles) {
    injectedStyles = /* @__PURE__ */ new Set();
    runtime.injectedStyles.set(targetDocument, injectedStyles);
  }
  if (injectedStyles.has(hash)) {
    return;
  }
  if (documentContainsStyleHash10(targetDocument, hash)) {
    injectedStyles.add(hash);
    return;
  }
  const style = targetDocument.createElement("style");
  style.setAttribute(STYLE_HASH_ATTRIBUTE10, hash);
  style.appendChild(targetDocument.createTextNode(css));
  targetDocument.head.appendChild(style);
  injectedStyles.add(hash);
}
function registerDocument10(targetDocument) {
  const runtime = getRuntime10();
  runtime.documents.set(
    targetDocument,
    (runtime.documents.get(targetDocument) ?? 0) + 1
  );
  for (const [hash, css] of runtime.styles) {
    injectStyle10(targetDocument, hash, css);
  }
  return () => {
    const count = runtime.documents.get(targetDocument);
    if (count === void 0) {
      return;
    }
    if (count <= 1) {
      runtime.documents.delete(targetDocument);
      return;
    }
    runtime.documents.set(targetDocument, count - 1);
  };
}
function registerStyle10(hash, css) {
  const runtime = getRuntime10();
  runtime.styles.set(hash, css);
  for (const targetDocument of runtime.documents.keys()) {
    injectStyle10(targetDocument, hash, css);
  }
}
if (typeof process === "undefined" || true) {
  registerStyle10("fa606a57ae", "@layer wp-ui{@layer utilities, components, compositions, overrides;@layer components{.f37b9e2e191ebd66__visually-hidden{word-wrap:normal;border:0;clip-path:inset(50%);height:1px;margin:-1px;overflow:hidden;padding:0;position:absolute;width:1px;word-break:normal}}}");
}
var style_default9 = { "visually-hidden": "f37b9e2e191ebd66__visually-hidden" };
var VisuallyHidden = (0, import_element27.forwardRef)(
  function VisuallyHidden2({ render, ...restProps }, ref) {
    const element = useRender({
      render,
      ref,
      props: mergeProps(
        { className: style_default9["visually-hidden"] },
        restProps,
        {
          // @ts-expect-error Arbitrary data-* attributes aren't indexable on the typed div props. Kept hardcoded so consumers can't change or remove it.
          "data-visually-hidden": ""
        }
      )
    });
    return element;
  }
);

// packages/ui/build-module/link/link.mjs
var import_element28 = __toESM(require_element(), 1);
var import_i18n2 = __toESM(require_i18n(), 1);
var import_jsx_runtime39 = __toESM(require_jsx_runtime(), 1);
var STYLE_HASH_ATTRIBUTE11 = "data-wp-hash";
function getRuntime11() {
  const globalScope = globalThis;
  if (globalScope.__wpStyleRuntime) {
    return globalScope.__wpStyleRuntime;
  }
  globalScope.__wpStyleRuntime = {
    documents: /* @__PURE__ */ new Map(),
    styles: /* @__PURE__ */ new Map(),
    injectedStyles: /* @__PURE__ */ new WeakMap()
  };
  if (typeof document !== "undefined") {
    registerDocument11(document);
  }
  return globalScope.__wpStyleRuntime;
}
function documentContainsStyleHash11(targetDocument, hash) {
  if (!targetDocument.head) {
    return false;
  }
  for (const style of targetDocument.head.querySelectorAll(
    `style[${STYLE_HASH_ATTRIBUTE11}]`
  )) {
    if (style.getAttribute(STYLE_HASH_ATTRIBUTE11) === hash) {
      return true;
    }
  }
  return false;
}
function injectStyle11(targetDocument, hash, css) {
  if (!targetDocument.head) {
    return;
  }
  const runtime = getRuntime11();
  let injectedStyles = runtime.injectedStyles.get(targetDocument);
  if (!injectedStyles) {
    injectedStyles = /* @__PURE__ */ new Set();
    runtime.injectedStyles.set(targetDocument, injectedStyles);
  }
  if (injectedStyles.has(hash)) {
    return;
  }
  if (documentContainsStyleHash11(targetDocument, hash)) {
    injectedStyles.add(hash);
    return;
  }
  const style = targetDocument.createElement("style");
  style.setAttribute(STYLE_HASH_ATTRIBUTE11, hash);
  style.appendChild(targetDocument.createTextNode(css));
  targetDocument.head.appendChild(style);
  injectedStyles.add(hash);
}
function registerDocument11(targetDocument) {
  const runtime = getRuntime11();
  runtime.documents.set(
    targetDocument,
    (runtime.documents.get(targetDocument) ?? 0) + 1
  );
  for (const [hash, css] of runtime.styles) {
    injectStyle11(targetDocument, hash, css);
  }
  return () => {
    const count = runtime.documents.get(targetDocument);
    if (count === void 0) {
      return;
    }
    if (count <= 1) {
      runtime.documents.delete(targetDocument);
      return;
    }
    runtime.documents.set(targetDocument, count - 1);
  };
}
function registerStyle11(hash, css) {
  const runtime = getRuntime11();
  runtime.styles.set(hash, css);
  for (const targetDocument of runtime.documents.keys()) {
    injectStyle11(targetDocument, hash, css);
  }
}
if (typeof process === "undefined" || true) {
  registerStyle11("10f3806643", "@layer wp-ui{@layer utilities, components, compositions, overrides;@layer utilities{._336cd3e4e743482f__box-sizing{box-sizing:border-box;*,:after,:before{box-sizing:inherit}}}}");
}
var resets_default3 = { "box-sizing": "_336cd3e4e743482f__box-sizing" };
if (typeof process === "undefined" || true) {
  registerStyle11("da99a163ac", "@layer wp-ui{@layer utilities, components, compositions, overrides;@layer utilities{._08e8a2e44959f892__outset-ring--focus:focus,.c5cb3ee4bddaa8e4__outset-ring--focus-within-visible:focus-within:has(:focus-visible),.cd83dfc2126a0846__outset-ring--focus-within:focus-within,.d0541bc9dd9dc7b6__outset-ring--focus-visible:focus-visible,:focus-visible .ecadb9e080e2dfa5__outset-ring--focus-parent-visible{--_gcd-a-outline:var(--wpds-border-width-focus,var(--wp-admin-border-width-focus,2px)) solid var(--wpds-color-stroke-focus,var(--wp-admin-theme-color,#3858e9));--_gcd-div-outline:var(--wpds-border-width-focus,var(--wp-admin-border-width-focus,2px)) solid var(--wpds-color-stroke-focus,var(--wp-admin-theme-color,#3858e9));outline:var(--wpds-border-width-focus,var(--wp-admin-border-width-focus,2px)) solid var(--wpds-color-stroke-focus,var(--wp-admin-theme-color,#3858e9));outline-offset:var(--wpds-border-width-focus,var(--wp-admin-border-width-focus,2px))}._970d04df7376df67__outset-ring--focus-within-except-active:focus-within,.e25b2bdd7aa21721__outset-ring--focus-except-active:focus{outline:none}._970d04df7376df67__outset-ring--focus-within-except-active:focus-within:not(:has(:active)),.e25b2bdd7aa21721__outset-ring--focus-except-active:focus:not(:active){@include mixins.focus-ring()}}}");
}
var focus_default2 = { "outset-ring--focus": "_08e8a2e44959f892__outset-ring--focus", "outset-ring--focus-visible": "d0541bc9dd9dc7b6__outset-ring--focus-visible", "outset-ring--focus-within": "cd83dfc2126a0846__outset-ring--focus-within", "outset-ring--focus-within-visible": "c5cb3ee4bddaa8e4__outset-ring--focus-within-visible", "outset-ring--focus-parent-visible": "ecadb9e080e2dfa5__outset-ring--focus-parent-visible", "outset-ring--focus-except-active": "e25b2bdd7aa21721__outset-ring--focus-except-active", "outset-ring--focus-within-except-active": "_970d04df7376df67__outset-ring--focus-within-except-active" };
if (typeof process === "undefined" || true) {
  registerStyle11("e8e6a9be37", '@layer wp-ui{@layer utilities, components, compositions, overrides;@layer components{.d4250949359b05ce__link{text-decoration-thickness:from-font;text-underline-offset:.2em}.c6055659b8e2cd2c__is-brand,.c6055659b8e2cd2c__is-brand:visited{--_gcd-a-color:var(--wpds-color-foreground-interactive-brand,var(--wp-admin-theme-color,#3858e9));color:var(--wpds-color-foreground-interactive-brand,var(--wp-admin-theme-color,#3858e9))}.c6055659b8e2cd2c__is-brand:active,.c6055659b8e2cd2c__is-brand:hover{--_gcd-a-color:var(--wpds-color-foreground-interactive-brand-active,color-mix(in oklch,var(--wp-admin-theme-color,#3858e9) 52%,#000));color:var(--wpds-color-foreground-interactive-brand-active,color-mix(in oklch,var(--wp-admin-theme-color,#3858e9) 52%,#000))}._92e0dfcaeee15b88__is-neutral,._92e0dfcaeee15b88__is-neutral:visited{--_gcd-a-color:var(--wpds-color-foreground-interactive-neutral,#1e1e1e);color:var(--wpds-color-foreground-interactive-neutral,#1e1e1e);text-decoration-color:var(--wpds-color-stroke-interactive-neutral,#8d8d8d)}._92e0dfcaeee15b88__is-neutral:active,._92e0dfcaeee15b88__is-neutral:hover{--_gcd-a-color:var(--wpds-color-foreground-interactive-neutral-active,#1e1e1e);color:var(--wpds-color-foreground-interactive-neutral-active,#1e1e1e)}.cf122a9bf1035d42__is-unstyled{--_gcd-a-color:inherit;color:inherit;text-decoration:none}._0cb411afac4c86c7__link-icon{display:inline-block;font-weight:var(--wpds-typography-font-weight-default,400);line-height:1;margin-inline-start:var(--wpds-dimension-padding-xs,4px);text-decoration:none}._0cb411afac4c86c7__link-icon:after{content:"\\2197"}._0cb411afac4c86c7__link-icon:dir(rtl):after{content:"\\2196"}}}');
}
var style_default10 = { "link": "d4250949359b05ce__link", "is-brand": "c6055659b8e2cd2c__is-brand", "is-neutral": "_92e0dfcaeee15b88__is-neutral", "is-unstyled": "cf122a9bf1035d42__is-unstyled", "link-icon": "_0cb411afac4c86c7__link-icon" };
if (typeof process === "undefined" || true) {
  registerStyle11("af6d9984a6", "._6defc79820e382c6__button{box-sizing:var(--_gcd-button-box-sizing,border-box);font-family:var(--_gcd-button-font-family,inherit);font-size:var(--_gcd-button-font-size,inherit);font-weight:var(--_gcd-button-font-weight,inherit)}.d2cff2e5dea83bd1__input{box-sizing:var(--_gcd-input-box-sizing,border-box);font-family:var(--_gcd-input-font-family,inherit);font-size:var(--_gcd-input-font-size,inherit);font-weight:var(--_gcd-input-font-weight,inherit);margin:var(--_gcd-input-margin,0);&:is(textarea,[type=text],[type=password],[type=color],[type=date],[type=datetime],[type=datetime-local],[type=email],[type=month],[type=number],[type=search],[type=tel],[type=time],[type=url],[type=week]){background-color:var(--_gcd-input-background-color,transparent);border:var(--_gcd-input-border,none);border-radius:var(--_gcd-input-border-radius,0);box-shadow:var(--_gcd-input-box-shadow,0 0 0 transparent);color:var(--_gcd-input-color,var(--wpds-color-foreground-interactive-neutral,#1e1e1e));&:focus{border-color:var(--_gcd-input-border-color-focus,var(--wp-admin-theme-color));box-shadow:var(--_gcd-input-box-shadow-focus,none);outline:var(--_gcd-input-outline-focus,none)}&:disabled{background:var(--_gcd-input-background-disabled,transparent);border-color:var(--_gcd-input-border-color-disabled,transparent);box-shadow:var(--_gcd-input-box-shadow-disabled,none);color:var(--_gcd-input-color-disabled,var(--wpds-color-foreground-interactive-neutral-disabled,#8d8d8d))}&::placeholder{color:var(--_gcd-input-placeholder-color,var(--wpds-color-foreground-interactive-neutral-disabled,#8d8d8d))}}&:is(textarea,[type=text],[type=password],[type=date],[type=datetime],[type=datetime-local],[type=email],[type=month],[type=number],[type=search],[type=tel],[type=time],[type=url],[type=week]){line-height:var(--_gcd-input-line-height,inherit);min-height:var(--_gcd-input-min-height,auto);padding:var(--_gcd-input-padding,0)}}._547d86373d02e108__textarea{box-sizing:var(--_gcd-textarea-box-sizing,border-box);overflow:var(--_gcd-textarea-overflow,auto);resize:var(--_gcd-textarea-resize,block)}._8c15fd0ed9f28ba4__div{outline:var(--_gcd-div-outline,0 solid transparent)}p._43cec3e1eec1066d__p{font-size:var(--_gcd-p-font-size,13px);line-height:var(--_gcd-p-line-height,1.5);margin:var(--_gcd-p-margin,0)}:is(h1,h2,h3,h4,h5,h6).e97669c6d9a38497__heading{color:var(--_gcd-heading-color,var(--wpds-color-foreground-content-neutral,#1e1e1e));font-size:var(--_gcd-heading-font-size,inherit);font-weight:var(--_gcd-heading-font-weight,var(--wpds-typography-font-weight-emphasis,600));margin:var(--_gcd-heading-margin,0)}._2c0831b0499dbd6e__a,._2c0831b0499dbd6e__a:is(:hover,:focus,:active){border-radius:var(--_gcd-a-border-radius,0);box-shadow:var(--_gcd-a-box-shadow,none);color:var(--_gcd-a-color,inherit);outline:var(--_gcd-a-outline,0 solid transparent);transition:var(--_gcd-a-transition,none)}");
}
var global_css_defense_default3 = { "button": "_6defc79820e382c6__button", "input": "d2cff2e5dea83bd1__input", "textarea": "_547d86373d02e108__textarea", "div": "_8c15fd0ed9f28ba4__div", "p": "_43cec3e1eec1066d__p", "heading": "e97669c6d9a38497__heading", "a": "_2c0831b0499dbd6e__a" };
var Link = (0, import_element28.forwardRef)(function Link2({
  children,
  variant = "default",
  tone = "brand",
  openInNewTab = false,
  render,
  className,
  ...props
}, ref) {
  const element = useRender({
    render,
    defaultTagName: "a",
    ref,
    props: mergeProps(props, {
      className: clsx_default(
        global_css_defense_default3.a,
        resets_default3["box-sizing"],
        focus_default2["outset-ring--focus-except-active"],
        variant !== "unstyled" && style_default10.link,
        variant !== "unstyled" && style_default10[`is-${tone}`],
        variant === "unstyled" && style_default10["is-unstyled"],
        className
      ),
      target: openInNewTab ? "_blank" : void 0,
      children: /* @__PURE__ */ (0, import_jsx_runtime39.jsxs)(import_jsx_runtime39.Fragment, { children: [
        children,
        openInNewTab && /* @__PURE__ */ (0, import_jsx_runtime39.jsx)(
          "span",
          {
            className: style_default10["link-icon"],
            role: "img",
            "aria-label": (
              /* translators: accessibility text appended to link text */
              (0, import_i18n2.__)("(opens in a new tab)")
            )
          }
        )
      ] })
    })
  });
  return element;
});

// packages/ui/build-module/notice/index.mjs
var notice_exports = {};
__export(notice_exports, {
  ActionButton: () => ActionButton,
  ActionLink: () => ActionLink,
  Actions: () => Actions,
  CloseIcon: () => CloseIcon,
  Description: () => Description,
  Root: () => Root2,
  Title: () => Title
});

// packages/ui/build-module/notice/root.mjs
var import_element29 = __toESM(require_element(), 1);
import { speak as speak2 } from "@wordpress/a11y";
var import_jsx_runtime40 = __toESM(require_jsx_runtime(), 1);
var STYLE_HASH_ATTRIBUTE12 = "data-wp-hash";
function getRuntime12() {
  const globalScope = globalThis;
  if (globalScope.__wpStyleRuntime) {
    return globalScope.__wpStyleRuntime;
  }
  globalScope.__wpStyleRuntime = {
    documents: /* @__PURE__ */ new Map(),
    styles: /* @__PURE__ */ new Map(),
    injectedStyles: /* @__PURE__ */ new WeakMap()
  };
  if (typeof document !== "undefined") {
    registerDocument12(document);
  }
  return globalScope.__wpStyleRuntime;
}
function documentContainsStyleHash12(targetDocument, hash) {
  if (!targetDocument.head) {
    return false;
  }
  for (const style of targetDocument.head.querySelectorAll(
    `style[${STYLE_HASH_ATTRIBUTE12}]`
  )) {
    if (style.getAttribute(STYLE_HASH_ATTRIBUTE12) === hash) {
      return true;
    }
  }
  return false;
}
function injectStyle12(targetDocument, hash, css) {
  if (!targetDocument.head) {
    return;
  }
  const runtime = getRuntime12();
  let injectedStyles = runtime.injectedStyles.get(targetDocument);
  if (!injectedStyles) {
    injectedStyles = /* @__PURE__ */ new Set();
    runtime.injectedStyles.set(targetDocument, injectedStyles);
  }
  if (injectedStyles.has(hash)) {
    return;
  }
  if (documentContainsStyleHash12(targetDocument, hash)) {
    injectedStyles.add(hash);
    return;
  }
  const style = targetDocument.createElement("style");
  style.setAttribute(STYLE_HASH_ATTRIBUTE12, hash);
  style.appendChild(targetDocument.createTextNode(css));
  targetDocument.head.appendChild(style);
  injectedStyles.add(hash);
}
function registerDocument12(targetDocument) {
  const runtime = getRuntime12();
  runtime.documents.set(
    targetDocument,
    (runtime.documents.get(targetDocument) ?? 0) + 1
  );
  for (const [hash, css] of runtime.styles) {
    injectStyle12(targetDocument, hash, css);
  }
  return () => {
    const count = runtime.documents.get(targetDocument);
    if (count === void 0) {
      return;
    }
    if (count <= 1) {
      runtime.documents.delete(targetDocument);
      return;
    }
    runtime.documents.set(targetDocument, count - 1);
  };
}
function registerStyle12(hash, css) {
  const runtime = getRuntime12();
  runtime.styles.set(hash, css);
  for (const targetDocument of runtime.documents.keys()) {
    injectStyle12(targetDocument, hash, css);
  }
}
if (typeof process === "undefined" || true) {
  registerStyle12("10f3806643", "@layer wp-ui{@layer utilities, components, compositions, overrides;@layer utilities{._336cd3e4e743482f__box-sizing{box-sizing:border-box;*,:after,:before{box-sizing:inherit}}}}");
}
var resets_default4 = { "box-sizing": "_336cd3e4e743482f__box-sizing" };
if (typeof process === "undefined" || true) {
  registerStyle12("726c480820", "@layer wp-ui{@layer utilities, components, compositions, overrides;@layer components{._4145abab73d17514__notice{--icon-height:var(--wpds-dimension-size-sm,24px);--text-vertical-padding:calc((var(--icon-height) - var(--wpds-typography-line-height-sm, 20px))/2);--wp-ui-notice-background-color:var(--wpds-color-background-surface-neutral-weak,#f4f4f4);--wp-ui-notice-border-color:var(--wpds-color-stroke-surface-neutral,#dbdbdb);--wp-ui-notice-text-color:var(--wpds-color-foreground-content-neutral,#1e1e1e);--wp-ui-notice-decorative-icon-color:var(--wpds-color-foreground-content-neutral,#1e1e1e);align-items:start;background-color:var(--wp-ui-notice-background-color);border:1px solid var(--wp-ui-notice-border-color);border-radius:var(--wpds-border-radius-lg,8px);container-type:inline-size;display:grid;grid-template-columns:auto 1fr auto;padding:var(--wpds-dimension-padding-md,12px)}.d0a25570cb528528__icon{color:var(--wp-ui-notice-decorative-icon-color);grid-column:1;grid-row:1;margin-inline-end:var(--wpds-dimension-gap-xs,4px)}._1904b570a89bb815__description,.b5397fb9d05389e3__title{color:var(--wp-ui-notice-text-color);grid-column:2;padding-block:var(--text-vertical-padding)}._1904b570a89bb815__description{text-wrap:pretty}._0a1270dcdd79c031__actions{display:flex;flex-wrap:wrap;gap:var(--wpds-dimension-gap-md,12px);grid-column:2}._4145abab73d17514__notice:has(._1904b570a89bb815__description) ._0a1270dcdd79c031__actions,._4145abab73d17514__notice:has(.b5397fb9d05389e3__title) ._0a1270dcdd79c031__actions{margin-block-start:var(--wpds-dimension-gap-sm,8px)}._983740ab855c4e09__action-button{flex-shrink:0}.d329e7416d368d31__action-link{flex-shrink:0;&:not(:first-child){margin-inline-start:var(--wpds-dimension-gap-xs,4px)}&:not(:last-child){margin-inline-end:var(--wpds-dimension-gap-xs,4px)}}._487e6a5c1375f7dc__close-icon{grid-column:3;grid-row:1;margin-inline-start:var(--wpds-dimension-gap-xs,4px)}._531c140826094795__is-info{--wp-ui-notice-background-color:var(--wpds-color-background-surface-info-weak,#f3f9ff);--wp-ui-notice-border-color:var(--wpds-color-stroke-surface-info,#a9c6e7);--wp-ui-notice-text-color:var(--wpds-color-foreground-content-info,#001b4f);--wp-ui-notice-decorative-icon-color:var(--wpds-color-foreground-content-info-weak,#006bd7)}.ae2e1004697cce95__is-warning{--wp-ui-notice-background-color:var(--wpds-color-background-surface-warning-weak,#fff7e1);--wp-ui-notice-border-color:var(--wpds-color-stroke-surface-warning,#e1bc7c);--wp-ui-notice-text-color:var(--wpds-color-foreground-content-warning,#2e1900);--wp-ui-notice-decorative-icon-color:var(--wpds-color-foreground-content-warning-weak,#926300)}._2e614a76af494837__is-success{--wp-ui-notice-background-color:var(--wpds-color-background-surface-success-weak,#ebffed);--wp-ui-notice-border-color:var(--wpds-color-stroke-surface-success,#94d29e);--wp-ui-notice-text-color:var(--wpds-color-foreground-content-success,#002900);--wp-ui-notice-decorative-icon-color:var(--wpds-color-foreground-content-success-weak,#008030)}.af00331ae17a0065__is-error{--wp-ui-notice-background-color:var(--wpds-color-background-surface-error-weak,#fff6f5);--wp-ui-notice-border-color:var(--wpds-color-stroke-surface-error,#dab1aa);--wp-ui-notice-text-color:var(--wpds-color-foreground-content-error,#470000);--wp-ui-notice-decorative-icon-color:var(--wpds-color-foreground-content-error-weak,#cc1818)}@container (max-width: 320px){._4145abab73d17514__notice:has(.b5397fb9d05389e3__title) ._0a1270dcdd79c031__actions,._4145abab73d17514__notice:has(.b5397fb9d05389e3__title) ._1904b570a89bb815__description{grid-column:1/3}}}@layer compositions{.d329e7416d368d31__action-link{margin-block:auto}._487e6a5c1375f7dc__close-icon,._983740ab855c4e09__action-button:is(._8ddb8fb33fbf3d38__is-action-button-outline,._77bbde495a8a0af3__is-action-button-minimal){--wp-ui-button-background-color-active:color-mix(in srgb,transparent 50%,var(--wpds-color-background-interactive-neutral-weak-active,#ededed))}}}");
}
var style_default11 = { "notice": "_4145abab73d17514__notice", "icon": "d0a25570cb528528__icon", "title": "b5397fb9d05389e3__title", "description": "_1904b570a89bb815__description", "actions": "_0a1270dcdd79c031__actions", "action-button": "_983740ab855c4e09__action-button", "action-link": "d329e7416d368d31__action-link", "close-icon": "_487e6a5c1375f7dc__close-icon", "is-info": "_531c140826094795__is-info", "is-warning": "ae2e1004697cce95__is-warning", "is-success": "_2e614a76af494837__is-success", "is-error": "af00331ae17a0065__is-error", "is-action-button-outline": "_8ddb8fb33fbf3d38__is-action-button-outline", "is-action-button-minimal": "_77bbde495a8a0af3__is-action-button-minimal" };
var icons = {
  neutral: null,
  info: info_default,
  warning: caution_default,
  success: published_default,
  error: error_default
};
function getDefaultPoliteness(intent) {
  return intent === "error" ? "assertive" : "polite";
}
function safeRenderToString(message) {
  if (!message) {
    return void 0;
  }
  if (typeof message === "string") {
    return message;
  }
  try {
    return (0, import_element29.renderToString)(message);
  } catch {
    return void 0;
  }
}
function useSpokenMessage(message, politeness) {
  const spokenMessage = safeRenderToString(message);
  (0, import_element29.useEffect)(() => {
    if (spokenMessage) {
      speak2(spokenMessage, politeness);
    }
  }, [spokenMessage, politeness]);
}
var Root2 = (0, import_element29.forwardRef)(function Notice({
  intent = "neutral",
  children,
  icon,
  spokenMessage = children,
  politeness = getDefaultPoliteness(intent),
  render,
  ...restProps
}, ref) {
  useSpokenMessage(spokenMessage, politeness);
  const iconElement = icon === null ? null : icon ?? icons[intent];
  const mergedClassName = clsx_default(
    style_default11.notice,
    style_default11[`is-${intent}`],
    resets_default4["box-sizing"]
  );
  const element = useRender({
    defaultTagName: "div",
    render,
    ref,
    props: mergeProps(
      {
        className: mergedClassName,
        children: /* @__PURE__ */ (0, import_jsx_runtime40.jsxs)(import_jsx_runtime40.Fragment, { children: [
          children,
          iconElement && /* @__PURE__ */ (0, import_jsx_runtime40.jsx)(
            Icon,
            {
              className: style_default11.icon,
              icon: iconElement
            }
          )
        ] })
      },
      restProps
    )
  });
  return element;
});

// packages/ui/build-module/notice/title.mjs
var import_element30 = __toESM(require_element(), 1);
var import_jsx_runtime41 = __toESM(require_jsx_runtime(), 1);
var STYLE_HASH_ATTRIBUTE13 = "data-wp-hash";
function getRuntime13() {
  const globalScope = globalThis;
  if (globalScope.__wpStyleRuntime) {
    return globalScope.__wpStyleRuntime;
  }
  globalScope.__wpStyleRuntime = {
    documents: /* @__PURE__ */ new Map(),
    styles: /* @__PURE__ */ new Map(),
    injectedStyles: /* @__PURE__ */ new WeakMap()
  };
  if (typeof document !== "undefined") {
    registerDocument13(document);
  }
  return globalScope.__wpStyleRuntime;
}
function documentContainsStyleHash13(targetDocument, hash) {
  if (!targetDocument.head) {
    return false;
  }
  for (const style of targetDocument.head.querySelectorAll(
    `style[${STYLE_HASH_ATTRIBUTE13}]`
  )) {
    if (style.getAttribute(STYLE_HASH_ATTRIBUTE13) === hash) {
      return true;
    }
  }
  return false;
}
function injectStyle13(targetDocument, hash, css) {
  if (!targetDocument.head) {
    return;
  }
  const runtime = getRuntime13();
  let injectedStyles = runtime.injectedStyles.get(targetDocument);
  if (!injectedStyles) {
    injectedStyles = /* @__PURE__ */ new Set();
    runtime.injectedStyles.set(targetDocument, injectedStyles);
  }
  if (injectedStyles.has(hash)) {
    return;
  }
  if (documentContainsStyleHash13(targetDocument, hash)) {
    injectedStyles.add(hash);
    return;
  }
  const style = targetDocument.createElement("style");
  style.setAttribute(STYLE_HASH_ATTRIBUTE13, hash);
  style.appendChild(targetDocument.createTextNode(css));
  targetDocument.head.appendChild(style);
  injectedStyles.add(hash);
}
function registerDocument13(targetDocument) {
  const runtime = getRuntime13();
  runtime.documents.set(
    targetDocument,
    (runtime.documents.get(targetDocument) ?? 0) + 1
  );
  for (const [hash, css] of runtime.styles) {
    injectStyle13(targetDocument, hash, css);
  }
  return () => {
    const count = runtime.documents.get(targetDocument);
    if (count === void 0) {
      return;
    }
    if (count <= 1) {
      runtime.documents.delete(targetDocument);
      return;
    }
    runtime.documents.set(targetDocument, count - 1);
  };
}
function registerStyle13(hash, css) {
  const runtime = getRuntime13();
  runtime.styles.set(hash, css);
  for (const targetDocument of runtime.documents.keys()) {
    injectStyle13(targetDocument, hash, css);
  }
}
if (typeof process === "undefined" || true) {
  registerStyle13("726c480820", "@layer wp-ui{@layer utilities, components, compositions, overrides;@layer components{._4145abab73d17514__notice{--icon-height:var(--wpds-dimension-size-sm,24px);--text-vertical-padding:calc((var(--icon-height) - var(--wpds-typography-line-height-sm, 20px))/2);--wp-ui-notice-background-color:var(--wpds-color-background-surface-neutral-weak,#f4f4f4);--wp-ui-notice-border-color:var(--wpds-color-stroke-surface-neutral,#dbdbdb);--wp-ui-notice-text-color:var(--wpds-color-foreground-content-neutral,#1e1e1e);--wp-ui-notice-decorative-icon-color:var(--wpds-color-foreground-content-neutral,#1e1e1e);align-items:start;background-color:var(--wp-ui-notice-background-color);border:1px solid var(--wp-ui-notice-border-color);border-radius:var(--wpds-border-radius-lg,8px);container-type:inline-size;display:grid;grid-template-columns:auto 1fr auto;padding:var(--wpds-dimension-padding-md,12px)}.d0a25570cb528528__icon{color:var(--wp-ui-notice-decorative-icon-color);grid-column:1;grid-row:1;margin-inline-end:var(--wpds-dimension-gap-xs,4px)}._1904b570a89bb815__description,.b5397fb9d05389e3__title{color:var(--wp-ui-notice-text-color);grid-column:2;padding-block:var(--text-vertical-padding)}._1904b570a89bb815__description{text-wrap:pretty}._0a1270dcdd79c031__actions{display:flex;flex-wrap:wrap;gap:var(--wpds-dimension-gap-md,12px);grid-column:2}._4145abab73d17514__notice:has(._1904b570a89bb815__description) ._0a1270dcdd79c031__actions,._4145abab73d17514__notice:has(.b5397fb9d05389e3__title) ._0a1270dcdd79c031__actions{margin-block-start:var(--wpds-dimension-gap-sm,8px)}._983740ab855c4e09__action-button{flex-shrink:0}.d329e7416d368d31__action-link{flex-shrink:0;&:not(:first-child){margin-inline-start:var(--wpds-dimension-gap-xs,4px)}&:not(:last-child){margin-inline-end:var(--wpds-dimension-gap-xs,4px)}}._487e6a5c1375f7dc__close-icon{grid-column:3;grid-row:1;margin-inline-start:var(--wpds-dimension-gap-xs,4px)}._531c140826094795__is-info{--wp-ui-notice-background-color:var(--wpds-color-background-surface-info-weak,#f3f9ff);--wp-ui-notice-border-color:var(--wpds-color-stroke-surface-info,#a9c6e7);--wp-ui-notice-text-color:var(--wpds-color-foreground-content-info,#001b4f);--wp-ui-notice-decorative-icon-color:var(--wpds-color-foreground-content-info-weak,#006bd7)}.ae2e1004697cce95__is-warning{--wp-ui-notice-background-color:var(--wpds-color-background-surface-warning-weak,#fff7e1);--wp-ui-notice-border-color:var(--wpds-color-stroke-surface-warning,#e1bc7c);--wp-ui-notice-text-color:var(--wpds-color-foreground-content-warning,#2e1900);--wp-ui-notice-decorative-icon-color:var(--wpds-color-foreground-content-warning-weak,#926300)}._2e614a76af494837__is-success{--wp-ui-notice-background-color:var(--wpds-color-background-surface-success-weak,#ebffed);--wp-ui-notice-border-color:var(--wpds-color-stroke-surface-success,#94d29e);--wp-ui-notice-text-color:var(--wpds-color-foreground-content-success,#002900);--wp-ui-notice-decorative-icon-color:var(--wpds-color-foreground-content-success-weak,#008030)}.af00331ae17a0065__is-error{--wp-ui-notice-background-color:var(--wpds-color-background-surface-error-weak,#fff6f5);--wp-ui-notice-border-color:var(--wpds-color-stroke-surface-error,#dab1aa);--wp-ui-notice-text-color:var(--wpds-color-foreground-content-error,#470000);--wp-ui-notice-decorative-icon-color:var(--wpds-color-foreground-content-error-weak,#cc1818)}@container (max-width: 320px){._4145abab73d17514__notice:has(.b5397fb9d05389e3__title) ._0a1270dcdd79c031__actions,._4145abab73d17514__notice:has(.b5397fb9d05389e3__title) ._1904b570a89bb815__description{grid-column:1/3}}}@layer compositions{.d329e7416d368d31__action-link{margin-block:auto}._487e6a5c1375f7dc__close-icon,._983740ab855c4e09__action-button:is(._8ddb8fb33fbf3d38__is-action-button-outline,._77bbde495a8a0af3__is-action-button-minimal){--wp-ui-button-background-color-active:color-mix(in srgb,transparent 50%,var(--wpds-color-background-interactive-neutral-weak-active,#ededed))}}}");
}
var style_default12 = { "notice": "_4145abab73d17514__notice", "icon": "d0a25570cb528528__icon", "title": "b5397fb9d05389e3__title", "description": "_1904b570a89bb815__description", "actions": "_0a1270dcdd79c031__actions", "action-button": "_983740ab855c4e09__action-button", "action-link": "d329e7416d368d31__action-link", "close-icon": "_487e6a5c1375f7dc__close-icon", "is-info": "_531c140826094795__is-info", "is-warning": "ae2e1004697cce95__is-warning", "is-success": "_2e614a76af494837__is-success", "is-error": "af00331ae17a0065__is-error", "is-action-button-outline": "_8ddb8fb33fbf3d38__is-action-button-outline", "is-action-button-minimal": "_77bbde495a8a0af3__is-action-button-minimal" };
var Title = (0, import_element30.forwardRef)(
  function NoticeTitle({ className, ...props }, ref) {
    return /* @__PURE__ */ (0, import_jsx_runtime41.jsx)(
      Text,
      {
        ref,
        variant: "heading-md",
        className: clsx_default(style_default12.title, className),
        ...props
      }
    );
  }
);

// packages/ui/build-module/notice/description.mjs
var import_element31 = __toESM(require_element(), 1);
var import_jsx_runtime42 = __toESM(require_jsx_runtime(), 1);
var STYLE_HASH_ATTRIBUTE14 = "data-wp-hash";
function getRuntime14() {
  const globalScope = globalThis;
  if (globalScope.__wpStyleRuntime) {
    return globalScope.__wpStyleRuntime;
  }
  globalScope.__wpStyleRuntime = {
    documents: /* @__PURE__ */ new Map(),
    styles: /* @__PURE__ */ new Map(),
    injectedStyles: /* @__PURE__ */ new WeakMap()
  };
  if (typeof document !== "undefined") {
    registerDocument14(document);
  }
  return globalScope.__wpStyleRuntime;
}
function documentContainsStyleHash14(targetDocument, hash) {
  if (!targetDocument.head) {
    return false;
  }
  for (const style of targetDocument.head.querySelectorAll(
    `style[${STYLE_HASH_ATTRIBUTE14}]`
  )) {
    if (style.getAttribute(STYLE_HASH_ATTRIBUTE14) === hash) {
      return true;
    }
  }
  return false;
}
function injectStyle14(targetDocument, hash, css) {
  if (!targetDocument.head) {
    return;
  }
  const runtime = getRuntime14();
  let injectedStyles = runtime.injectedStyles.get(targetDocument);
  if (!injectedStyles) {
    injectedStyles = /* @__PURE__ */ new Set();
    runtime.injectedStyles.set(targetDocument, injectedStyles);
  }
  if (injectedStyles.has(hash)) {
    return;
  }
  if (documentContainsStyleHash14(targetDocument, hash)) {
    injectedStyles.add(hash);
    return;
  }
  const style = targetDocument.createElement("style");
  style.setAttribute(STYLE_HASH_ATTRIBUTE14, hash);
  style.appendChild(targetDocument.createTextNode(css));
  targetDocument.head.appendChild(style);
  injectedStyles.add(hash);
}
function registerDocument14(targetDocument) {
  const runtime = getRuntime14();
  runtime.documents.set(
    targetDocument,
    (runtime.documents.get(targetDocument) ?? 0) + 1
  );
  for (const [hash, css] of runtime.styles) {
    injectStyle14(targetDocument, hash, css);
  }
  return () => {
    const count = runtime.documents.get(targetDocument);
    if (count === void 0) {
      return;
    }
    if (count <= 1) {
      runtime.documents.delete(targetDocument);
      return;
    }
    runtime.documents.set(targetDocument, count - 1);
  };
}
function registerStyle14(hash, css) {
  const runtime = getRuntime14();
  runtime.styles.set(hash, css);
  for (const targetDocument of runtime.documents.keys()) {
    injectStyle14(targetDocument, hash, css);
  }
}
if (typeof process === "undefined" || true) {
  registerStyle14("726c480820", "@layer wp-ui{@layer utilities, components, compositions, overrides;@layer components{._4145abab73d17514__notice{--icon-height:var(--wpds-dimension-size-sm,24px);--text-vertical-padding:calc((var(--icon-height) - var(--wpds-typography-line-height-sm, 20px))/2);--wp-ui-notice-background-color:var(--wpds-color-background-surface-neutral-weak,#f4f4f4);--wp-ui-notice-border-color:var(--wpds-color-stroke-surface-neutral,#dbdbdb);--wp-ui-notice-text-color:var(--wpds-color-foreground-content-neutral,#1e1e1e);--wp-ui-notice-decorative-icon-color:var(--wpds-color-foreground-content-neutral,#1e1e1e);align-items:start;background-color:var(--wp-ui-notice-background-color);border:1px solid var(--wp-ui-notice-border-color);border-radius:var(--wpds-border-radius-lg,8px);container-type:inline-size;display:grid;grid-template-columns:auto 1fr auto;padding:var(--wpds-dimension-padding-md,12px)}.d0a25570cb528528__icon{color:var(--wp-ui-notice-decorative-icon-color);grid-column:1;grid-row:1;margin-inline-end:var(--wpds-dimension-gap-xs,4px)}._1904b570a89bb815__description,.b5397fb9d05389e3__title{color:var(--wp-ui-notice-text-color);grid-column:2;padding-block:var(--text-vertical-padding)}._1904b570a89bb815__description{text-wrap:pretty}._0a1270dcdd79c031__actions{display:flex;flex-wrap:wrap;gap:var(--wpds-dimension-gap-md,12px);grid-column:2}._4145abab73d17514__notice:has(._1904b570a89bb815__description) ._0a1270dcdd79c031__actions,._4145abab73d17514__notice:has(.b5397fb9d05389e3__title) ._0a1270dcdd79c031__actions{margin-block-start:var(--wpds-dimension-gap-sm,8px)}._983740ab855c4e09__action-button{flex-shrink:0}.d329e7416d368d31__action-link{flex-shrink:0;&:not(:first-child){margin-inline-start:var(--wpds-dimension-gap-xs,4px)}&:not(:last-child){margin-inline-end:var(--wpds-dimension-gap-xs,4px)}}._487e6a5c1375f7dc__close-icon{grid-column:3;grid-row:1;margin-inline-start:var(--wpds-dimension-gap-xs,4px)}._531c140826094795__is-info{--wp-ui-notice-background-color:var(--wpds-color-background-surface-info-weak,#f3f9ff);--wp-ui-notice-border-color:var(--wpds-color-stroke-surface-info,#a9c6e7);--wp-ui-notice-text-color:var(--wpds-color-foreground-content-info,#001b4f);--wp-ui-notice-decorative-icon-color:var(--wpds-color-foreground-content-info-weak,#006bd7)}.ae2e1004697cce95__is-warning{--wp-ui-notice-background-color:var(--wpds-color-background-surface-warning-weak,#fff7e1);--wp-ui-notice-border-color:var(--wpds-color-stroke-surface-warning,#e1bc7c);--wp-ui-notice-text-color:var(--wpds-color-foreground-content-warning,#2e1900);--wp-ui-notice-decorative-icon-color:var(--wpds-color-foreground-content-warning-weak,#926300)}._2e614a76af494837__is-success{--wp-ui-notice-background-color:var(--wpds-color-background-surface-success-weak,#ebffed);--wp-ui-notice-border-color:var(--wpds-color-stroke-surface-success,#94d29e);--wp-ui-notice-text-color:var(--wpds-color-foreground-content-success,#002900);--wp-ui-notice-decorative-icon-color:var(--wpds-color-foreground-content-success-weak,#008030)}.af00331ae17a0065__is-error{--wp-ui-notice-background-color:var(--wpds-color-background-surface-error-weak,#fff6f5);--wp-ui-notice-border-color:var(--wpds-color-stroke-surface-error,#dab1aa);--wp-ui-notice-text-color:var(--wpds-color-foreground-content-error,#470000);--wp-ui-notice-decorative-icon-color:var(--wpds-color-foreground-content-error-weak,#cc1818)}@container (max-width: 320px){._4145abab73d17514__notice:has(.b5397fb9d05389e3__title) ._0a1270dcdd79c031__actions,._4145abab73d17514__notice:has(.b5397fb9d05389e3__title) ._1904b570a89bb815__description{grid-column:1/3}}}@layer compositions{.d329e7416d368d31__action-link{margin-block:auto}._487e6a5c1375f7dc__close-icon,._983740ab855c4e09__action-button:is(._8ddb8fb33fbf3d38__is-action-button-outline,._77bbde495a8a0af3__is-action-button-minimal){--wp-ui-button-background-color-active:color-mix(in srgb,transparent 50%,var(--wpds-color-background-interactive-neutral-weak-active,#ededed))}}}");
}
var style_default13 = { "notice": "_4145abab73d17514__notice", "icon": "d0a25570cb528528__icon", "title": "b5397fb9d05389e3__title", "description": "_1904b570a89bb815__description", "actions": "_0a1270dcdd79c031__actions", "action-button": "_983740ab855c4e09__action-button", "action-link": "d329e7416d368d31__action-link", "close-icon": "_487e6a5c1375f7dc__close-icon", "is-info": "_531c140826094795__is-info", "is-warning": "ae2e1004697cce95__is-warning", "is-success": "_2e614a76af494837__is-success", "is-error": "af00331ae17a0065__is-error", "is-action-button-outline": "_8ddb8fb33fbf3d38__is-action-button-outline", "is-action-button-minimal": "_77bbde495a8a0af3__is-action-button-minimal" };
var Description = (0, import_element31.forwardRef)(
  function NoticeDescription({ className, ...props }, ref) {
    return /* @__PURE__ */ (0, import_jsx_runtime42.jsx)(
      Text,
      {
        ref,
        variant: "body-md",
        className: clsx_default(style_default13.description, className),
        ...props
      }
    );
  }
);

// packages/ui/build-module/notice/actions.mjs
var import_element32 = __toESM(require_element(), 1);
var STYLE_HASH_ATTRIBUTE15 = "data-wp-hash";
function getRuntime15() {
  const globalScope = globalThis;
  if (globalScope.__wpStyleRuntime) {
    return globalScope.__wpStyleRuntime;
  }
  globalScope.__wpStyleRuntime = {
    documents: /* @__PURE__ */ new Map(),
    styles: /* @__PURE__ */ new Map(),
    injectedStyles: /* @__PURE__ */ new WeakMap()
  };
  if (typeof document !== "undefined") {
    registerDocument15(document);
  }
  return globalScope.__wpStyleRuntime;
}
function documentContainsStyleHash15(targetDocument, hash) {
  if (!targetDocument.head) {
    return false;
  }
  for (const style of targetDocument.head.querySelectorAll(
    `style[${STYLE_HASH_ATTRIBUTE15}]`
  )) {
    if (style.getAttribute(STYLE_HASH_ATTRIBUTE15) === hash) {
      return true;
    }
  }
  return false;
}
function injectStyle15(targetDocument, hash, css) {
  if (!targetDocument.head) {
    return;
  }
  const runtime = getRuntime15();
  let injectedStyles = runtime.injectedStyles.get(targetDocument);
  if (!injectedStyles) {
    injectedStyles = /* @__PURE__ */ new Set();
    runtime.injectedStyles.set(targetDocument, injectedStyles);
  }
  if (injectedStyles.has(hash)) {
    return;
  }
  if (documentContainsStyleHash15(targetDocument, hash)) {
    injectedStyles.add(hash);
    return;
  }
  const style = targetDocument.createElement("style");
  style.setAttribute(STYLE_HASH_ATTRIBUTE15, hash);
  style.appendChild(targetDocument.createTextNode(css));
  targetDocument.head.appendChild(style);
  injectedStyles.add(hash);
}
function registerDocument15(targetDocument) {
  const runtime = getRuntime15();
  runtime.documents.set(
    targetDocument,
    (runtime.documents.get(targetDocument) ?? 0) + 1
  );
  for (const [hash, css] of runtime.styles) {
    injectStyle15(targetDocument, hash, css);
  }
  return () => {
    const count = runtime.documents.get(targetDocument);
    if (count === void 0) {
      return;
    }
    if (count <= 1) {
      runtime.documents.delete(targetDocument);
      return;
    }
    runtime.documents.set(targetDocument, count - 1);
  };
}
function registerStyle15(hash, css) {
  const runtime = getRuntime15();
  runtime.styles.set(hash, css);
  for (const targetDocument of runtime.documents.keys()) {
    injectStyle15(targetDocument, hash, css);
  }
}
if (typeof process === "undefined" || true) {
  registerStyle15("726c480820", "@layer wp-ui{@layer utilities, components, compositions, overrides;@layer components{._4145abab73d17514__notice{--icon-height:var(--wpds-dimension-size-sm,24px);--text-vertical-padding:calc((var(--icon-height) - var(--wpds-typography-line-height-sm, 20px))/2);--wp-ui-notice-background-color:var(--wpds-color-background-surface-neutral-weak,#f4f4f4);--wp-ui-notice-border-color:var(--wpds-color-stroke-surface-neutral,#dbdbdb);--wp-ui-notice-text-color:var(--wpds-color-foreground-content-neutral,#1e1e1e);--wp-ui-notice-decorative-icon-color:var(--wpds-color-foreground-content-neutral,#1e1e1e);align-items:start;background-color:var(--wp-ui-notice-background-color);border:1px solid var(--wp-ui-notice-border-color);border-radius:var(--wpds-border-radius-lg,8px);container-type:inline-size;display:grid;grid-template-columns:auto 1fr auto;padding:var(--wpds-dimension-padding-md,12px)}.d0a25570cb528528__icon{color:var(--wp-ui-notice-decorative-icon-color);grid-column:1;grid-row:1;margin-inline-end:var(--wpds-dimension-gap-xs,4px)}._1904b570a89bb815__description,.b5397fb9d05389e3__title{color:var(--wp-ui-notice-text-color);grid-column:2;padding-block:var(--text-vertical-padding)}._1904b570a89bb815__description{text-wrap:pretty}._0a1270dcdd79c031__actions{display:flex;flex-wrap:wrap;gap:var(--wpds-dimension-gap-md,12px);grid-column:2}._4145abab73d17514__notice:has(._1904b570a89bb815__description) ._0a1270dcdd79c031__actions,._4145abab73d17514__notice:has(.b5397fb9d05389e3__title) ._0a1270dcdd79c031__actions{margin-block-start:var(--wpds-dimension-gap-sm,8px)}._983740ab855c4e09__action-button{flex-shrink:0}.d329e7416d368d31__action-link{flex-shrink:0;&:not(:first-child){margin-inline-start:var(--wpds-dimension-gap-xs,4px)}&:not(:last-child){margin-inline-end:var(--wpds-dimension-gap-xs,4px)}}._487e6a5c1375f7dc__close-icon{grid-column:3;grid-row:1;margin-inline-start:var(--wpds-dimension-gap-xs,4px)}._531c140826094795__is-info{--wp-ui-notice-background-color:var(--wpds-color-background-surface-info-weak,#f3f9ff);--wp-ui-notice-border-color:var(--wpds-color-stroke-surface-info,#a9c6e7);--wp-ui-notice-text-color:var(--wpds-color-foreground-content-info,#001b4f);--wp-ui-notice-decorative-icon-color:var(--wpds-color-foreground-content-info-weak,#006bd7)}.ae2e1004697cce95__is-warning{--wp-ui-notice-background-color:var(--wpds-color-background-surface-warning-weak,#fff7e1);--wp-ui-notice-border-color:var(--wpds-color-stroke-surface-warning,#e1bc7c);--wp-ui-notice-text-color:var(--wpds-color-foreground-content-warning,#2e1900);--wp-ui-notice-decorative-icon-color:var(--wpds-color-foreground-content-warning-weak,#926300)}._2e614a76af494837__is-success{--wp-ui-notice-background-color:var(--wpds-color-background-surface-success-weak,#ebffed);--wp-ui-notice-border-color:var(--wpds-color-stroke-surface-success,#94d29e);--wp-ui-notice-text-color:var(--wpds-color-foreground-content-success,#002900);--wp-ui-notice-decorative-icon-color:var(--wpds-color-foreground-content-success-weak,#008030)}.af00331ae17a0065__is-error{--wp-ui-notice-background-color:var(--wpds-color-background-surface-error-weak,#fff6f5);--wp-ui-notice-border-color:var(--wpds-color-stroke-surface-error,#dab1aa);--wp-ui-notice-text-color:var(--wpds-color-foreground-content-error,#470000);--wp-ui-notice-decorative-icon-color:var(--wpds-color-foreground-content-error-weak,#cc1818)}@container (max-width: 320px){._4145abab73d17514__notice:has(.b5397fb9d05389e3__title) ._0a1270dcdd79c031__actions,._4145abab73d17514__notice:has(.b5397fb9d05389e3__title) ._1904b570a89bb815__description{grid-column:1/3}}}@layer compositions{.d329e7416d368d31__action-link{margin-block:auto}._487e6a5c1375f7dc__close-icon,._983740ab855c4e09__action-button:is(._8ddb8fb33fbf3d38__is-action-button-outline,._77bbde495a8a0af3__is-action-button-minimal){--wp-ui-button-background-color-active:color-mix(in srgb,transparent 50%,var(--wpds-color-background-interactive-neutral-weak-active,#ededed))}}}");
}
var style_default14 = { "notice": "_4145abab73d17514__notice", "icon": "d0a25570cb528528__icon", "title": "b5397fb9d05389e3__title", "description": "_1904b570a89bb815__description", "actions": "_0a1270dcdd79c031__actions", "action-button": "_983740ab855c4e09__action-button", "action-link": "d329e7416d368d31__action-link", "close-icon": "_487e6a5c1375f7dc__close-icon", "is-info": "_531c140826094795__is-info", "is-warning": "ae2e1004697cce95__is-warning", "is-success": "_2e614a76af494837__is-success", "is-error": "af00331ae17a0065__is-error", "is-action-button-outline": "_8ddb8fb33fbf3d38__is-action-button-outline", "is-action-button-minimal": "_77bbde495a8a0af3__is-action-button-minimal" };
var Actions = (0, import_element32.forwardRef)(
  function NoticeActions({ render, ...props }, ref) {
    const element = useRender({
      defaultTagName: "div",
      render,
      ref,
      props: mergeProps(
        {
          className: style_default14.actions
        },
        props
      )
    });
    return element;
  }
);

// packages/ui/build-module/notice/close-icon.mjs
var import_element33 = __toESM(require_element(), 1);
var import_i18n3 = __toESM(require_i18n(), 1);
var import_jsx_runtime43 = __toESM(require_jsx_runtime(), 1);
var STYLE_HASH_ATTRIBUTE16 = "data-wp-hash";
function getRuntime16() {
  const globalScope = globalThis;
  if (globalScope.__wpStyleRuntime) {
    return globalScope.__wpStyleRuntime;
  }
  globalScope.__wpStyleRuntime = {
    documents: /* @__PURE__ */ new Map(),
    styles: /* @__PURE__ */ new Map(),
    injectedStyles: /* @__PURE__ */ new WeakMap()
  };
  if (typeof document !== "undefined") {
    registerDocument16(document);
  }
  return globalScope.__wpStyleRuntime;
}
function documentContainsStyleHash16(targetDocument, hash) {
  if (!targetDocument.head) {
    return false;
  }
  for (const style of targetDocument.head.querySelectorAll(
    `style[${STYLE_HASH_ATTRIBUTE16}]`
  )) {
    if (style.getAttribute(STYLE_HASH_ATTRIBUTE16) === hash) {
      return true;
    }
  }
  return false;
}
function injectStyle16(targetDocument, hash, css) {
  if (!targetDocument.head) {
    return;
  }
  const runtime = getRuntime16();
  let injectedStyles = runtime.injectedStyles.get(targetDocument);
  if (!injectedStyles) {
    injectedStyles = /* @__PURE__ */ new Set();
    runtime.injectedStyles.set(targetDocument, injectedStyles);
  }
  if (injectedStyles.has(hash)) {
    return;
  }
  if (documentContainsStyleHash16(targetDocument, hash)) {
    injectedStyles.add(hash);
    return;
  }
  const style = targetDocument.createElement("style");
  style.setAttribute(STYLE_HASH_ATTRIBUTE16, hash);
  style.appendChild(targetDocument.createTextNode(css));
  targetDocument.head.appendChild(style);
  injectedStyles.add(hash);
}
function registerDocument16(targetDocument) {
  const runtime = getRuntime16();
  runtime.documents.set(
    targetDocument,
    (runtime.documents.get(targetDocument) ?? 0) + 1
  );
  for (const [hash, css] of runtime.styles) {
    injectStyle16(targetDocument, hash, css);
  }
  return () => {
    const count = runtime.documents.get(targetDocument);
    if (count === void 0) {
      return;
    }
    if (count <= 1) {
      runtime.documents.delete(targetDocument);
      return;
    }
    runtime.documents.set(targetDocument, count - 1);
  };
}
function registerStyle16(hash, css) {
  const runtime = getRuntime16();
  runtime.styles.set(hash, css);
  for (const targetDocument of runtime.documents.keys()) {
    injectStyle16(targetDocument, hash, css);
  }
}
if (typeof process === "undefined" || true) {
  registerStyle16("726c480820", "@layer wp-ui{@layer utilities, components, compositions, overrides;@layer components{._4145abab73d17514__notice{--icon-height:var(--wpds-dimension-size-sm,24px);--text-vertical-padding:calc((var(--icon-height) - var(--wpds-typography-line-height-sm, 20px))/2);--wp-ui-notice-background-color:var(--wpds-color-background-surface-neutral-weak,#f4f4f4);--wp-ui-notice-border-color:var(--wpds-color-stroke-surface-neutral,#dbdbdb);--wp-ui-notice-text-color:var(--wpds-color-foreground-content-neutral,#1e1e1e);--wp-ui-notice-decorative-icon-color:var(--wpds-color-foreground-content-neutral,#1e1e1e);align-items:start;background-color:var(--wp-ui-notice-background-color);border:1px solid var(--wp-ui-notice-border-color);border-radius:var(--wpds-border-radius-lg,8px);container-type:inline-size;display:grid;grid-template-columns:auto 1fr auto;padding:var(--wpds-dimension-padding-md,12px)}.d0a25570cb528528__icon{color:var(--wp-ui-notice-decorative-icon-color);grid-column:1;grid-row:1;margin-inline-end:var(--wpds-dimension-gap-xs,4px)}._1904b570a89bb815__description,.b5397fb9d05389e3__title{color:var(--wp-ui-notice-text-color);grid-column:2;padding-block:var(--text-vertical-padding)}._1904b570a89bb815__description{text-wrap:pretty}._0a1270dcdd79c031__actions{display:flex;flex-wrap:wrap;gap:var(--wpds-dimension-gap-md,12px);grid-column:2}._4145abab73d17514__notice:has(._1904b570a89bb815__description) ._0a1270dcdd79c031__actions,._4145abab73d17514__notice:has(.b5397fb9d05389e3__title) ._0a1270dcdd79c031__actions{margin-block-start:var(--wpds-dimension-gap-sm,8px)}._983740ab855c4e09__action-button{flex-shrink:0}.d329e7416d368d31__action-link{flex-shrink:0;&:not(:first-child){margin-inline-start:var(--wpds-dimension-gap-xs,4px)}&:not(:last-child){margin-inline-end:var(--wpds-dimension-gap-xs,4px)}}._487e6a5c1375f7dc__close-icon{grid-column:3;grid-row:1;margin-inline-start:var(--wpds-dimension-gap-xs,4px)}._531c140826094795__is-info{--wp-ui-notice-background-color:var(--wpds-color-background-surface-info-weak,#f3f9ff);--wp-ui-notice-border-color:var(--wpds-color-stroke-surface-info,#a9c6e7);--wp-ui-notice-text-color:var(--wpds-color-foreground-content-info,#001b4f);--wp-ui-notice-decorative-icon-color:var(--wpds-color-foreground-content-info-weak,#006bd7)}.ae2e1004697cce95__is-warning{--wp-ui-notice-background-color:var(--wpds-color-background-surface-warning-weak,#fff7e1);--wp-ui-notice-border-color:var(--wpds-color-stroke-surface-warning,#e1bc7c);--wp-ui-notice-text-color:var(--wpds-color-foreground-content-warning,#2e1900);--wp-ui-notice-decorative-icon-color:var(--wpds-color-foreground-content-warning-weak,#926300)}._2e614a76af494837__is-success{--wp-ui-notice-background-color:var(--wpds-color-background-surface-success-weak,#ebffed);--wp-ui-notice-border-color:var(--wpds-color-stroke-surface-success,#94d29e);--wp-ui-notice-text-color:var(--wpds-color-foreground-content-success,#002900);--wp-ui-notice-decorative-icon-color:var(--wpds-color-foreground-content-success-weak,#008030)}.af00331ae17a0065__is-error{--wp-ui-notice-background-color:var(--wpds-color-background-surface-error-weak,#fff6f5);--wp-ui-notice-border-color:var(--wpds-color-stroke-surface-error,#dab1aa);--wp-ui-notice-text-color:var(--wpds-color-foreground-content-error,#470000);--wp-ui-notice-decorative-icon-color:var(--wpds-color-foreground-content-error-weak,#cc1818)}@container (max-width: 320px){._4145abab73d17514__notice:has(.b5397fb9d05389e3__title) ._0a1270dcdd79c031__actions,._4145abab73d17514__notice:has(.b5397fb9d05389e3__title) ._1904b570a89bb815__description{grid-column:1/3}}}@layer compositions{.d329e7416d368d31__action-link{margin-block:auto}._487e6a5c1375f7dc__close-icon,._983740ab855c4e09__action-button:is(._8ddb8fb33fbf3d38__is-action-button-outline,._77bbde495a8a0af3__is-action-button-minimal){--wp-ui-button-background-color-active:color-mix(in srgb,transparent 50%,var(--wpds-color-background-interactive-neutral-weak-active,#ededed))}}}");
}
var style_default15 = { "notice": "_4145abab73d17514__notice", "icon": "d0a25570cb528528__icon", "title": "b5397fb9d05389e3__title", "description": "_1904b570a89bb815__description", "actions": "_0a1270dcdd79c031__actions", "action-button": "_983740ab855c4e09__action-button", "action-link": "d329e7416d368d31__action-link", "close-icon": "_487e6a5c1375f7dc__close-icon", "is-info": "_531c140826094795__is-info", "is-warning": "ae2e1004697cce95__is-warning", "is-success": "_2e614a76af494837__is-success", "is-error": "af00331ae17a0065__is-error", "is-action-button-outline": "_8ddb8fb33fbf3d38__is-action-button-outline", "is-action-button-minimal": "_77bbde495a8a0af3__is-action-button-minimal" };
var CloseIcon = (0, import_element33.forwardRef)(
  function NoticeCloseIcon({ className, icon = close_small_default, label = (0, import_i18n3.__)("Dismiss"), ...props }, ref) {
    return /* @__PURE__ */ (0, import_jsx_runtime43.jsx)(
      IconButton,
      {
        ...props,
        ref,
        className: clsx_default(style_default15["close-icon"], className),
        variant: "minimal",
        size: "small",
        tone: "neutral",
        icon,
        label
      }
    );
  }
);

// packages/ui/build-module/notice/action-button.mjs
var import_element34 = __toESM(require_element(), 1);
var import_jsx_runtime44 = __toESM(require_jsx_runtime(), 1);
var STYLE_HASH_ATTRIBUTE17 = "data-wp-hash";
function getRuntime17() {
  const globalScope = globalThis;
  if (globalScope.__wpStyleRuntime) {
    return globalScope.__wpStyleRuntime;
  }
  globalScope.__wpStyleRuntime = {
    documents: /* @__PURE__ */ new Map(),
    styles: /* @__PURE__ */ new Map(),
    injectedStyles: /* @__PURE__ */ new WeakMap()
  };
  if (typeof document !== "undefined") {
    registerDocument17(document);
  }
  return globalScope.__wpStyleRuntime;
}
function documentContainsStyleHash17(targetDocument, hash) {
  if (!targetDocument.head) {
    return false;
  }
  for (const style of targetDocument.head.querySelectorAll(
    `style[${STYLE_HASH_ATTRIBUTE17}]`
  )) {
    if (style.getAttribute(STYLE_HASH_ATTRIBUTE17) === hash) {
      return true;
    }
  }
  return false;
}
function injectStyle17(targetDocument, hash, css) {
  if (!targetDocument.head) {
    return;
  }
  const runtime = getRuntime17();
  let injectedStyles = runtime.injectedStyles.get(targetDocument);
  if (!injectedStyles) {
    injectedStyles = /* @__PURE__ */ new Set();
    runtime.injectedStyles.set(targetDocument, injectedStyles);
  }
  if (injectedStyles.has(hash)) {
    return;
  }
  if (documentContainsStyleHash17(targetDocument, hash)) {
    injectedStyles.add(hash);
    return;
  }
  const style = targetDocument.createElement("style");
  style.setAttribute(STYLE_HASH_ATTRIBUTE17, hash);
  style.appendChild(targetDocument.createTextNode(css));
  targetDocument.head.appendChild(style);
  injectedStyles.add(hash);
}
function registerDocument17(targetDocument) {
  const runtime = getRuntime17();
  runtime.documents.set(
    targetDocument,
    (runtime.documents.get(targetDocument) ?? 0) + 1
  );
  for (const [hash, css] of runtime.styles) {
    injectStyle17(targetDocument, hash, css);
  }
  return () => {
    const count = runtime.documents.get(targetDocument);
    if (count === void 0) {
      return;
    }
    if (count <= 1) {
      runtime.documents.delete(targetDocument);
      return;
    }
    runtime.documents.set(targetDocument, count - 1);
  };
}
function registerStyle17(hash, css) {
  const runtime = getRuntime17();
  runtime.styles.set(hash, css);
  for (const targetDocument of runtime.documents.keys()) {
    injectStyle17(targetDocument, hash, css);
  }
}
if (typeof process === "undefined" || true) {
  registerStyle17("726c480820", "@layer wp-ui{@layer utilities, components, compositions, overrides;@layer components{._4145abab73d17514__notice{--icon-height:var(--wpds-dimension-size-sm,24px);--text-vertical-padding:calc((var(--icon-height) - var(--wpds-typography-line-height-sm, 20px))/2);--wp-ui-notice-background-color:var(--wpds-color-background-surface-neutral-weak,#f4f4f4);--wp-ui-notice-border-color:var(--wpds-color-stroke-surface-neutral,#dbdbdb);--wp-ui-notice-text-color:var(--wpds-color-foreground-content-neutral,#1e1e1e);--wp-ui-notice-decorative-icon-color:var(--wpds-color-foreground-content-neutral,#1e1e1e);align-items:start;background-color:var(--wp-ui-notice-background-color);border:1px solid var(--wp-ui-notice-border-color);border-radius:var(--wpds-border-radius-lg,8px);container-type:inline-size;display:grid;grid-template-columns:auto 1fr auto;padding:var(--wpds-dimension-padding-md,12px)}.d0a25570cb528528__icon{color:var(--wp-ui-notice-decorative-icon-color);grid-column:1;grid-row:1;margin-inline-end:var(--wpds-dimension-gap-xs,4px)}._1904b570a89bb815__description,.b5397fb9d05389e3__title{color:var(--wp-ui-notice-text-color);grid-column:2;padding-block:var(--text-vertical-padding)}._1904b570a89bb815__description{text-wrap:pretty}._0a1270dcdd79c031__actions{display:flex;flex-wrap:wrap;gap:var(--wpds-dimension-gap-md,12px);grid-column:2}._4145abab73d17514__notice:has(._1904b570a89bb815__description) ._0a1270dcdd79c031__actions,._4145abab73d17514__notice:has(.b5397fb9d05389e3__title) ._0a1270dcdd79c031__actions{margin-block-start:var(--wpds-dimension-gap-sm,8px)}._983740ab855c4e09__action-button{flex-shrink:0}.d329e7416d368d31__action-link{flex-shrink:0;&:not(:first-child){margin-inline-start:var(--wpds-dimension-gap-xs,4px)}&:not(:last-child){margin-inline-end:var(--wpds-dimension-gap-xs,4px)}}._487e6a5c1375f7dc__close-icon{grid-column:3;grid-row:1;margin-inline-start:var(--wpds-dimension-gap-xs,4px)}._531c140826094795__is-info{--wp-ui-notice-background-color:var(--wpds-color-background-surface-info-weak,#f3f9ff);--wp-ui-notice-border-color:var(--wpds-color-stroke-surface-info,#a9c6e7);--wp-ui-notice-text-color:var(--wpds-color-foreground-content-info,#001b4f);--wp-ui-notice-decorative-icon-color:var(--wpds-color-foreground-content-info-weak,#006bd7)}.ae2e1004697cce95__is-warning{--wp-ui-notice-background-color:var(--wpds-color-background-surface-warning-weak,#fff7e1);--wp-ui-notice-border-color:var(--wpds-color-stroke-surface-warning,#e1bc7c);--wp-ui-notice-text-color:var(--wpds-color-foreground-content-warning,#2e1900);--wp-ui-notice-decorative-icon-color:var(--wpds-color-foreground-content-warning-weak,#926300)}._2e614a76af494837__is-success{--wp-ui-notice-background-color:var(--wpds-color-background-surface-success-weak,#ebffed);--wp-ui-notice-border-color:var(--wpds-color-stroke-surface-success,#94d29e);--wp-ui-notice-text-color:var(--wpds-color-foreground-content-success,#002900);--wp-ui-notice-decorative-icon-color:var(--wpds-color-foreground-content-success-weak,#008030)}.af00331ae17a0065__is-error{--wp-ui-notice-background-color:var(--wpds-color-background-surface-error-weak,#fff6f5);--wp-ui-notice-border-color:var(--wpds-color-stroke-surface-error,#dab1aa);--wp-ui-notice-text-color:var(--wpds-color-foreground-content-error,#470000);--wp-ui-notice-decorative-icon-color:var(--wpds-color-foreground-content-error-weak,#cc1818)}@container (max-width: 320px){._4145abab73d17514__notice:has(.b5397fb9d05389e3__title) ._0a1270dcdd79c031__actions,._4145abab73d17514__notice:has(.b5397fb9d05389e3__title) ._1904b570a89bb815__description{grid-column:1/3}}}@layer compositions{.d329e7416d368d31__action-link{margin-block:auto}._487e6a5c1375f7dc__close-icon,._983740ab855c4e09__action-button:is(._8ddb8fb33fbf3d38__is-action-button-outline,._77bbde495a8a0af3__is-action-button-minimal){--wp-ui-button-background-color-active:color-mix(in srgb,transparent 50%,var(--wpds-color-background-interactive-neutral-weak-active,#ededed))}}}");
}
var style_default16 = { "notice": "_4145abab73d17514__notice", "icon": "d0a25570cb528528__icon", "title": "b5397fb9d05389e3__title", "description": "_1904b570a89bb815__description", "actions": "_0a1270dcdd79c031__actions", "action-button": "_983740ab855c4e09__action-button", "action-link": "d329e7416d368d31__action-link", "close-icon": "_487e6a5c1375f7dc__close-icon", "is-info": "_531c140826094795__is-info", "is-warning": "ae2e1004697cce95__is-warning", "is-success": "_2e614a76af494837__is-success", "is-error": "af00331ae17a0065__is-error", "is-action-button-outline": "_8ddb8fb33fbf3d38__is-action-button-outline", "is-action-button-minimal": "_77bbde495a8a0af3__is-action-button-minimal" };
var ActionButton = (0, import_element34.forwardRef)(
  function NoticeActionButton({ className, loading, loadingAnnouncement, variant, ...props }, ref) {
    const loadingProps = loading !== void 0 ? { loading, loadingAnnouncement: loadingAnnouncement ?? "" } : {};
    return /* @__PURE__ */ (0, import_jsx_runtime44.jsx)(
      Button4,
      {
        ...props,
        ...loadingProps,
        ref,
        size: "compact",
        tone: "neutral",
        variant,
        className: clsx_default(
          style_default16["action-button"],
          style_default16[`is-action-button-${variant}`],
          className
        )
      }
    );
  }
);

// packages/ui/build-module/notice/action-link.mjs
var import_element35 = __toESM(require_element(), 1);
var import_jsx_runtime45 = __toESM(require_jsx_runtime(), 1);
var STYLE_HASH_ATTRIBUTE18 = "data-wp-hash";
function getRuntime18() {
  const globalScope = globalThis;
  if (globalScope.__wpStyleRuntime) {
    return globalScope.__wpStyleRuntime;
  }
  globalScope.__wpStyleRuntime = {
    documents: /* @__PURE__ */ new Map(),
    styles: /* @__PURE__ */ new Map(),
    injectedStyles: /* @__PURE__ */ new WeakMap()
  };
  if (typeof document !== "undefined") {
    registerDocument18(document);
  }
  return globalScope.__wpStyleRuntime;
}
function documentContainsStyleHash18(targetDocument, hash) {
  if (!targetDocument.head) {
    return false;
  }
  for (const style of targetDocument.head.querySelectorAll(
    `style[${STYLE_HASH_ATTRIBUTE18}]`
  )) {
    if (style.getAttribute(STYLE_HASH_ATTRIBUTE18) === hash) {
      return true;
    }
  }
  return false;
}
function injectStyle18(targetDocument, hash, css) {
  if (!targetDocument.head) {
    return;
  }
  const runtime = getRuntime18();
  let injectedStyles = runtime.injectedStyles.get(targetDocument);
  if (!injectedStyles) {
    injectedStyles = /* @__PURE__ */ new Set();
    runtime.injectedStyles.set(targetDocument, injectedStyles);
  }
  if (injectedStyles.has(hash)) {
    return;
  }
  if (documentContainsStyleHash18(targetDocument, hash)) {
    injectedStyles.add(hash);
    return;
  }
  const style = targetDocument.createElement("style");
  style.setAttribute(STYLE_HASH_ATTRIBUTE18, hash);
  style.appendChild(targetDocument.createTextNode(css));
  targetDocument.head.appendChild(style);
  injectedStyles.add(hash);
}
function registerDocument18(targetDocument) {
  const runtime = getRuntime18();
  runtime.documents.set(
    targetDocument,
    (runtime.documents.get(targetDocument) ?? 0) + 1
  );
  for (const [hash, css] of runtime.styles) {
    injectStyle18(targetDocument, hash, css);
  }
  return () => {
    const count = runtime.documents.get(targetDocument);
    if (count === void 0) {
      return;
    }
    if (count <= 1) {
      runtime.documents.delete(targetDocument);
      return;
    }
    runtime.documents.set(targetDocument, count - 1);
  };
}
function registerStyle18(hash, css) {
  const runtime = getRuntime18();
  runtime.styles.set(hash, css);
  for (const targetDocument of runtime.documents.keys()) {
    injectStyle18(targetDocument, hash, css);
  }
}
if (typeof process === "undefined" || true) {
  registerStyle18("726c480820", "@layer wp-ui{@layer utilities, components, compositions, overrides;@layer components{._4145abab73d17514__notice{--icon-height:var(--wpds-dimension-size-sm,24px);--text-vertical-padding:calc((var(--icon-height) - var(--wpds-typography-line-height-sm, 20px))/2);--wp-ui-notice-background-color:var(--wpds-color-background-surface-neutral-weak,#f4f4f4);--wp-ui-notice-border-color:var(--wpds-color-stroke-surface-neutral,#dbdbdb);--wp-ui-notice-text-color:var(--wpds-color-foreground-content-neutral,#1e1e1e);--wp-ui-notice-decorative-icon-color:var(--wpds-color-foreground-content-neutral,#1e1e1e);align-items:start;background-color:var(--wp-ui-notice-background-color);border:1px solid var(--wp-ui-notice-border-color);border-radius:var(--wpds-border-radius-lg,8px);container-type:inline-size;display:grid;grid-template-columns:auto 1fr auto;padding:var(--wpds-dimension-padding-md,12px)}.d0a25570cb528528__icon{color:var(--wp-ui-notice-decorative-icon-color);grid-column:1;grid-row:1;margin-inline-end:var(--wpds-dimension-gap-xs,4px)}._1904b570a89bb815__description,.b5397fb9d05389e3__title{color:var(--wp-ui-notice-text-color);grid-column:2;padding-block:var(--text-vertical-padding)}._1904b570a89bb815__description{text-wrap:pretty}._0a1270dcdd79c031__actions{display:flex;flex-wrap:wrap;gap:var(--wpds-dimension-gap-md,12px);grid-column:2}._4145abab73d17514__notice:has(._1904b570a89bb815__description) ._0a1270dcdd79c031__actions,._4145abab73d17514__notice:has(.b5397fb9d05389e3__title) ._0a1270dcdd79c031__actions{margin-block-start:var(--wpds-dimension-gap-sm,8px)}._983740ab855c4e09__action-button{flex-shrink:0}.d329e7416d368d31__action-link{flex-shrink:0;&:not(:first-child){margin-inline-start:var(--wpds-dimension-gap-xs,4px)}&:not(:last-child){margin-inline-end:var(--wpds-dimension-gap-xs,4px)}}._487e6a5c1375f7dc__close-icon{grid-column:3;grid-row:1;margin-inline-start:var(--wpds-dimension-gap-xs,4px)}._531c140826094795__is-info{--wp-ui-notice-background-color:var(--wpds-color-background-surface-info-weak,#f3f9ff);--wp-ui-notice-border-color:var(--wpds-color-stroke-surface-info,#a9c6e7);--wp-ui-notice-text-color:var(--wpds-color-foreground-content-info,#001b4f);--wp-ui-notice-decorative-icon-color:var(--wpds-color-foreground-content-info-weak,#006bd7)}.ae2e1004697cce95__is-warning{--wp-ui-notice-background-color:var(--wpds-color-background-surface-warning-weak,#fff7e1);--wp-ui-notice-border-color:var(--wpds-color-stroke-surface-warning,#e1bc7c);--wp-ui-notice-text-color:var(--wpds-color-foreground-content-warning,#2e1900);--wp-ui-notice-decorative-icon-color:var(--wpds-color-foreground-content-warning-weak,#926300)}._2e614a76af494837__is-success{--wp-ui-notice-background-color:var(--wpds-color-background-surface-success-weak,#ebffed);--wp-ui-notice-border-color:var(--wpds-color-stroke-surface-success,#94d29e);--wp-ui-notice-text-color:var(--wpds-color-foreground-content-success,#002900);--wp-ui-notice-decorative-icon-color:var(--wpds-color-foreground-content-success-weak,#008030)}.af00331ae17a0065__is-error{--wp-ui-notice-background-color:var(--wpds-color-background-surface-error-weak,#fff6f5);--wp-ui-notice-border-color:var(--wpds-color-stroke-surface-error,#dab1aa);--wp-ui-notice-text-color:var(--wpds-color-foreground-content-error,#470000);--wp-ui-notice-decorative-icon-color:var(--wpds-color-foreground-content-error-weak,#cc1818)}@container (max-width: 320px){._4145abab73d17514__notice:has(.b5397fb9d05389e3__title) ._0a1270dcdd79c031__actions,._4145abab73d17514__notice:has(.b5397fb9d05389e3__title) ._1904b570a89bb815__description{grid-column:1/3}}}@layer compositions{.d329e7416d368d31__action-link{margin-block:auto}._487e6a5c1375f7dc__close-icon,._983740ab855c4e09__action-button:is(._8ddb8fb33fbf3d38__is-action-button-outline,._77bbde495a8a0af3__is-action-button-minimal){--wp-ui-button-background-color-active:color-mix(in srgb,transparent 50%,var(--wpds-color-background-interactive-neutral-weak-active,#ededed))}}}");
}
var style_default17 = { "notice": "_4145abab73d17514__notice", "icon": "d0a25570cb528528__icon", "title": "b5397fb9d05389e3__title", "description": "_1904b570a89bb815__description", "actions": "_0a1270dcdd79c031__actions", "action-button": "_983740ab855c4e09__action-button", "action-link": "d329e7416d368d31__action-link", "close-icon": "_487e6a5c1375f7dc__close-icon", "is-info": "_531c140826094795__is-info", "is-warning": "ae2e1004697cce95__is-warning", "is-success": "_2e614a76af494837__is-success", "is-error": "af00331ae17a0065__is-error", "is-action-button-outline": "_8ddb8fb33fbf3d38__is-action-button-outline", "is-action-button-minimal": "_77bbde495a8a0af3__is-action-button-minimal" };
var ActionLink = (0, import_element35.forwardRef)(
  function NoticeActionLink({ className, render, ...props }, ref) {
    return /* @__PURE__ */ (0, import_jsx_runtime45.jsx)(
      Text,
      {
        ref,
        className: clsx_default(style_default17["action-link"], className),
        ...props,
        variant: "body-md",
        render: /* @__PURE__ */ (0, import_jsx_runtime45.jsx)(Link, { tone: "neutral", variant: "default", render })
      }
    );
  }
);

// packages/ui/build-module/popover/index.mjs
var popover_exports = {};
__export(popover_exports, {
  Arrow: () => Arrow,
  Close: () => Close,
  Description: () => Description2,
  Popup: () => Popup2,
  Portal: () => Portal2,
  Positioner: () => Positioner2,
  Root: () => Root3,
  Title: () => Title2,
  Trigger: () => Trigger2
});

// packages/ui/build-module/popover/arrow.mjs
var import_element36 = __toESM(require_element(), 1);
var import_jsx_runtime46 = __toESM(require_jsx_runtime(), 1);
var STYLE_HASH_ATTRIBUTE19 = "data-wp-hash";
function getRuntime19() {
  const globalScope = globalThis;
  if (globalScope.__wpStyleRuntime) {
    return globalScope.__wpStyleRuntime;
  }
  globalScope.__wpStyleRuntime = {
    documents: /* @__PURE__ */ new Map(),
    styles: /* @__PURE__ */ new Map(),
    injectedStyles: /* @__PURE__ */ new WeakMap()
  };
  if (typeof document !== "undefined") {
    registerDocument19(document);
  }
  return globalScope.__wpStyleRuntime;
}
function documentContainsStyleHash19(targetDocument, hash) {
  if (!targetDocument.head) {
    return false;
  }
  for (const style of targetDocument.head.querySelectorAll(
    `style[${STYLE_HASH_ATTRIBUTE19}]`
  )) {
    if (style.getAttribute(STYLE_HASH_ATTRIBUTE19) === hash) {
      return true;
    }
  }
  return false;
}
function injectStyle19(targetDocument, hash, css) {
  if (!targetDocument.head) {
    return;
  }
  const runtime = getRuntime19();
  let injectedStyles = runtime.injectedStyles.get(targetDocument);
  if (!injectedStyles) {
    injectedStyles = /* @__PURE__ */ new Set();
    runtime.injectedStyles.set(targetDocument, injectedStyles);
  }
  if (injectedStyles.has(hash)) {
    return;
  }
  if (documentContainsStyleHash19(targetDocument, hash)) {
    injectedStyles.add(hash);
    return;
  }
  const style = targetDocument.createElement("style");
  style.setAttribute(STYLE_HASH_ATTRIBUTE19, hash);
  style.appendChild(targetDocument.createTextNode(css));
  targetDocument.head.appendChild(style);
  injectedStyles.add(hash);
}
function registerDocument19(targetDocument) {
  const runtime = getRuntime19();
  runtime.documents.set(
    targetDocument,
    (runtime.documents.get(targetDocument) ?? 0) + 1
  );
  for (const [hash, css] of runtime.styles) {
    injectStyle19(targetDocument, hash, css);
  }
  return () => {
    const count = runtime.documents.get(targetDocument);
    if (count === void 0) {
      return;
    }
    if (count <= 1) {
      runtime.documents.delete(targetDocument);
      return;
    }
    runtime.documents.set(targetDocument, count - 1);
  };
}
function registerStyle19(hash, css) {
  const runtime = getRuntime19();
  runtime.styles.set(hash, css);
  for (const targetDocument of runtime.documents.keys()) {
    injectStyle19(targetDocument, hash, css);
  }
}
if (typeof process === "undefined" || true) {
  registerStyle19("e53c8c48f6", '@layer wp-ui{@layer utilities, components, compositions, overrides;@layer utilities{._380b81b8f79fb10f__dropdown-motion{--wp-ui-dropdown-slide-distance:4px;--wp-ui-dropdown-slide-duration:var(--wpds-motion-duration-md,200ms);--wp-ui-dropdown-slide-easing:var(--wpds-motion-easing-expressive,cubic-bezier(0.25,0,0,1));--wp-ui-dropdown-fade-duration:var(--wpds-motion-duration-sm,100ms);--wp-ui-dropdown-fade-easing:linear;@media not (prefers-reduced-motion){transition-duration:var(--wp-ui-dropdown-slide-duration),var(--wp-ui-dropdown-fade-duration);transition-property:transform,opacity;transition-timing-function:var(--wp-ui-dropdown-slide-easing),var(--wp-ui-dropdown-fade-easing);will-change:transform,opacity}opacity:1;transform:translate(0);&[data-instant]{transition:none}&[data-ending-style],&[data-starting-style]{opacity:0}&[data-side=bottom][data-ending-style],&[data-side=bottom][data-starting-style]{transform:translateY(calc(var(--wp-ui-dropdown-slide-distance)*-1))}&[data-side=top][data-ending-style],&[data-side=top][data-starting-style]{transform:translateY(var(--wp-ui-dropdown-slide-distance))}&[data-side=left][data-ending-style],&[data-side=left][data-starting-style]{transform:translateX(var(--wp-ui-dropdown-slide-distance))}&[data-side=right][data-ending-style],&[data-side=right][data-starting-style]{transform:translateX(calc(var(--wp-ui-dropdown-slide-distance)*-1))}}}}@layer wp-ui{@layer utilities, components, compositions, overrides;@layer components{._10450722b9676f78__positioner{z-index:var(--wp-ui-popover-z-index,initial)}._84e8f597bcf683b8__popup{outline:0}._972134b6cd5808d8__surface{--_wp-ui-elevation-md:0 2px 3px rgba(0,0,0,.05),0 4px 5px rgba(0,0,0,.04),0 12px 12px rgba(0,0,0,.03),0 16px 16px rgba(0,0,0,.02);background-color:var(--wpds-color-background-surface-neutral-strong,#fff);border:var(--wpds-border-width-xs,1px) solid var(--wpds-color-stroke-surface-neutral,#dbdbdb);border-radius:var(--wpds-border-radius-md,4px);box-shadow:var(--_wp-ui-elevation-md);color:var(--wpds-color-foreground-content-neutral,#1e1e1e);font-family:var(--wpds-typography-font-family-body,-apple-system,system-ui,"Segoe UI","Roboto","Oxygen-Sans","Ubuntu","Cantarell","Helvetica Neue",sans-serif);font-size:var(--wpds-typography-font-size-md,13px);line-height:var(--wpds-typography-line-height-md,24px);padding:var(--wpds-dimension-padding-lg,16px)}.e4d544aa033f05c6__backdrop~* ._972134b6cd5808d8__surface{border-color:transparent}@media (forced-colors:active){._972134b6cd5808d8__surface,.e4d544aa033f05c6__backdrop~* ._972134b6cd5808d8__surface{border-color:CanvasText}}.ca05d3eb89321fcd__arrow{display:flex;&[data-side=top]{bottom:-8px;rotate:180deg}&[data-side=bottom]{rotate:0deg;top:-8px}&[data-side=left]{inset-inline-end:-13px;rotate:90deg}&[data-side=right]{inset-inline-start:-13px;rotate:-90deg}}._12d8edd9eb946b5f__arrow-fill{fill:var(--wpds-color-background-surface-neutral-strong,#fff)}._6ddab482bd929dad__arrow-stroke{fill:var(--wpds-color-stroke-surface-neutral,#dbdbdb)}._6d7e4729cd96960e__title{--_gcd-heading-color:var(--wpds-color-foreground-content-neutral,#1e1e1e);color:var(--wpds-color-foreground-content-neutral,#1e1e1e)}.e4d544aa033f05c6__backdrop{background-color:rgba(0,0,0,.15);inset:0;opacity:1;position:fixed;z-index:var(--wp-ui-popover-z-index,initial);&[data-ending-style],&[data-starting-style]{opacity:0}@media not (prefers-reduced-motion){transition:opacity var(--wpds-motion-duration-sm,.1s) var(--wpds-motion-easing-subtle,cubic-bezier(.15,0,.15,1))}}}}');
}
var style_default18 = { "positioner": "_10450722b9676f78__positioner", "popup": "_84e8f597bcf683b8__popup _380b81b8f79fb10f__dropdown-motion", "surface": "_972134b6cd5808d8__surface", "backdrop": "e4d544aa033f05c6__backdrop", "arrow": "ca05d3eb89321fcd__arrow", "arrow-fill": "_12d8edd9eb946b5f__arrow-fill", "arrow-stroke": "_6ddab482bd929dad__arrow-stroke", "title": "_6d7e4729cd96960e__title" };
function DefaultArrowSvg(props) {
  return /* @__PURE__ */ (0, import_jsx_runtime46.jsxs)(
    "svg",
    {
      width: "20",
      height: "10",
      viewBox: "0 0 20 10",
      fill: "none",
      ...props,
      children: [
        /* @__PURE__ */ (0, import_jsx_runtime46.jsx)(
          "path",
          {
            d: "M20 10H0V8h1.465a4 4 0 0 0 2.676-1.027l5.19-4.388c.378-.341.96-.341 1.338 0l5.19 4.388A4 4 0 0 0 18.535 8H20z",
            className: style_default18["arrow-fill"]
          }
        ),
        /* @__PURE__ */ (0, import_jsx_runtime46.jsx)(
          "path",
          {
            d: "M10 3.097 4.81 7.486A5 5 0 0 1 1.465 8.77H0V8h1.465a4 4 0 0 0 2.676-1.027l5.19-4.388c.378-.341.96-.341 1.338 0l5.19 4.388A4 4 0 0 0 18.535 8H20v.77h-1.465a5 5 0 0 1-3.345-1.284z",
            className: style_default18["arrow-stroke"]
          }
        )
      ]
    }
  );
}
var Arrow = (0, import_element36.forwardRef)(function PopoverArrow3({ children, className, ...props }, ref) {
  return /* @__PURE__ */ (0, import_jsx_runtime46.jsx)(
    index_parts_exports.Arrow,
    {
      ref,
      className: clsx_default(style_default18.arrow, className),
      ...props,
      children: children ?? /* @__PURE__ */ (0, import_jsx_runtime46.jsx)(DefaultArrowSvg, {})
    }
  );
});

// packages/ui/build-module/popover/close.mjs
var import_element37 = __toESM(require_element(), 1);
var import_jsx_runtime47 = __toESM(require_jsx_runtime(), 1);
var Close = (0, import_element37.forwardRef)(
  function PopoverClose3(props, ref) {
    return /* @__PURE__ */ (0, import_jsx_runtime47.jsx)(
      index_parts_exports.Close,
      {
        ref,
        "data-wp-ui-popover-close": "",
        ...props
      }
    );
  }
);

// packages/ui/build-module/popover/description.mjs
var import_element38 = __toESM(require_element(), 1);
var import_jsx_runtime48 = __toESM(require_jsx_runtime(), 1);
var Description2 = (0, import_element38.forwardRef)(
  function PopoverDescription3({ children, ...props }, ref) {
    return /* @__PURE__ */ (0, import_jsx_runtime48.jsx)(
      Text,
      {
        ref,
        variant: "body-md",
        render: /* @__PURE__ */ (0, import_jsx_runtime48.jsx)(index_parts_exports.Description, { ...props }),
        children
      }
    );
  }
);

// packages/ui/build-module/popover/popup.mjs
var import_element41 = __toESM(require_element(), 1);
var import_compose = __toESM(require_compose(), 1);

// packages/ui/build-module/popover/context.mjs
var popoverTitleValidation = createOverlayTitleValidation("Popover");
var usePopoverValidationContext = popoverTitleValidation.useValidationContext;
var PopoverValidationProvider = popoverTitleValidation.ValidationProvider;

// packages/ui/build-module/popover/portal.mjs
var import_element39 = __toESM(require_element(), 1);
var import_jsx_runtime49 = __toESM(require_jsx_runtime(), 1);
var Portal2 = (0, import_element39.forwardRef)(
  function PopoverPortal3({ container, ...restProps }, ref) {
    return /* @__PURE__ */ (0, import_jsx_runtime49.jsx)(
      index_parts_exports.Portal,
      {
        container: container ?? getWpCompatOverlaySlot(),
        ...restProps,
        ref
      }
    );
  }
);

// packages/ui/build-module/popover/positioner.mjs
var import_element40 = __toESM(require_element(), 1);
var import_jsx_runtime50 = __toESM(require_jsx_runtime(), 1);
var STYLE_HASH_ATTRIBUTE20 = "data-wp-hash";
function getRuntime20() {
  const globalScope = globalThis;
  if (globalScope.__wpStyleRuntime) {
    return globalScope.__wpStyleRuntime;
  }
  globalScope.__wpStyleRuntime = {
    documents: /* @__PURE__ */ new Map(),
    styles: /* @__PURE__ */ new Map(),
    injectedStyles: /* @__PURE__ */ new WeakMap()
  };
  if (typeof document !== "undefined") {
    registerDocument20(document);
  }
  return globalScope.__wpStyleRuntime;
}
function documentContainsStyleHash20(targetDocument, hash) {
  if (!targetDocument.head) {
    return false;
  }
  for (const style of targetDocument.head.querySelectorAll(
    `style[${STYLE_HASH_ATTRIBUTE20}]`
  )) {
    if (style.getAttribute(STYLE_HASH_ATTRIBUTE20) === hash) {
      return true;
    }
  }
  return false;
}
function injectStyle20(targetDocument, hash, css) {
  if (!targetDocument.head) {
    return;
  }
  const runtime = getRuntime20();
  let injectedStyles = runtime.injectedStyles.get(targetDocument);
  if (!injectedStyles) {
    injectedStyles = /* @__PURE__ */ new Set();
    runtime.injectedStyles.set(targetDocument, injectedStyles);
  }
  if (injectedStyles.has(hash)) {
    return;
  }
  if (documentContainsStyleHash20(targetDocument, hash)) {
    injectedStyles.add(hash);
    return;
  }
  const style = targetDocument.createElement("style");
  style.setAttribute(STYLE_HASH_ATTRIBUTE20, hash);
  style.appendChild(targetDocument.createTextNode(css));
  targetDocument.head.appendChild(style);
  injectedStyles.add(hash);
}
function registerDocument20(targetDocument) {
  const runtime = getRuntime20();
  runtime.documents.set(
    targetDocument,
    (runtime.documents.get(targetDocument) ?? 0) + 1
  );
  for (const [hash, css] of runtime.styles) {
    injectStyle20(targetDocument, hash, css);
  }
  return () => {
    const count = runtime.documents.get(targetDocument);
    if (count === void 0) {
      return;
    }
    if (count <= 1) {
      runtime.documents.delete(targetDocument);
      return;
    }
    runtime.documents.set(targetDocument, count - 1);
  };
}
function registerStyle20(hash, css) {
  const runtime = getRuntime20();
  runtime.styles.set(hash, css);
  for (const targetDocument of runtime.documents.keys()) {
    injectStyle20(targetDocument, hash, css);
  }
}
if (typeof process === "undefined" || true) {
  registerStyle20("10f3806643", "@layer wp-ui{@layer utilities, components, compositions, overrides;@layer utilities{._336cd3e4e743482f__box-sizing{box-sizing:border-box;*,:after,:before{box-sizing:inherit}}}}");
}
var resets_default5 = { "box-sizing": "_336cd3e4e743482f__box-sizing" };
if (typeof process === "undefined" || true) {
  registerStyle20("e53c8c48f6", '@layer wp-ui{@layer utilities, components, compositions, overrides;@layer utilities{._380b81b8f79fb10f__dropdown-motion{--wp-ui-dropdown-slide-distance:4px;--wp-ui-dropdown-slide-duration:var(--wpds-motion-duration-md,200ms);--wp-ui-dropdown-slide-easing:var(--wpds-motion-easing-expressive,cubic-bezier(0.25,0,0,1));--wp-ui-dropdown-fade-duration:var(--wpds-motion-duration-sm,100ms);--wp-ui-dropdown-fade-easing:linear;@media not (prefers-reduced-motion){transition-duration:var(--wp-ui-dropdown-slide-duration),var(--wp-ui-dropdown-fade-duration);transition-property:transform,opacity;transition-timing-function:var(--wp-ui-dropdown-slide-easing),var(--wp-ui-dropdown-fade-easing);will-change:transform,opacity}opacity:1;transform:translate(0);&[data-instant]{transition:none}&[data-ending-style],&[data-starting-style]{opacity:0}&[data-side=bottom][data-ending-style],&[data-side=bottom][data-starting-style]{transform:translateY(calc(var(--wp-ui-dropdown-slide-distance)*-1))}&[data-side=top][data-ending-style],&[data-side=top][data-starting-style]{transform:translateY(var(--wp-ui-dropdown-slide-distance))}&[data-side=left][data-ending-style],&[data-side=left][data-starting-style]{transform:translateX(var(--wp-ui-dropdown-slide-distance))}&[data-side=right][data-ending-style],&[data-side=right][data-starting-style]{transform:translateX(calc(var(--wp-ui-dropdown-slide-distance)*-1))}}}}@layer wp-ui{@layer utilities, components, compositions, overrides;@layer components{._10450722b9676f78__positioner{z-index:var(--wp-ui-popover-z-index,initial)}._84e8f597bcf683b8__popup{outline:0}._972134b6cd5808d8__surface{--_wp-ui-elevation-md:0 2px 3px rgba(0,0,0,.05),0 4px 5px rgba(0,0,0,.04),0 12px 12px rgba(0,0,0,.03),0 16px 16px rgba(0,0,0,.02);background-color:var(--wpds-color-background-surface-neutral-strong,#fff);border:var(--wpds-border-width-xs,1px) solid var(--wpds-color-stroke-surface-neutral,#dbdbdb);border-radius:var(--wpds-border-radius-md,4px);box-shadow:var(--_wp-ui-elevation-md);color:var(--wpds-color-foreground-content-neutral,#1e1e1e);font-family:var(--wpds-typography-font-family-body,-apple-system,system-ui,"Segoe UI","Roboto","Oxygen-Sans","Ubuntu","Cantarell","Helvetica Neue",sans-serif);font-size:var(--wpds-typography-font-size-md,13px);line-height:var(--wpds-typography-line-height-md,24px);padding:var(--wpds-dimension-padding-lg,16px)}.e4d544aa033f05c6__backdrop~* ._972134b6cd5808d8__surface{border-color:transparent}@media (forced-colors:active){._972134b6cd5808d8__surface,.e4d544aa033f05c6__backdrop~* ._972134b6cd5808d8__surface{border-color:CanvasText}}.ca05d3eb89321fcd__arrow{display:flex;&[data-side=top]{bottom:-8px;rotate:180deg}&[data-side=bottom]{rotate:0deg;top:-8px}&[data-side=left]{inset-inline-end:-13px;rotate:90deg}&[data-side=right]{inset-inline-start:-13px;rotate:-90deg}}._12d8edd9eb946b5f__arrow-fill{fill:var(--wpds-color-background-surface-neutral-strong,#fff)}._6ddab482bd929dad__arrow-stroke{fill:var(--wpds-color-stroke-surface-neutral,#dbdbdb)}._6d7e4729cd96960e__title{--_gcd-heading-color:var(--wpds-color-foreground-content-neutral,#1e1e1e);color:var(--wpds-color-foreground-content-neutral,#1e1e1e)}.e4d544aa033f05c6__backdrop{background-color:rgba(0,0,0,.15);inset:0;opacity:1;position:fixed;z-index:var(--wp-ui-popover-z-index,initial);&[data-ending-style],&[data-starting-style]{opacity:0}@media not (prefers-reduced-motion){transition:opacity var(--wpds-motion-duration-sm,.1s) var(--wpds-motion-easing-subtle,cubic-bezier(.15,0,.15,1))}}}}');
}
var style_default19 = { "positioner": "_10450722b9676f78__positioner", "popup": "_84e8f597bcf683b8__popup _380b81b8f79fb10f__dropdown-motion", "surface": "_972134b6cd5808d8__surface", "backdrop": "e4d544aa033f05c6__backdrop", "arrow": "ca05d3eb89321fcd__arrow", "arrow-fill": "_12d8edd9eb946b5f__arrow-fill", "arrow-stroke": "_6ddab482bd929dad__arrow-stroke", "title": "_6d7e4729cd96960e__title" };
var Positioner2 = (0, import_element40.forwardRef)(
  function PopoverPositioner3({
    align = "center",
    // Matches the popup's border-radius (--wpds-border-radius-md).
    arrowPadding = 8,
    className,
    side = "bottom",
    sideOffset = 8,
    ...props
  }, ref) {
    return /* @__PURE__ */ (0, import_jsx_runtime50.jsx)(
      index_parts_exports.Positioner,
      {
        ref,
        align,
        arrowPadding,
        side,
        sideOffset,
        ...props,
        className: clsx_default(
          resets_default5["box-sizing"],
          style_default19.positioner,
          className
        )
      }
    );
  }
);

// packages/ui/build-module/popover/popup.mjs
var import_jsx_runtime51 = __toESM(require_jsx_runtime(), 1);
var STYLE_HASH_ATTRIBUTE21 = "data-wp-hash";
function getRuntime21() {
  const globalScope = globalThis;
  if (globalScope.__wpStyleRuntime) {
    return globalScope.__wpStyleRuntime;
  }
  globalScope.__wpStyleRuntime = {
    documents: /* @__PURE__ */ new Map(),
    styles: /* @__PURE__ */ new Map(),
    injectedStyles: /* @__PURE__ */ new WeakMap()
  };
  if (typeof document !== "undefined") {
    registerDocument21(document);
  }
  return globalScope.__wpStyleRuntime;
}
function documentContainsStyleHash21(targetDocument, hash) {
  if (!targetDocument.head) {
    return false;
  }
  for (const style of targetDocument.head.querySelectorAll(
    `style[${STYLE_HASH_ATTRIBUTE21}]`
  )) {
    if (style.getAttribute(STYLE_HASH_ATTRIBUTE21) === hash) {
      return true;
    }
  }
  return false;
}
function injectStyle21(targetDocument, hash, css) {
  if (!targetDocument.head) {
    return;
  }
  const runtime = getRuntime21();
  let injectedStyles = runtime.injectedStyles.get(targetDocument);
  if (!injectedStyles) {
    injectedStyles = /* @__PURE__ */ new Set();
    runtime.injectedStyles.set(targetDocument, injectedStyles);
  }
  if (injectedStyles.has(hash)) {
    return;
  }
  if (documentContainsStyleHash21(targetDocument, hash)) {
    injectedStyles.add(hash);
    return;
  }
  const style = targetDocument.createElement("style");
  style.setAttribute(STYLE_HASH_ATTRIBUTE21, hash);
  style.appendChild(targetDocument.createTextNode(css));
  targetDocument.head.appendChild(style);
  injectedStyles.add(hash);
}
function registerDocument21(targetDocument) {
  const runtime = getRuntime21();
  runtime.documents.set(
    targetDocument,
    (runtime.documents.get(targetDocument) ?? 0) + 1
  );
  for (const [hash, css] of runtime.styles) {
    injectStyle21(targetDocument, hash, css);
  }
  return () => {
    const count = runtime.documents.get(targetDocument);
    if (count === void 0) {
      return;
    }
    if (count <= 1) {
      runtime.documents.delete(targetDocument);
      return;
    }
    runtime.documents.set(targetDocument, count - 1);
  };
}
function registerStyle21(hash, css) {
  const runtime = getRuntime21();
  runtime.styles.set(hash, css);
  for (const targetDocument of runtime.documents.keys()) {
    injectStyle21(targetDocument, hash, css);
  }
}
if (typeof process === "undefined" || true) {
  registerStyle21("e53c8c48f6", '@layer wp-ui{@layer utilities, components, compositions, overrides;@layer utilities{._380b81b8f79fb10f__dropdown-motion{--wp-ui-dropdown-slide-distance:4px;--wp-ui-dropdown-slide-duration:var(--wpds-motion-duration-md,200ms);--wp-ui-dropdown-slide-easing:var(--wpds-motion-easing-expressive,cubic-bezier(0.25,0,0,1));--wp-ui-dropdown-fade-duration:var(--wpds-motion-duration-sm,100ms);--wp-ui-dropdown-fade-easing:linear;@media not (prefers-reduced-motion){transition-duration:var(--wp-ui-dropdown-slide-duration),var(--wp-ui-dropdown-fade-duration);transition-property:transform,opacity;transition-timing-function:var(--wp-ui-dropdown-slide-easing),var(--wp-ui-dropdown-fade-easing);will-change:transform,opacity}opacity:1;transform:translate(0);&[data-instant]{transition:none}&[data-ending-style],&[data-starting-style]{opacity:0}&[data-side=bottom][data-ending-style],&[data-side=bottom][data-starting-style]{transform:translateY(calc(var(--wp-ui-dropdown-slide-distance)*-1))}&[data-side=top][data-ending-style],&[data-side=top][data-starting-style]{transform:translateY(var(--wp-ui-dropdown-slide-distance))}&[data-side=left][data-ending-style],&[data-side=left][data-starting-style]{transform:translateX(var(--wp-ui-dropdown-slide-distance))}&[data-side=right][data-ending-style],&[data-side=right][data-starting-style]{transform:translateX(calc(var(--wp-ui-dropdown-slide-distance)*-1))}}}}@layer wp-ui{@layer utilities, components, compositions, overrides;@layer components{._10450722b9676f78__positioner{z-index:var(--wp-ui-popover-z-index,initial)}._84e8f597bcf683b8__popup{outline:0}._972134b6cd5808d8__surface{--_wp-ui-elevation-md:0 2px 3px rgba(0,0,0,.05),0 4px 5px rgba(0,0,0,.04),0 12px 12px rgba(0,0,0,.03),0 16px 16px rgba(0,0,0,.02);background-color:var(--wpds-color-background-surface-neutral-strong,#fff);border:var(--wpds-border-width-xs,1px) solid var(--wpds-color-stroke-surface-neutral,#dbdbdb);border-radius:var(--wpds-border-radius-md,4px);box-shadow:var(--_wp-ui-elevation-md);color:var(--wpds-color-foreground-content-neutral,#1e1e1e);font-family:var(--wpds-typography-font-family-body,-apple-system,system-ui,"Segoe UI","Roboto","Oxygen-Sans","Ubuntu","Cantarell","Helvetica Neue",sans-serif);font-size:var(--wpds-typography-font-size-md,13px);line-height:var(--wpds-typography-line-height-md,24px);padding:var(--wpds-dimension-padding-lg,16px)}.e4d544aa033f05c6__backdrop~* ._972134b6cd5808d8__surface{border-color:transparent}@media (forced-colors:active){._972134b6cd5808d8__surface,.e4d544aa033f05c6__backdrop~* ._972134b6cd5808d8__surface{border-color:CanvasText}}.ca05d3eb89321fcd__arrow{display:flex;&[data-side=top]{bottom:-8px;rotate:180deg}&[data-side=bottom]{rotate:0deg;top:-8px}&[data-side=left]{inset-inline-end:-13px;rotate:90deg}&[data-side=right]{inset-inline-start:-13px;rotate:-90deg}}._12d8edd9eb946b5f__arrow-fill{fill:var(--wpds-color-background-surface-neutral-strong,#fff)}._6ddab482bd929dad__arrow-stroke{fill:var(--wpds-color-stroke-surface-neutral,#dbdbdb)}._6d7e4729cd96960e__title{--_gcd-heading-color:var(--wpds-color-foreground-content-neutral,#1e1e1e);color:var(--wpds-color-foreground-content-neutral,#1e1e1e)}.e4d544aa033f05c6__backdrop{background-color:rgba(0,0,0,.15);inset:0;opacity:1;position:fixed;z-index:var(--wp-ui-popover-z-index,initial);&[data-ending-style],&[data-starting-style]{opacity:0}@media not (prefers-reduced-motion){transition:opacity var(--wpds-motion-duration-sm,.1s) var(--wpds-motion-easing-subtle,cubic-bezier(.15,0,.15,1))}}}}');
}
var style_default20 = { "positioner": "_10450722b9676f78__positioner", "popup": "_84e8f597bcf683b8__popup _380b81b8f79fb10f__dropdown-motion", "surface": "_972134b6cd5808d8__surface", "backdrop": "e4d544aa033f05c6__backdrop", "arrow": "ca05d3eb89321fcd__arrow", "arrow-fill": "_12d8edd9eb946b5f__arrow-fill", "arrow-stroke": "_6ddab482bd929dad__arrow-stroke", "title": "_6d7e4729cd96960e__title" };
var CLOSE_ATTR = "data-wp-ui-popover-close";
var Popup2 = (0, import_element41.forwardRef)(function PopoverPopup3({
  backdrop = false,
  children,
  className,
  portal,
  positioner,
  finalFocus,
  initialFocus,
  variant = "default",
  ...props
}, ref) {
  const { resolvedInitialFocus, popupRef } = useDeprioritizedInitialFocus({
    initialFocus,
    deprioritizedAttributes: [CLOSE_ATTR]
  });
  const mergedPopupRef = (0, import_compose.useMergeRefs)([ref, popupRef]);
  const useDefaultSurface = variant !== "unstyled";
  const validatedChildren = /* @__PURE__ */ (0, import_jsx_runtime51.jsx)(PopoverValidationProvider, { children });
  const popupChildren = useDefaultSurface ? /* @__PURE__ */ (0, import_jsx_runtime51.jsx)("div", { className: style_default20.surface, children: validatedChildren }) : validatedChildren;
  const backdropElement = backdrop ? /* @__PURE__ */ (0, import_jsx_runtime51.jsx)(index_parts_exports.Backdrop, { className: style_default20.backdrop }) : null;
  const popupContent = /* @__PURE__ */ (0, import_jsx_runtime51.jsx)(ThemeProvider, { children: /* @__PURE__ */ (0, import_jsx_runtime51.jsx)(
    index_parts_exports.Popup,
    {
      ref: mergedPopupRef,
      initialFocus: resolvedInitialFocus,
      finalFocus,
      className: clsx_default(
        useDefaultSurface && style_default20.popup,
        className
      ),
      ...props,
      children: popupChildren
    }
  ) });
  const positionedPopup = renderSlotWithChildren(
    positioner,
    /* @__PURE__ */ (0, import_jsx_runtime51.jsx)(Positioner2, {}),
    popupContent
  );
  const portalChildren = /* @__PURE__ */ (0, import_jsx_runtime51.jsxs)(import_jsx_runtime51.Fragment, { children: [
    backdropElement,
    positionedPopup
  ] });
  return renderSlotWithChildren(portal, /* @__PURE__ */ (0, import_jsx_runtime51.jsx)(Portal2, {}), portalChildren);
});

// packages/ui/build-module/popover/root.mjs
var import_jsx_runtime52 = __toESM(require_jsx_runtime(), 1);
function Root3(props) {
  return /* @__PURE__ */ (0, import_jsx_runtime52.jsx)(index_parts_exports.Root, { ...props });
}

// packages/ui/build-module/popover/title.mjs
var import_compose2 = __toESM(require_compose(), 1);
var import_element42 = __toESM(require_element(), 1);
var import_jsx_runtime53 = __toESM(require_jsx_runtime(), 1);
var STYLE_HASH_ATTRIBUTE22 = "data-wp-hash";
function getRuntime22() {
  const globalScope = globalThis;
  if (globalScope.__wpStyleRuntime) {
    return globalScope.__wpStyleRuntime;
  }
  globalScope.__wpStyleRuntime = {
    documents: /* @__PURE__ */ new Map(),
    styles: /* @__PURE__ */ new Map(),
    injectedStyles: /* @__PURE__ */ new WeakMap()
  };
  if (typeof document !== "undefined") {
    registerDocument22(document);
  }
  return globalScope.__wpStyleRuntime;
}
function documentContainsStyleHash22(targetDocument, hash) {
  if (!targetDocument.head) {
    return false;
  }
  for (const style of targetDocument.head.querySelectorAll(
    `style[${STYLE_HASH_ATTRIBUTE22}]`
  )) {
    if (style.getAttribute(STYLE_HASH_ATTRIBUTE22) === hash) {
      return true;
    }
  }
  return false;
}
function injectStyle22(targetDocument, hash, css) {
  if (!targetDocument.head) {
    return;
  }
  const runtime = getRuntime22();
  let injectedStyles = runtime.injectedStyles.get(targetDocument);
  if (!injectedStyles) {
    injectedStyles = /* @__PURE__ */ new Set();
    runtime.injectedStyles.set(targetDocument, injectedStyles);
  }
  if (injectedStyles.has(hash)) {
    return;
  }
  if (documentContainsStyleHash22(targetDocument, hash)) {
    injectedStyles.add(hash);
    return;
  }
  const style = targetDocument.createElement("style");
  style.setAttribute(STYLE_HASH_ATTRIBUTE22, hash);
  style.appendChild(targetDocument.createTextNode(css));
  targetDocument.head.appendChild(style);
  injectedStyles.add(hash);
}
function registerDocument22(targetDocument) {
  const runtime = getRuntime22();
  runtime.documents.set(
    targetDocument,
    (runtime.documents.get(targetDocument) ?? 0) + 1
  );
  for (const [hash, css] of runtime.styles) {
    injectStyle22(targetDocument, hash, css);
  }
  return () => {
    const count = runtime.documents.get(targetDocument);
    if (count === void 0) {
      return;
    }
    if (count <= 1) {
      runtime.documents.delete(targetDocument);
      return;
    }
    runtime.documents.set(targetDocument, count - 1);
  };
}
function registerStyle22(hash, css) {
  const runtime = getRuntime22();
  runtime.styles.set(hash, css);
  for (const targetDocument of runtime.documents.keys()) {
    injectStyle22(targetDocument, hash, css);
  }
}
if (typeof process === "undefined" || true) {
  registerStyle22("e53c8c48f6", '@layer wp-ui{@layer utilities, components, compositions, overrides;@layer utilities{._380b81b8f79fb10f__dropdown-motion{--wp-ui-dropdown-slide-distance:4px;--wp-ui-dropdown-slide-duration:var(--wpds-motion-duration-md,200ms);--wp-ui-dropdown-slide-easing:var(--wpds-motion-easing-expressive,cubic-bezier(0.25,0,0,1));--wp-ui-dropdown-fade-duration:var(--wpds-motion-duration-sm,100ms);--wp-ui-dropdown-fade-easing:linear;@media not (prefers-reduced-motion){transition-duration:var(--wp-ui-dropdown-slide-duration),var(--wp-ui-dropdown-fade-duration);transition-property:transform,opacity;transition-timing-function:var(--wp-ui-dropdown-slide-easing),var(--wp-ui-dropdown-fade-easing);will-change:transform,opacity}opacity:1;transform:translate(0);&[data-instant]{transition:none}&[data-ending-style],&[data-starting-style]{opacity:0}&[data-side=bottom][data-ending-style],&[data-side=bottom][data-starting-style]{transform:translateY(calc(var(--wp-ui-dropdown-slide-distance)*-1))}&[data-side=top][data-ending-style],&[data-side=top][data-starting-style]{transform:translateY(var(--wp-ui-dropdown-slide-distance))}&[data-side=left][data-ending-style],&[data-side=left][data-starting-style]{transform:translateX(var(--wp-ui-dropdown-slide-distance))}&[data-side=right][data-ending-style],&[data-side=right][data-starting-style]{transform:translateX(calc(var(--wp-ui-dropdown-slide-distance)*-1))}}}}@layer wp-ui{@layer utilities, components, compositions, overrides;@layer components{._10450722b9676f78__positioner{z-index:var(--wp-ui-popover-z-index,initial)}._84e8f597bcf683b8__popup{outline:0}._972134b6cd5808d8__surface{--_wp-ui-elevation-md:0 2px 3px rgba(0,0,0,.05),0 4px 5px rgba(0,0,0,.04),0 12px 12px rgba(0,0,0,.03),0 16px 16px rgba(0,0,0,.02);background-color:var(--wpds-color-background-surface-neutral-strong,#fff);border:var(--wpds-border-width-xs,1px) solid var(--wpds-color-stroke-surface-neutral,#dbdbdb);border-radius:var(--wpds-border-radius-md,4px);box-shadow:var(--_wp-ui-elevation-md);color:var(--wpds-color-foreground-content-neutral,#1e1e1e);font-family:var(--wpds-typography-font-family-body,-apple-system,system-ui,"Segoe UI","Roboto","Oxygen-Sans","Ubuntu","Cantarell","Helvetica Neue",sans-serif);font-size:var(--wpds-typography-font-size-md,13px);line-height:var(--wpds-typography-line-height-md,24px);padding:var(--wpds-dimension-padding-lg,16px)}.e4d544aa033f05c6__backdrop~* ._972134b6cd5808d8__surface{border-color:transparent}@media (forced-colors:active){._972134b6cd5808d8__surface,.e4d544aa033f05c6__backdrop~* ._972134b6cd5808d8__surface{border-color:CanvasText}}.ca05d3eb89321fcd__arrow{display:flex;&[data-side=top]{bottom:-8px;rotate:180deg}&[data-side=bottom]{rotate:0deg;top:-8px}&[data-side=left]{inset-inline-end:-13px;rotate:90deg}&[data-side=right]{inset-inline-start:-13px;rotate:-90deg}}._12d8edd9eb946b5f__arrow-fill{fill:var(--wpds-color-background-surface-neutral-strong,#fff)}._6ddab482bd929dad__arrow-stroke{fill:var(--wpds-color-stroke-surface-neutral,#dbdbdb)}._6d7e4729cd96960e__title{--_gcd-heading-color:var(--wpds-color-foreground-content-neutral,#1e1e1e);color:var(--wpds-color-foreground-content-neutral,#1e1e1e)}.e4d544aa033f05c6__backdrop{background-color:rgba(0,0,0,.15);inset:0;opacity:1;position:fixed;z-index:var(--wp-ui-popover-z-index,initial);&[data-ending-style],&[data-starting-style]{opacity:0}@media not (prefers-reduced-motion){transition:opacity var(--wpds-motion-duration-sm,.1s) var(--wpds-motion-easing-subtle,cubic-bezier(.15,0,.15,1))}}}}');
}
var style_default21 = { "positioner": "_10450722b9676f78__positioner", "popup": "_84e8f597bcf683b8__popup _380b81b8f79fb10f__dropdown-motion", "surface": "_972134b6cd5808d8__surface", "backdrop": "e4d544aa033f05c6__backdrop", "arrow": "ca05d3eb89321fcd__arrow", "arrow-fill": "_12d8edd9eb946b5f__arrow-fill", "arrow-stroke": "_6ddab482bd929dad__arrow-stroke", "title": "_6d7e4729cd96960e__title" };
var Title2 = (0, import_element42.forwardRef)(
  function PopoverTitle3({ children, ...props }, forwardedRef) {
    const validationContext = usePopoverValidationContext();
    const internalRef = (0, import_element42.useRef)(null);
    const mergedRef = (0, import_compose2.useMergeRefs)([internalRef, forwardedRef]);
    (0, import_element42.useEffect)(() => {
      if (validationContext) {
        return validationContext.registerTitle(internalRef.current);
      }
      return void 0;
    }, [validationContext]);
    return /* @__PURE__ */ (0, import_jsx_runtime53.jsx)(
      Text,
      {
        ref: mergedRef,
        variant: "heading-xl",
        render: /* @__PURE__ */ (0, import_jsx_runtime53.jsx)(index_parts_exports.Title, { ...props }),
        className: style_default21.title,
        children
      }
    );
  }
);

// packages/ui/build-module/popover/trigger.mjs
var import_element43 = __toESM(require_element(), 1);
var import_jsx_runtime54 = __toESM(require_jsx_runtime(), 1);
var Trigger2 = (0, import_element43.forwardRef)(
  function PopoverTrigger3(props, ref) {
    return /* @__PURE__ */ (0, import_jsx_runtime54.jsx)(index_parts_exports.Trigger, { ref, ...props });
  }
);

// packages/admin-ui/build-module/breadcrumbs/index.mjs
var import_jsx_runtime55 = __toESM(require_jsx_runtime(), 1);
var STYLE_HASH_ATTRIBUTE23 = "data-wp-hash";
function getRuntime23() {
  const globalScope = globalThis;
  if (globalScope.__wpStyleRuntime) {
    return globalScope.__wpStyleRuntime;
  }
  globalScope.__wpStyleRuntime = {
    documents: /* @__PURE__ */ new Map(),
    styles: /* @__PURE__ */ new Map(),
    injectedStyles: /* @__PURE__ */ new WeakMap()
  };
  if (typeof document !== "undefined") {
    registerDocument23(document);
  }
  return globalScope.__wpStyleRuntime;
}
function documentContainsStyleHash23(targetDocument, hash) {
  if (!targetDocument.head) {
    return false;
  }
  for (const style of targetDocument.head.querySelectorAll(
    `style[${STYLE_HASH_ATTRIBUTE23}]`
  )) {
    if (style.getAttribute(STYLE_HASH_ATTRIBUTE23) === hash) {
      return true;
    }
  }
  return false;
}
function injectStyle23(targetDocument, hash, css) {
  if (!targetDocument.head) {
    return;
  }
  const runtime = getRuntime23();
  let injectedStyles = runtime.injectedStyles.get(targetDocument);
  if (!injectedStyles) {
    injectedStyles = /* @__PURE__ */ new Set();
    runtime.injectedStyles.set(targetDocument, injectedStyles);
  }
  if (injectedStyles.has(hash)) {
    return;
  }
  if (documentContainsStyleHash23(targetDocument, hash)) {
    injectedStyles.add(hash);
    return;
  }
  const style = targetDocument.createElement("style");
  style.setAttribute(STYLE_HASH_ATTRIBUTE23, hash);
  style.appendChild(targetDocument.createTextNode(css));
  targetDocument.head.appendChild(style);
  injectedStyles.add(hash);
}
function registerDocument23(targetDocument) {
  const runtime = getRuntime23();
  runtime.documents.set(
    targetDocument,
    (runtime.documents.get(targetDocument) ?? 0) + 1
  );
  for (const [hash, css] of runtime.styles) {
    injectStyle23(targetDocument, hash, css);
  }
  return () => {
    const count = runtime.documents.get(targetDocument);
    if (count === void 0) {
      return;
    }
    if (count <= 1) {
      runtime.documents.delete(targetDocument);
      return;
    }
    runtime.documents.set(targetDocument, count - 1);
  };
}
function registerStyle23(hash, css) {
  const runtime = getRuntime23();
  runtime.styles.set(hash, css);
  for (const targetDocument of runtime.documents.keys()) {
    injectStyle23(targetDocument, hash, css);
  }
}
if (typeof process === "undefined" || true) {
  registerStyle23("846edc217c", "._5f4053eba32ce092__list{list-style:none;margin:0;padding:0}._5f4053eba32ce092__list>li{flex-shrink:0}._5f4053eba32ce092__list>li:last-child{flex-shrink:1;min-width:0}.d1978551971a3360__current{overflow:hidden;text-overflow:ellipsis;white-space:nowrap}._6d9152063d443376__separator{color:var(--wpds-color-stroke-surface-neutral,#dbdbdb);margin:0 var(--wpds-dimension-gap-sm,8px);user-select:none}");
}
var style_default22 = { "list": "_5f4053eba32ce092__list", "current": "d1978551971a3360__current", "separator": "_6d9152063d443376__separator" };
var Breadcrumbs = ({ items }) => {
  if (!items.length) {
    return null;
  }
  const precedingItems = items.slice(0, -1);
  const lastItem = items[items.length - 1];
  if (true) {
    const invalidItem = precedingItems.find((item) => !item.to);
    if (invalidItem) {
      throw new Error(
        `Breadcrumbs: item "${invalidItem.label}" is missing a \`to\` prop. All items except the last one must have a \`to\` prop.`
      );
    }
  }
  return /* @__PURE__ */ (0, import_jsx_runtime55.jsx)("nav", { "aria-label": (0, import_i18n4.__)("Breadcrumbs"), children: /* @__PURE__ */ (0, import_jsx_runtime55.jsxs)(
    Stack,
    {
      render: /* @__PURE__ */ (0, import_jsx_runtime55.jsx)("ul", {}),
      direction: "row",
      align: "center",
      className: style_default22.list,
      children: [
        precedingItems.map((item, index2) => /* @__PURE__ */ (0, import_jsx_runtime55.jsxs)("li", { children: [
          /* @__PURE__ */ (0, import_jsx_runtime55.jsx)(
            Text,
            {
              variant: "body-lg",
              render: /* @__PURE__ */ (0, import_jsx_runtime55.jsx)(
                Link,
                {
                  tone: "neutral",
                  render: /* @__PURE__ */ (0, import_jsx_runtime55.jsx)(RouterLink, { to: item.to })
                }
              ),
              children: item.label
            }
          ),
          /* @__PURE__ */ (0, import_jsx_runtime55.jsx)(
            Text,
            {
              variant: "body-lg",
              "aria-hidden": "true",
              className: style_default22.separator,
              children: "/"
            }
          )
        ] }, index2)),
        /* @__PURE__ */ (0, import_jsx_runtime55.jsx)("li", { children: lastItem.to ? /* @__PURE__ */ (0, import_jsx_runtime55.jsx)(
          Text,
          {
            variant: "body-lg",
            render: /* @__PURE__ */ (0, import_jsx_runtime55.jsx)(
              Link,
              {
                tone: "neutral",
                render: /* @__PURE__ */ (0, import_jsx_runtime55.jsx)(RouterLink, { to: lastItem.to })
              }
            ),
            children: lastItem.label
          }
        ) : /* @__PURE__ */ (0, import_jsx_runtime55.jsx)(
          Text,
          {
            variant: "heading-lg",
            render: /* @__PURE__ */ (0, import_jsx_runtime55.jsx)("h1", {}),
            className: style_default22.current,
            children: lastItem.label
          }
        ) })
      ]
    }
  ) });
};
var breadcrumbs_default = Breadcrumbs;

// packages/admin-ui/build-module/navigable-region/index.mjs
var import_element44 = __toESM(require_element(), 1);
var import_jsx_runtime56 = __toESM(require_jsx_runtime(), 1);
var NavigableRegion = (0, import_element44.forwardRef)(
  ({ children, className, ariaLabel, as: Tag = "div", ...props }, ref) => {
    return /* @__PURE__ */ (0, import_jsx_runtime56.jsx)(
      Tag,
      {
        ref,
        className: clsx_default("admin-ui-navigable-region", className),
        "aria-label": ariaLabel,
        role: "region",
        tabIndex: "-1",
        ...props,
        children
      }
    );
  }
);
NavigableRegion.displayName = "NavigableRegion";
var navigable_region_default = NavigableRegion;

// packages/admin-ui/build-module/page/sidebar-toggle-slot.mjs
var import_components = __toESM(require_components(), 1);
var { Fill: SidebarToggleFill, Slot: SidebarToggleSlot } = (0, import_components.createSlotFill)("SidebarToggle");

// packages/admin-ui/build-module/page/header.mjs
var import_jsx_runtime57 = __toESM(require_jsx_runtime(), 1);
var STYLE_HASH_ATTRIBUTE24 = "data-wp-hash";
function getRuntime24() {
  const globalScope = globalThis;
  if (globalScope.__wpStyleRuntime) {
    return globalScope.__wpStyleRuntime;
  }
  globalScope.__wpStyleRuntime = {
    documents: /* @__PURE__ */ new Map(),
    styles: /* @__PURE__ */ new Map(),
    injectedStyles: /* @__PURE__ */ new WeakMap()
  };
  if (typeof document !== "undefined") {
    registerDocument24(document);
  }
  return globalScope.__wpStyleRuntime;
}
function documentContainsStyleHash24(targetDocument, hash) {
  if (!targetDocument.head) {
    return false;
  }
  for (const style of targetDocument.head.querySelectorAll(
    `style[${STYLE_HASH_ATTRIBUTE24}]`
  )) {
    if (style.getAttribute(STYLE_HASH_ATTRIBUTE24) === hash) {
      return true;
    }
  }
  return false;
}
function injectStyle24(targetDocument, hash, css) {
  if (!targetDocument.head) {
    return;
  }
  const runtime = getRuntime24();
  let injectedStyles = runtime.injectedStyles.get(targetDocument);
  if (!injectedStyles) {
    injectedStyles = /* @__PURE__ */ new Set();
    runtime.injectedStyles.set(targetDocument, injectedStyles);
  }
  if (injectedStyles.has(hash)) {
    return;
  }
  if (documentContainsStyleHash24(targetDocument, hash)) {
    injectedStyles.add(hash);
    return;
  }
  const style = targetDocument.createElement("style");
  style.setAttribute(STYLE_HASH_ATTRIBUTE24, hash);
  style.appendChild(targetDocument.createTextNode(css));
  targetDocument.head.appendChild(style);
  injectedStyles.add(hash);
}
function registerDocument24(targetDocument) {
  const runtime = getRuntime24();
  runtime.documents.set(
    targetDocument,
    (runtime.documents.get(targetDocument) ?? 0) + 1
  );
  for (const [hash, css] of runtime.styles) {
    injectStyle24(targetDocument, hash, css);
  }
  return () => {
    const count = runtime.documents.get(targetDocument);
    if (count === void 0) {
      return;
    }
    if (count <= 1) {
      runtime.documents.delete(targetDocument);
      return;
    }
    runtime.documents.set(targetDocument, count - 1);
  };
}
function registerStyle24(hash, css) {
  const runtime = getRuntime24();
  runtime.styles.set(hash, css);
  for (const targetDocument of runtime.documents.keys()) {
    injectStyle24(targetDocument, hash, css);
  }
}
if (typeof process === "undefined" || true) {
  registerStyle24("ddd9aab364", "._956b6df0898efed0__page{text-wrap:pretty;background-color:var(--wpds-color-background-surface-neutral,#fcfcfc);color:var(--wpds-color-foreground-content-neutral,#1e1e1e);display:flex;flex-flow:column;height:100%;position:relative;z-index:1}._0625b55e82a0d93d__header{background:var(--wpds-color-background-surface-neutral-strong,#fff);border-block-end:var(--wpds-border-width-xs,1px) solid var(--wpds-color-stroke-surface-neutral-weak,#f0f0f0);inset-block-start:0;padding:var(--wpds-dimension-padding-lg,16px) var(--wpds-dimension-padding-2xl,24px);position:sticky;z-index:1}.a43c44d5ae28b2e8__header-content{min-height:var(--wpds-dimension-size-md,32px)}.b7cb5b9daf3a3b25__header-actions{flex-shrink:0}._8113be94e7caf73c__header-title{overflow:hidden;text-overflow:ellipsis;white-space:nowrap}._9a776c7f70996f61__header-visual{display:grid;flex-shrink:0;grid-template-columns:1fr;grid-template-rows:1fr;height:var(--wpds-dimension-size-sm,24px);width:var(--wpds-dimension-size-sm,24px);>*{grid-column:1/-1;grid-row:1/-1;max-height:100%;max-width:100%}}.d5e0920cd15d35bc__sidebar-toggle-slot:empty{display:none}._60fea2f6bf5319cd__header-subtitle{color:var(--wpds-color-foreground-content-neutral-weak,#707070);padding-block-end:var(--wpds-dimension-padding-xs,4px)}.be5e57d029ec4036__content{display:flex;flex-direction:column;flex-grow:1;overflow:auto;&._128806d0b26e3a50__has-padding{padding:var(--wpds-dimension-padding-lg,16px) var(--wpds-dimension-padding-2xl,24px)}}");
}
var style_default23 = { "page": "_956b6df0898efed0__page", "header": "_0625b55e82a0d93d__header", "header-content": "a43c44d5ae28b2e8__header-content", "header-actions": "b7cb5b9daf3a3b25__header-actions", "header-title": "_8113be94e7caf73c__header-title", "header-visual": "_9a776c7f70996f61__header-visual", "sidebar-toggle-slot": "d5e0920cd15d35bc__sidebar-toggle-slot", "header-subtitle": "_60fea2f6bf5319cd__header-subtitle", "content": "be5e57d029ec4036__content", "has-padding": "_128806d0b26e3a50__has-padding" };
function Header({
  headingLevel = 1,
  breadcrumbs,
  badges,
  visual,
  title,
  subTitle,
  actions,
  showSidebarToggle = true
}) {
  const HeadingTag = `h${headingLevel}`;
  return /* @__PURE__ */ (0, import_jsx_runtime57.jsxs)(Stack, { direction: "column", className: style_default23.header, children: [
    /* @__PURE__ */ (0, import_jsx_runtime57.jsxs)(
      Stack,
      {
        className: style_default23["header-content"],
        direction: "row",
        gap: "sm",
        justify: "space-between",
        children: [
          /* @__PURE__ */ (0, import_jsx_runtime57.jsxs)(Stack, { direction: "row", gap: "sm", align: "center", justify: "start", children: [
            showSidebarToggle && /* @__PURE__ */ (0, import_jsx_runtime57.jsx)(
              SidebarToggleSlot,
              {
                bubblesVirtually: true,
                className: style_default23["sidebar-toggle-slot"]
              }
            ),
            visual && /* @__PURE__ */ (0, import_jsx_runtime57.jsx)(
              "div",
              {
                className: style_default23["header-visual"],
                "aria-hidden": "true",
                children: visual
              }
            ),
            title && /* @__PURE__ */ (0, import_jsx_runtime57.jsx)(
              Text,
              {
                className: style_default23["header-title"],
                render: /* @__PURE__ */ (0, import_jsx_runtime57.jsx)(HeadingTag, {}),
                variant: "heading-lg",
                children: title
              }
            ),
            breadcrumbs,
            badges
          ] }),
          actions && /* @__PURE__ */ (0, import_jsx_runtime57.jsx)(
            Stack,
            {
              align: "center",
              className: style_default23["header-actions"],
              direction: "row",
              gap: "sm",
              children: actions
            }
          )
        ]
      }
    ),
    subTitle && /* @__PURE__ */ (0, import_jsx_runtime57.jsx)(
      Text,
      {
        render: /* @__PURE__ */ (0, import_jsx_runtime57.jsx)("p", {}),
        variant: "body-md",
        className: style_default23["header-subtitle"],
        children: subTitle
      }
    )
  ] });
}

// packages/admin-ui/build-module/page/index.mjs
var import_jsx_runtime58 = __toESM(require_jsx_runtime(), 1);
var STYLE_HASH_ATTRIBUTE25 = "data-wp-hash";
function getRuntime25() {
  const globalScope = globalThis;
  if (globalScope.__wpStyleRuntime) {
    return globalScope.__wpStyleRuntime;
  }
  globalScope.__wpStyleRuntime = {
    documents: /* @__PURE__ */ new Map(),
    styles: /* @__PURE__ */ new Map(),
    injectedStyles: /* @__PURE__ */ new WeakMap()
  };
  if (typeof document !== "undefined") {
    registerDocument25(document);
  }
  return globalScope.__wpStyleRuntime;
}
function documentContainsStyleHash25(targetDocument, hash) {
  if (!targetDocument.head) {
    return false;
  }
  for (const style of targetDocument.head.querySelectorAll(
    `style[${STYLE_HASH_ATTRIBUTE25}]`
  )) {
    if (style.getAttribute(STYLE_HASH_ATTRIBUTE25) === hash) {
      return true;
    }
  }
  return false;
}
function injectStyle25(targetDocument, hash, css) {
  if (!targetDocument.head) {
    return;
  }
  const runtime = getRuntime25();
  let injectedStyles = runtime.injectedStyles.get(targetDocument);
  if (!injectedStyles) {
    injectedStyles = /* @__PURE__ */ new Set();
    runtime.injectedStyles.set(targetDocument, injectedStyles);
  }
  if (injectedStyles.has(hash)) {
    return;
  }
  if (documentContainsStyleHash25(targetDocument, hash)) {
    injectedStyles.add(hash);
    return;
  }
  const style = targetDocument.createElement("style");
  style.setAttribute(STYLE_HASH_ATTRIBUTE25, hash);
  style.appendChild(targetDocument.createTextNode(css));
  targetDocument.head.appendChild(style);
  injectedStyles.add(hash);
}
function registerDocument25(targetDocument) {
  const runtime = getRuntime25();
  runtime.documents.set(
    targetDocument,
    (runtime.documents.get(targetDocument) ?? 0) + 1
  );
  for (const [hash, css] of runtime.styles) {
    injectStyle25(targetDocument, hash, css);
  }
  return () => {
    const count = runtime.documents.get(targetDocument);
    if (count === void 0) {
      return;
    }
    if (count <= 1) {
      runtime.documents.delete(targetDocument);
      return;
    }
    runtime.documents.set(targetDocument, count - 1);
  };
}
function registerStyle25(hash, css) {
  const runtime = getRuntime25();
  runtime.styles.set(hash, css);
  for (const targetDocument of runtime.documents.keys()) {
    injectStyle25(targetDocument, hash, css);
  }
}
if (typeof process === "undefined" || true) {
  registerStyle25("ddd9aab364", "._956b6df0898efed0__page{text-wrap:pretty;background-color:var(--wpds-color-background-surface-neutral,#fcfcfc);color:var(--wpds-color-foreground-content-neutral,#1e1e1e);display:flex;flex-flow:column;height:100%;position:relative;z-index:1}._0625b55e82a0d93d__header{background:var(--wpds-color-background-surface-neutral-strong,#fff);border-block-end:var(--wpds-border-width-xs,1px) solid var(--wpds-color-stroke-surface-neutral-weak,#f0f0f0);inset-block-start:0;padding:var(--wpds-dimension-padding-lg,16px) var(--wpds-dimension-padding-2xl,24px);position:sticky;z-index:1}.a43c44d5ae28b2e8__header-content{min-height:var(--wpds-dimension-size-md,32px)}.b7cb5b9daf3a3b25__header-actions{flex-shrink:0}._8113be94e7caf73c__header-title{overflow:hidden;text-overflow:ellipsis;white-space:nowrap}._9a776c7f70996f61__header-visual{display:grid;flex-shrink:0;grid-template-columns:1fr;grid-template-rows:1fr;height:var(--wpds-dimension-size-sm,24px);width:var(--wpds-dimension-size-sm,24px);>*{grid-column:1/-1;grid-row:1/-1;max-height:100%;max-width:100%}}.d5e0920cd15d35bc__sidebar-toggle-slot:empty{display:none}._60fea2f6bf5319cd__header-subtitle{color:var(--wpds-color-foreground-content-neutral-weak,#707070);padding-block-end:var(--wpds-dimension-padding-xs,4px)}.be5e57d029ec4036__content{display:flex;flex-direction:column;flex-grow:1;overflow:auto;&._128806d0b26e3a50__has-padding{padding:var(--wpds-dimension-padding-lg,16px) var(--wpds-dimension-padding-2xl,24px)}}");
}
var style_default24 = { "page": "_956b6df0898efed0__page", "header": "_0625b55e82a0d93d__header", "header-content": "a43c44d5ae28b2e8__header-content", "header-actions": "b7cb5b9daf3a3b25__header-actions", "header-title": "_8113be94e7caf73c__header-title", "header-visual": "_9a776c7f70996f61__header-visual", "sidebar-toggle-slot": "d5e0920cd15d35bc__sidebar-toggle-slot", "header-subtitle": "_60fea2f6bf5319cd__header-subtitle", "content": "be5e57d029ec4036__content", "has-padding": "_128806d0b26e3a50__has-padding" };
function Page({
  headingLevel,
  breadcrumbs,
  badges,
  visual,
  title,
  subTitle,
  children,
  className,
  actions,
  ariaLabel,
  hasPadding = false,
  showSidebarToggle = true
}) {
  const classes = clsx_default(style_default24.page, className);
  const effectiveAriaLabel = ariaLabel ?? (typeof title === "string" ? title : "");
  return /* @__PURE__ */ (0, import_jsx_runtime58.jsxs)(navigable_region_default, { className: classes, ariaLabel: effectiveAriaLabel, children: [
    (title || breadcrumbs || badges || actions || visual) && /* @__PURE__ */ (0, import_jsx_runtime58.jsx)(
      Header,
      {
        headingLevel,
        breadcrumbs,
        badges,
        visual,
        title,
        subTitle,
        actions,
        showSidebarToggle
      }
    ),
    hasPadding ? /* @__PURE__ */ (0, import_jsx_runtime58.jsx)(
      "div",
      {
        className: clsx_default(
          style_default24.content,
          style_default24["has-padding"]
        ),
        children
      }
    ) : children
  ] });
}
Page.SidebarToggleFill = SidebarToggleFill;
var page_default = Page;

// packages/content-types/build-module/components/layout/index.mjs
var import_components2 = __toESM(require_components(), 1);
var import_i18n5 = __toESM(require_i18n(), 1);
import { useNavigate } from "@wordpress/route";

// packages/content-types/build-module/lock-unlock.mjs
var import_private_apis2 = __toESM(require_private_apis(), 1);
var { lock: lock2, unlock: unlock2 } = (0, import_private_apis2.__dangerousOptInToUnstableAPIsOnlyForCoreModules)(
  "I acknowledge private features are not for use in themes or plugins and doing so will break in the next version of Retraceur.",
  "@wordpress/content-types"
);

// packages/content-types/build-module/components/layout/index.mjs
var import_jsx_runtime59 = __toESM(require_jsx_runtime(), 1);
var { Tabs } = unlock2(import_components2.privateApis);
function Layout({ activeTab, children }) {
  const navigate = useNavigate();
  return /* @__PURE__ */ (0, import_jsx_runtime59.jsxs)(
    page_default,
    {
      ariaLabel: (0, import_i18n5.__)("Content Types"),
      className: "content-types-page",
      children: [
        /* @__PURE__ */ (0, import_jsx_runtime59.jsx)(
          Tabs,
          {
            selectedTabId: activeTab,
            onSelect: (tabId) => navigate({ to: `/${tabId}` }),
            children: /* @__PURE__ */ (0, import_jsx_runtime59.jsx)("div", { className: "content-types-tabs-wrapper", children: /* @__PURE__ */ (0, import_jsx_runtime59.jsxs)(Tabs.TabList, { children: [
              /* @__PURE__ */ (0, import_jsx_runtime59.jsx)(Tabs.Tab, { tabId: "post-types", children: (0, import_i18n5.__)("Post Types") }),
              /* @__PURE__ */ (0, import_jsx_runtime59.jsx)(Tabs.Tab, { tabId: "taxonomies", children: (0, import_i18n5.__)("Taxonomies") })
            ] }) })
          }
        ),
        children
      ]
    }
  );
}

// packages/content-types/build-module/post-types/list.mjs
var import_components8 = __toESM(require_components(), 1);
var import_dataviews3 = __toESM(require_dataviews(), 1);
var import_core_data9 = __toESM(require_core_data(), 1);
var import_element53 = __toESM(require_element(), 1);
var import_i18n19 = __toESM(require_i18n(), 1);
import { useNavigate as useNavigate3, useSearch } from "@wordpress/route";

// node_modules/dequal/dist/index.mjs
var has = Object.prototype.hasOwnProperty;
function find(iter, tar, key) {
  for (key of iter.keys()) {
    if (dequal(key, tar)) return key;
  }
}
function dequal(foo, bar) {
  var ctor, len, tmp;
  if (foo === bar) return true;
  if (foo && bar && (ctor = foo.constructor) === bar.constructor) {
    if (ctor === Date) return foo.getTime() === bar.getTime();
    if (ctor === RegExp) return foo.toString() === bar.toString();
    if (ctor === Array) {
      if ((len = foo.length) === bar.length) {
        while (len-- && dequal(foo[len], bar[len])) ;
      }
      return len === -1;
    }
    if (ctor === Set) {
      if (foo.size !== bar.size) {
        return false;
      }
      for (len of foo) {
        tmp = len;
        if (tmp && typeof tmp === "object") {
          tmp = find(bar, tmp);
          if (!tmp) return false;
        }
        if (!bar.has(tmp)) return false;
      }
      return true;
    }
    if (ctor === Map) {
      if (foo.size !== bar.size) {
        return false;
      }
      for (len of foo) {
        tmp = len[0];
        if (tmp && typeof tmp === "object") {
          tmp = find(bar, tmp);
          if (!tmp) return false;
        }
        if (!dequal(len[1], bar.get(tmp))) {
          return false;
        }
      }
      return true;
    }
    if (ctor === ArrayBuffer) {
      foo = new Uint8Array(foo);
      bar = new Uint8Array(bar);
    } else if (ctor === DataView) {
      if ((len = foo.byteLength) === bar.byteLength) {
        while (len-- && foo.getInt8(len) === bar.getInt8(len)) ;
      }
      return len === -1;
    }
    if (ArrayBuffer.isView(foo)) {
      if ((len = foo.byteLength) === bar.byteLength) {
        while (len-- && foo[len] === bar[len]) ;
      }
      return len === -1;
    }
    if (!ctor || typeof foo === "object") {
      len = 0;
      for (ctor in foo) {
        if (has.call(foo, ctor) && ++len && !has.call(bar, ctor)) return false;
        if (!(ctor in bar) || !dequal(foo[ctor], bar[ctor])) return false;
      }
      return Object.keys(bar).length === len;
    }
  }
  return foo !== foo && bar !== bar;
}

// packages/views/build-module/use-view.mjs
var import_element45 = __toESM(require_element(), 1);
var import_data = __toESM(require_data(), 1);
var import_preferences = __toESM(require_preferences(), 1);

// packages/views/build-module/preference-keys.mjs
function generatePreferenceKey(kind, name, slug) {
  return `dataviews-${kind}-${name}-${slug}`;
}

// packages/views/build-module/resolve-view.mjs
var QUERY_PARAMS = ["page", "search"];
function isPlainObject(value) {
  return typeof value === "object" && value !== null && !Array.isArray(value);
}
function withoutQueryParams(layer) {
  const result = isPlainObject(layer) ? { ...layer } : {};
  for (const key of QUERY_PARAMS) {
    delete result[key];
  }
  return result;
}
function mergeLayer(lower, upper) {
  const result = { ...lower };
  for (const key of Object.keys(upper)) {
    const value = upper[key];
    const current = result[key];
    result[key] = isPlainObject(current) && isPlainObject(value) ? mergeLayer(current, value) : value;
  }
  return result;
}
function diffLayer(value, base, persisted = {}) {
  const result = {};
  for (const key of Object.keys(value)) {
    const next = value[key];
    const current = base[key];
    const prev = persisted[key];
    if (next === void 0) {
      continue;
    }
    if (isPlainObject(next) && isPlainObject(current)) {
      const nested = diffLayer(
        next,
        current,
        isPlainObject(prev) ? prev : {}
      );
      if (Object.keys(nested).length > 0) {
        result[key] = nested;
      }
    } else if (!dequal(next, current)) {
      result[key] = next;
    } else if (prev !== void 0 && dequal(next, prev)) {
      result[key] = prev;
    }
  }
  return result;
}
function getLockedFilters(overrides) {
  return (overrides?.filters ?? []).filter((filter) => filter.isLocked);
}
function applyLockedFilters(view, overrides) {
  const locked = getLockedFilters(overrides);
  if (locked.length === 0) {
    return view;
  }
  const rest = (view.filters ?? []).filter(
    (filter) => !locked.some((f) => f.field === filter.field)
  );
  return { ...view, filters: [...locked, ...rest] };
}
function resolveBaseView(layers, effectiveType) {
  const { defaultView, defaultLayouts: defaultLayouts3, activeViewOverrides } = layers;
  const layoutDefaults = defaultLayouts3?.[effectiveType];
  return applyLockedFilters(
    [layoutDefaults, activeViewOverrides].reduce(
      (lower, upper) => mergeLayer(lower, withoutQueryParams(upper)),
      withoutQueryParams(defaultView)
    ),
    activeViewOverrides
  );
}
function resolveView(args) {
  const { defaultView, activeViewOverrides, persistedView, page, search } = args;
  const effectiveType = persistedView?.type ?? activeViewOverrides?.type ?? defaultView?.type;
  const baseView = resolveBaseView(args, effectiveType);
  const view = {
    ...applyLockedFilters(
      mergeLayer(baseView, withoutQueryParams(persistedView)),
      activeViewOverrides
    ),
    page: Number(page ?? 1),
    search: search ?? ""
  };
  return view;
}
function getUserModifications(newView, layers) {
  const { activeViewOverrides, persistedView } = layers;
  const baseView = resolveBaseView(layers, newView.type);
  const modifications = diffLayer(
    withoutQueryParams(newView),
    withoutQueryParams(baseView),
    withoutQueryParams(persistedView)
  );
  const locked = getLockedFilters(activeViewOverrides);
  if (locked.length > 0 && Array.isArray(modifications.filters)) {
    modifications.filters = modifications.filters.filter(
      (filter) => !locked.some((f) => f.field === filter.field)
    );
  }
  return Object.keys(modifications).length > 0 ? modifications : void 0;
}

// packages/views/build-module/use-view.mjs
function useView(config) {
  const {
    kind,
    name,
    slug,
    defaultView,
    defaultLayouts: defaultLayouts3,
    activeViewOverrides,
    queryParams,
    onChangeQueryParams
  } = config;
  const preferenceKey = generatePreferenceKey(kind, name, slug);
  const persistedView = (0, import_data.useSelect)(
    (select2) => {
      return select2(import_preferences.store).get(
        "core/views",
        preferenceKey
      );
    },
    [preferenceKey]
  );
  const { set: set3 } = (0, import_data.useDispatch)(import_preferences.store);
  const page = Number(queryParams?.page ?? 1);
  const search = queryParams?.search ?? "";
  const view = (0, import_element45.useMemo)(
    () => resolveView({
      defaultView,
      defaultLayouts: defaultLayouts3,
      activeViewOverrides,
      persistedView,
      page,
      search
    }),
    [
      defaultView,
      defaultLayouts3,
      activeViewOverrides,
      persistedView,
      page,
      search
    ]
  );
  const isModified = !!persistedView && Object.keys(persistedView).length > 0;
  const updateView = (0, import_element45.useCallback)(
    (newView) => {
      const newQueryParams = {
        page: Number(newView?.page ?? 1),
        search: newView?.search ?? ""
      };
      if (onChangeQueryParams && !dequal(newQueryParams, { page, search })) {
        onChangeQueryParams(newQueryParams);
      }
      const modifications = getUserModifications(newView, {
        defaultView,
        defaultLayouts: defaultLayouts3,
        activeViewOverrides,
        persistedView
      });
      if (!dequal(modifications, persistedView)) {
        set3("core/views", preferenceKey, modifications);
      }
    },
    [
      onChangeQueryParams,
      page,
      search,
      defaultView,
      defaultLayouts3,
      activeViewOverrides,
      persistedView,
      set3,
      preferenceKey
    ]
  );
  const resetToDefault = (0, import_element45.useCallback)(() => {
    set3("core/views", preferenceKey, void 0);
  }, [preferenceKey, set3]);
  return {
    view,
    isModified,
    updateView,
    resetToDefault
  };
}

// packages/views/build-module/load-view.mjs
var import_data2 = __toESM(require_data(), 1);
var import_preferences2 = __toESM(require_preferences(), 1);

// packages/views/build-module/use-view-config.mjs
var import_data3 = __toESM(require_data(), 1);
var import_core_data = __toESM(require_core_data(), 1);

// packages/views/build-module/lock-unlock.mjs
var import_private_apis3 = __toESM(require_private_apis(), 1);
var { lock: lock3, unlock: unlock3 } = (0, import_private_apis3.__dangerousOptInToUnstableAPIsOnlyForCoreModules)(
  "I acknowledge private features are not for use in themes or plugins and doing so will break in the next version of Retraceur.",
  "@wordpress/views"
);

// packages/content-types/build-module/post-types/actions/activate.mjs
var import_i18n6 = __toESM(require_i18n(), 1);

// packages/content-types/build-module/utils/actions.mjs
var import_core_data2 = __toESM(require_core_data(), 1);
var import_notices = __toESM(require_notices(), 1);
function createStatusAction(config) {
  const isEligible = (item) => item.status !== config.targetStatus;
  return {
    id: config.id,
    label: config.label,
    supportsBulk: true,
    isEligible,
    async callback(items, { registry }) {
      const itemsToUpdate = items.filter(isEligible);
      if (itemsToUpdate.length === 0) {
        return;
      }
      const { saveEntityRecord } = registry.dispatch(import_core_data2.store);
      const { createSuccessNotice, createErrorNotice } = registry.dispatch(import_notices.store);
      const promiseResult = await Promise.allSettled(
        itemsToUpdate.map(
          (item) => saveEntityRecord(
            "postType",
            config.entity,
            { id: item.id, status: config.targetStatus },
            { throwOnError: true }
          )
        )
      );
      if (promiseResult.every(({ status }) => status === "fulfilled")) {
        createSuccessNotice(
          itemsToUpdate.length === 1 ? config.messages.successSingle : config.messages.successMany(itemsToUpdate.length),
          { type: "snackbar" }
        );
        return;
      }
      let errorMessage;
      if (promiseResult.length === 1) {
        const typedError = promiseResult[0];
        if (typedError.reason?.message && typedError.reason.code !== "unknown_error") {
          errorMessage = typedError.reason.message;
        } else {
          errorMessage = config.messages.failSingle;
        }
      } else {
        const errorMessages = /* @__PURE__ */ new Set();
        const failedPromises = promiseResult.filter(
          ({ status }) => status === "rejected"
        );
        for (const failedPromise of failedPromises) {
          const typedError = failedPromise;
          if (typedError.reason?.message && typedError.reason.code !== "unknown_error") {
            errorMessages.add(typedError.reason.message);
          }
        }
        if (errorMessages.size === 0) {
          errorMessage = config.messages.failMany;
        } else if (errorMessages.size === 1) {
          errorMessage = config.messages.errorSingle(
            [...errorMessages][0]
          );
        } else {
          errorMessage = config.messages.errorMany(
            [...errorMessages].join(",")
          );
        }
      }
      createErrorNotice(errorMessage, { type: "snackbar" });
    }
  };
}

// packages/content-types/build-module/constants.mjs
var POST_TYPES_PATH = "/post-types";
var TAXONOMIES_PATH = "/taxonomies";
var POST_TYPE_ENTITY = "wp_user_post_type";
var TAXONOMY_ENTITY = "wp_user_taxonomy";
var NEW_ID = "new";

// packages/content-types/build-module/post-types/actions/activate.mjs
var activateAction = createStatusAction({
  id: "activate",
  label: (0, import_i18n6.__)("Activate"),
  entity: POST_TYPE_ENTITY,
  targetStatus: "publish",
  messages: {
    successSingle: (0, import_i18n6.__)("Post type activated."),
    successMany: (count) => (0, import_i18n6.sprintf)(
      /* translators: %d: The number of post types. */
      (0, import_i18n6._n)(
        "%d post type activated.",
        "%d post types activated.",
        count
      ),
      count
    ),
    failSingle: (0, import_i18n6.__)("Failed to activate post type."),
    failMany: (0, import_i18n6.__)("Failed to activate post types."),
    errorSingle: (message) => (0, import_i18n6.sprintf)(
      /* translators: %s: an error message */
      (0, import_i18n6.__)("An error occurred while activating the post type: %s"),
      message
    ),
    errorMany: (messages) => (0, import_i18n6.sprintf)(
      /* translators: %s: a list of comma separated error messages */
      (0, import_i18n6.__)(
        "Some errors occurred while activating the post types: %s"
      ),
      messages
    )
  }
});
var activate_default = activateAction;

// packages/content-types/build-module/post-types/actions/deactivate.mjs
var import_i18n7 = __toESM(require_i18n(), 1);
var deactivateAction = createStatusAction({
  id: "deactivate",
  label: (0, import_i18n7.__)("Deactivate"),
  entity: POST_TYPE_ENTITY,
  targetStatus: "draft",
  messages: {
    successSingle: (0, import_i18n7.__)("Post type deactivated."),
    successMany: (count) => (0, import_i18n7.sprintf)(
      /* translators: %d: The number of post types. */
      (0, import_i18n7._n)(
        "%d post type deactivated.",
        "%d post types deactivated.",
        count
      ),
      count
    ),
    failSingle: (0, import_i18n7.__)("Failed to deactivate post type."),
    failMany: (0, import_i18n7.__)("Failed to deactivate post types."),
    errorSingle: (message) => (0, import_i18n7.sprintf)(
      /* translators: %s: an error message */
      (0, import_i18n7.__)("An error occurred while deactivating the post type: %s"),
      message
    ),
    errorMany: (messages) => (0, import_i18n7.sprintf)(
      /* translators: %s: a list of comma separated error messages */
      (0, import_i18n7.__)(
        "Some errors occurred while deactivating the post types: %s"
      ),
      messages
    )
  }
});
var deactivate_default = deactivateAction;

// packages/content-types/build-module/post-types/actions/delete.mjs
var import_components3 = __toESM(require_components(), 1);
var import_core_data4 = __toESM(require_core_data(), 1);
var import_data5 = __toESM(require_data(), 1);
var import_element47 = __toESM(require_element(), 1);
var import_i18n8 = __toESM(require_i18n(), 1);
var import_notices2 = __toESM(require_notices(), 1);

// packages/content-types/build-module/utils/use-maybe-invalidate-content-type-cache.mjs
var import_element46 = __toESM(require_element(), 1);
var import_core_data3 = __toESM(require_core_data(), 1);
var import_data4 = __toESM(require_data(), 1);
var import_is_shallow_equal = __toESM(require_is_shallow_equal(), 1);
function useMaybeInvalidateContentTypeCache() {
  const registry = (0, import_data4.useRegistry)();
  return (0, import_element46.useCallback)(
    (prev, next, entityName) => {
      if ((0, import_is_shallow_equal.isShallowEqual)([...prev].sort(), [...next].sort())) {
        return;
      }
      const resolvers = registry.select(import_core_data3.store).getCachedResolvers();
      const cache = resolvers.getEntityRecords;
      cache?.forEach((_value, args) => {
        if (args[0] === "postType" && args[1] === entityName) {
          registry.dispatch(import_core_data3.store).invalidateResolution("getEntityRecords", args);
        }
      });
    },
    [registry]
  );
}

// packages/content-types/build-module/post-types/actions/delete.mjs
var import_jsx_runtime60 = __toESM(require_jsx_runtime(), 1);
function DeletePostTypeModal({
  items,
  closeModal,
  onActionPerformed
}) {
  const [isDeleting, setIsDeleting] = (0, import_element47.useState)(false);
  const { deleteEntityRecord } = (0, import_data5.useDispatch)(import_core_data4.store);
  const { createSuccessNotice, createErrorNotice } = (0, import_data5.useDispatch)(import_notices2.store);
  const maybeInvalidateCache = useMaybeInvalidateContentTypeCache();
  async function onDelete() {
    if (isDeleting) {
      return;
    }
    setIsDeleting(true);
    const itemsToDelete = items.filter((item) => item.id !== void 0);
    const promiseResult = await Promise.allSettled(
      itemsToDelete.map(
        (item) => deleteEntityRecord(
          "postType",
          POST_TYPE_ENTITY,
          item.id,
          { force: true },
          { throwOnError: true }
        )
      )
    );
    if (promiseResult.every(({ status }) => status === "fulfilled")) {
      createSuccessNotice(
        itemsToDelete.length === 1 ? (0, import_i18n8.sprintf)(
          /* translators: %s: The post type's plural label. */
          (0, import_i18n8.__)('"%s" post type deleted.'),
          itemsToDelete[0].title.raw
        ) : (0, import_i18n8.sprintf)(
          /* translators: %d: The number of post types. */
          (0, import_i18n8._n)(
            "%d post type deleted.",
            "%d post types deleted.",
            itemsToDelete.length
          ),
          itemsToDelete.length
        ),
        { type: "snackbar" }
      );
    } else {
      let errorMessage;
      if (promiseResult.length === 1) {
        const typedError = promiseResult[0];
        if (typedError.reason?.message && typedError.reason.code !== "unknown_error") {
          errorMessage = typedError.reason.message;
        } else {
          errorMessage = (0, import_i18n8.__)("Failed to delete post type.");
        }
      } else {
        const errorMessages = /* @__PURE__ */ new Set();
        const failedPromises = promiseResult.filter(
          ({ status }) => status === "rejected"
        );
        for (const failedPromise of failedPromises) {
          const typedError = failedPromise;
          if (typedError.reason?.message && typedError.reason.code !== "unknown_error") {
            errorMessages.add(typedError.reason.message);
          }
        }
        if (errorMessages.size === 0) {
          errorMessage = (0, import_i18n8.__)("Failed to delete post types.");
        } else if (errorMessages.size === 1) {
          errorMessage = (0, import_i18n8.sprintf)(
            /* translators: %s: an error message */
            (0, import_i18n8.__)(
              "An error occurred while deleting the post type: %s"
            ),
            [...errorMessages][0]
          );
        } else {
          errorMessage = (0, import_i18n8.sprintf)(
            /* translators: %s: a list of comma separated error messages */
            (0, import_i18n8.__)(
              "Some errors occurred while deleting the post types: %s"
            ),
            [...errorMessages].join(",")
          );
        }
      }
      createErrorNotice(errorMessage, { type: "snackbar" });
    }
    const deletedRefs = itemsToDelete.filter((_, i) => promiseResult[i].status === "fulfilled").flatMap((item) => item.config.taxonomies);
    maybeInvalidateCache(deletedRefs, [], TAXONOMY_ENTITY);
    onActionPerformed?.(itemsToDelete);
    setIsDeleting(false);
    closeModal?.();
  }
  return /* @__PURE__ */ (0, import_jsx_runtime60.jsxs)(Stack, { direction: "column", gap: "md", children: [
    /* @__PURE__ */ (0, import_jsx_runtime60.jsx)(Text, { children: items.length > 1 ? (0, import_i18n8.sprintf)(
      /* translators: %d: number of post types to delete. */
      (0, import_i18n8._n)(
        "Are you sure you want to delete %d post type?",
        "Are you sure you want to delete %d post types?",
        items.length
      ),
      items.length
    ) : (0, import_i18n8.sprintf)(
      /* translators: %s: The post type's plural label. */
      (0, import_i18n8.__)('Are you sure you want to delete "%s"?'),
      items[0].title.raw
    ) }),
    /* @__PURE__ */ (0, import_jsx_runtime60.jsxs)(Stack, { direction: "row", justify: "flex-end", gap: "sm", children: [
      /* @__PURE__ */ (0, import_jsx_runtime60.jsx)(
        import_components3.Button,
        {
          __next40pxDefaultSize: true,
          variant: "tertiary",
          onClick: closeModal,
          disabled: isDeleting,
          accessibleWhenDisabled: true,
          children: (0, import_i18n8.__)("Cancel")
        }
      ),
      /* @__PURE__ */ (0, import_jsx_runtime60.jsx)(
        import_components3.Button,
        {
          __next40pxDefaultSize: true,
          variant: "primary",
          isDestructive: true,
          isBusy: isDeleting,
          disabled: isDeleting,
          accessibleWhenDisabled: true,
          onClick: onDelete,
          children: (0, import_i18n8._x)("Delete", "verb")
        }
      )
    ] })
  ] });
}
var deletePostTypeAction = {
  id: "delete-post-type",
  label: (0, import_i18n8._x)("Delete", "verb"),
  icon: trash_default,
  supportsBulk: true,
  hideModalHeader: true,
  modalFocusOnMount: "firstContentElement",
  modalSize: "small",
  RenderModal: DeletePostTypeModal
};
var delete_default = deletePostTypeAction;

// packages/content-types/build-module/post-types/actions/duplicate.mjs
var import_components5 = __toESM(require_components(), 1);
var import_core_data7 = __toESM(require_core_data(), 1);
var import_data8 = __toESM(require_data(), 1);
var import_dataviews = __toESM(require_dataviews(), 1);
var import_element50 = __toESM(require_element(), 1);
var import_i18n13 = __toESM(require_i18n(), 1);
var import_notices3 = __toESM(require_notices(), 1);

// packages/content-types/build-module/post-types/fields/general.mjs
var import_core_data6 = __toESM(require_core_data(), 1);
var import_data7 = __toESM(require_data(), 1);
var import_element49 = __toESM(require_element(), 1);
var import_i18n12 = __toESM(require_i18n(), 1);
var import_url2 = __toESM(require_url(), 1);

// packages/content-types/build-module/utils/fields.mjs
var import_components4 = __toESM(require_components(), 1);
var import_i18n9 = __toESM(require_i18n(), 1);
var import_url = __toESM(require_url(), 1);
var import_jsx_runtime61 = __toESM(require_jsx_runtime(), 1);
var { ValidatedInputControl, ValidatedToggleControl } = unlock2(
  import_components4.privateApis
);
function getCustomValidity(validity) {
  if (validity?.required?.message) {
    return validity.required;
  }
  if (validity?.pattern) {
    return validity.pattern;
  }
  if (validity?.maxLength) {
    return validity.maxLength;
  }
  return validity?.custom;
}
function createBooleanField(id, label, options) {
  const field = {
    id,
    label,
    type: "boolean",
    description: options.description,
    Edit: "toggle",
    getValue: ({ item }) => item.config[id],
    setValue: ({ item, value }) => ({
      config: { ...item.config, [id]: !!value }
    }),
    filterBy: false,
    enableSorting: false
  };
  if (options.isVisible) {
    field.isVisible = options.isVisible;
  }
  return field;
}
function createLabelField(id, label, options = {}) {
  const field = {
    id,
    label,
    type: "text",
    placeholder: options.placeholder,
    description: options.description,
    getValue: ({ item }) => item.config.labels[id] ?? "",
    setValue: ({ item, value }) => ({
      config: {
        ...item.config,
        labels: {
          ...item.config.labels,
          [id]: String(value ?? "")
        }
      }
    }),
    isValid: {
      ...options.required ? { required: true } : {},
      // Mirrors the server REST schema: 200 chars for labels.
      maxLength: 200
    },
    enableSorting: false
  };
  if (options.isVisible) {
    field.isVisible = options.isVisible;
  }
  return field;
}
var titleField = {
  id: "title",
  label: (0, import_i18n9.__)("Title"),
  type: "text",
  enableGlobalSearch: true,
  getValue: ({ item }) => item.title.raw,
  setValue: ({ value }) => ({
    title: { raw: String(value ?? "") }
  }),
  isValid: {
    required: true,
    // Title is stored as the plural label — mirrors the server REST schema (200 chars).
    maxLength: 200
  },
  filterBy: false,
  enableHiding: false
};
var pluralLabelField = {
  id: "plural_name",
  label: (0, import_i18n9.__)("Plural label"),
  type: "text",
  getValue: ({ item }) => item.title.raw,
  setValue: ({ value }) => ({
    title: { raw: String(value ?? "") }
  }),
  isValid: {
    required: true,
    maxLength: 200
  }
};
var singularLabelField = createLabelField(
  "singular_name",
  (0, import_i18n9.__)("Singular label"),
  { required: true }
);
function createDescriptionField(description) {
  return {
    id: "description",
    label: (0, import_i18n9.__)("Description"),
    type: "text",
    Edit: { control: "textarea", rows: 3 },
    description,
    getValue: ({ item }) => item.config.description,
    setValue: ({ item, value }) => ({
      config: { ...item.config, description: String(value ?? "") }
    }),
    // Mirrors the server REST schema (1000 chars for description).
    isValid: { maxLength: 1e3 },
    enableSorting: false
  };
}
var statusField = {
  id: "status",
  label: (0, import_i18n9.__)("Status"),
  description: (0, import_i18n9.__)("Enabled and registered with Retraceur when active."),
  // The field keeps `label: 'Status'` so the filter chip and column header
  // read naturally ("Status: Active"); the form toggle uses its own "Active"
  // label — the on/off semantic is clearer next to a switch.
  Edit: ({
    data,
    field,
    onChange,
    hideLabelFromVision,
    markWhenOptional,
    validity
  }) => {
    const isActive = field.getValue({ item: data }) === "publish";
    return /* @__PURE__ */ (0, import_jsx_runtime61.jsx)(
      ValidatedToggleControl,
      {
        label: (0, import_i18n9.__)("Active"),
        hidden: hideLabelFromVision,
        help: field.description,
        markWhenOptional,
        customValidity: getCustomValidity(validity),
        checked: isActive,
        onChange: (next) => onChange(
          field.setValue({
            item: data,
            value: next ? "publish" : "draft"
          })
        )
      }
    );
  },
  elements: [
    { value: "publish", label: (0, import_i18n9.__)("Active") },
    { value: "draft", label: (0, import_i18n9.__)("Inactive") }
  ],
  render: ({ item }) => {
    const isActive = item.status === "publish";
    return /* @__PURE__ */ (0, import_jsx_runtime61.jsx)(Badge, { intent: isActive ? "stable" : "draft", children: isActive ? (0, import_i18n9.__)("Active") : (0, import_i18n9.__)("Inactive") });
  },
  enableSorting: false
};
function SlugEdit({
  data,
  field,
  onChange,
  hideLabelFromVision,
  markWhenOptional,
  validity
}) {
  const { label, description, getValue, setValue } = field;
  const isValid = field.isValid;
  const value = getValue({ item: data }) ?? "";
  const handleChange = (newValue) => onChange(setValue({ item: data, value: newValue }));
  const onFocus = () => {
    if (data.id !== void 0 || data.slug) {
      return;
    }
    const singular = data.config.labels.singular_name?.trim();
    if (!singular) {
      return;
    }
    const cleaned = (0, import_url.cleanForSlug)(singular);
    if (/[^a-z0-9_-]/.test(cleaned)) {
      return;
    }
    const trimmed = cleaned.slice(0, isValid.maxLength.constraint).replace(/-+$/, "");
    if (trimmed) {
      handleChange(trimmed);
    }
  };
  return /* @__PURE__ */ (0, import_jsx_runtime61.jsx)(
    ValidatedInputControl,
    {
      required: !!isValid.required,
      markWhenOptional,
      customValidity: getCustomValidity(validity),
      label,
      value,
      help: description,
      onChange: handleChange,
      onFocus,
      hideLabelFromVision,
      pattern: isValid.pattern?.constraint,
      maxLength: isValid.maxLength.constraint
    }
  );
}

// packages/content-types/build-module/utils/overflowing-badges.mjs
var import_i18n10 = __toESM(require_i18n(), 1);
var import_jsx_runtime62 = __toESM(require_jsx_runtime(), 1);
var DEFAULT_MAX = 3;
function OverflowingBadges({
  items,
  max: max2 = DEFAULT_MAX
}) {
  const visible = items.slice(0, max2);
  const hidden = items.slice(max2);
  const moreLabel = (0, import_i18n10.sprintf)(
    /* translators: %d: number of additional items */
    (0, import_i18n10._n)("Show %d more", "Show %d more", hidden.length),
    hidden.length
  );
  const popoverTitle = (0, import_i18n10.sprintf)(
    /* translators: %d: number of additional items */
    (0, import_i18n10._n)("%d more item", "%d more items", hidden.length),
    hidden.length
  );
  return /* @__PURE__ */ (0, import_jsx_runtime62.jsxs)(
    Stack,
    {
      direction: "row",
      wrap: "wrap",
      gap: "xs",
      align: "center",
      render: /* @__PURE__ */ (0, import_jsx_runtime62.jsx)("span", {}),
      children: [
        visible.map((item) => /* @__PURE__ */ (0, import_jsx_runtime62.jsx)(Badge, { children: item.label }, item.key)),
        hidden.length > 0 && /* @__PURE__ */ (0, import_jsx_runtime62.jsx)(tooltip_exports.Provider, { delay: 0, children: /* @__PURE__ */ (0, import_jsx_runtime62.jsx)(tooltip_exports.Root, { children: /* @__PURE__ */ (0, import_jsx_runtime62.jsxs)(popover_exports.Root, { children: [
          /* @__PURE__ */ (0, import_jsx_runtime62.jsx)(
            tooltip_exports.Trigger,
            {
              render: /* @__PURE__ */ (0, import_jsx_runtime62.jsx)(
                popover_exports.Trigger,
                {
                  render: /* @__PURE__ */ (0, import_jsx_runtime62.jsx)(
                    Button4,
                    {
                      variant: "outline",
                      tone: "neutral",
                      size: "small",
                      "aria-label": moreLabel,
                      style: {
                        minWidth: "auto",
                        borderRadius: "var(--wpds-border-radius-lg, 8px)",
                        fontWeight: "normal"
                      },
                      children: (0, import_i18n10.sprintf)(
                        /* translators: %d: number of additional items */
                        (0, import_i18n10.__)("+%d"),
                        hidden.length
                      )
                    }
                  )
                }
              )
            }
          ),
          /* @__PURE__ */ (0, import_jsx_runtime62.jsxs)(popover_exports.Popup, { style: { maxWidth: 320 }, children: [
            /* @__PURE__ */ (0, import_jsx_runtime62.jsx)(VisuallyHidden, { render: /* @__PURE__ */ (0, import_jsx_runtime62.jsx)(popover_exports.Title, {}), children: popoverTitle }),
            /* @__PURE__ */ (0, import_jsx_runtime62.jsx)(Stack, { direction: "row", wrap: "wrap", gap: "xs", children: hidden.map((item) => /* @__PURE__ */ (0, import_jsx_runtime62.jsx)(Badge, { children: item.label }, item.key)) })
          ] }),
          /* @__PURE__ */ (0, import_jsx_runtime62.jsx)(tooltip_exports.Popup, { children: moreLabel })
        ] }) }) })
      ]
    }
  );
}

// packages/content-types/build-module/post-types/utils.mjs
var import_core_data5 = __toESM(require_core_data(), 1);
var import_data6 = __toESM(require_data(), 1);
var import_element48 = __toESM(require_element(), 1);
var import_i18n11 = __toESM(require_i18n(), 1);

// packages/content-types/build-module/utils/form-data.mjs
function pickStoredLabels(source, keys) {
  const labels = {};
  for (const key of keys) {
    const value = source?.[key];
    if (typeof value === "string") {
      labels[key] = value;
    }
  }
  return labels;
}
function serializeLabels(source, keys) {
  const labels = {};
  for (const key of keys) {
    const value = source[key];
    if (typeof value === "string" && value.trim() !== "") {
      labels[key] = value.trim();
    }
  }
  labels.singular_name = source.singular_name;
  return labels;
}

// packages/content-types/build-module/post-types/utils.mjs
var DEFAULT_SUPPORTS = ["title", "editor"];
var BLANK_RECORD = {
  slug: "",
  status: "publish",
  title: { raw: "" },
  config: {
    labels: { singular_name: "" },
    taxonomies: [],
    supports: [...DEFAULT_SUPPORTS],
    description: "",
    public: true,
    hierarchical: false,
    has_archive: false,
    show_in_rest: true
  }
};
var STRING_LABEL_KEYS = [
  "singular_name",
  "menu_name",
  "all_items",
  "add_new",
  "add_new_item",
  "edit_item",
  "new_item",
  "view_item",
  "view_items",
  "search_items",
  "not_found",
  "not_found_in_trash",
  "parent_item_colon",
  "archives",
  "attributes",
  "insert_into_item",
  "uploaded_to_this_item",
  "featured_image",
  "set_featured_image",
  "remove_featured_image",
  "use_featured_image",
  "filter_items_list",
  "items_list_navigation",
  "items_list"
];
function deriveLabels(plural, singular) {
  const lcPlural = plural.toLowerCase();
  const lcSingular = singular.toLowerCase();
  return {
    menu_name: plural,
    all_items: (0, import_i18n11.sprintf)(
      /* translators: %s: Plural post type label. */
      (0, import_i18n11.__)("All %s"),
      plural
    ),
    add_new: (0, import_i18n11.__)("Add New"),
    add_new_item: (0, import_i18n11.sprintf)(
      /* translators: %s: Singular post type label. */
      (0, import_i18n11.__)("Add New %s"),
      singular
    ),
    edit_item: (0, import_i18n11.sprintf)(
      /* translators: %s: Singular post type label. */
      (0, import_i18n11.__)("Edit %s"),
      singular
    ),
    new_item: (0, import_i18n11.sprintf)(
      /* translators: %s: Singular post type label. */
      (0, import_i18n11.__)("New %s"),
      singular
    ),
    view_item: (0, import_i18n11.sprintf)(
      /* translators: %s: Singular post type label. */
      (0, import_i18n11.__)("View %s"),
      singular
    ),
    view_items: (0, import_i18n11.sprintf)(
      /* translators: %s: Plural post type label. */
      (0, import_i18n11.__)("View %s"),
      plural
    ),
    search_items: (0, import_i18n11.sprintf)(
      /* translators: %s: Plural post type label. */
      (0, import_i18n11.__)("Search %s"),
      plural
    ),
    not_found: (0, import_i18n11.sprintf)(
      /* translators: %s: Plural post type label, lowercase. */
      (0, import_i18n11.__)("No %s found."),
      lcPlural
    ),
    not_found_in_trash: (0, import_i18n11.sprintf)(
      /* translators: %s: Plural post type label, lowercase. */
      (0, import_i18n11.__)("No %s found in Trash."),
      lcPlural
    ),
    parent_item_colon: (0, import_i18n11.sprintf)(
      /* translators: %s: Singular post type label. */
      (0, import_i18n11.__)("Parent %s:"),
      singular
    ),
    archives: (0, import_i18n11.sprintf)(
      /* translators: %s: Singular post type label. */
      (0, import_i18n11.__)("%s Archives"),
      singular
    ),
    attributes: (0, import_i18n11.sprintf)(
      /* translators: %s: Singular post type label. */
      (0, import_i18n11.__)("%s Attributes"),
      singular
    ),
    insert_into_item: (0, import_i18n11.sprintf)(
      /* translators: %s: Singular post type label, lowercase. */
      (0, import_i18n11.__)("Insert into %s"),
      lcSingular
    ),
    uploaded_to_this_item: (0, import_i18n11.sprintf)(
      /* translators: %s: Singular post type label, lowercase. */
      (0, import_i18n11.__)("Uploaded to this %s"),
      lcSingular
    ),
    featured_image: (0, import_i18n11.__)("Featured image"),
    set_featured_image: (0, import_i18n11.__)("Set featured image"),
    remove_featured_image: (0, import_i18n11.__)("Remove featured image"),
    use_featured_image: (0, import_i18n11.__)("Use as featured image"),
    filter_items_list: (0, import_i18n11.sprintf)(
      /* translators: %s: Plural post type label, lowercase. */
      (0, import_i18n11.__)("Filter %s list"),
      lcPlural
    ),
    items_list_navigation: (0, import_i18n11.sprintf)(
      /* translators: %s: Plural post type label. */
      (0, import_i18n11.__)("%s list navigation"),
      plural
    ),
    items_list: (0, import_i18n11.sprintf)(
      /* translators: %s: Plural post type label. */
      (0, import_i18n11.__)("%s list"),
      plural
    )
  };
}
var SUPPORT_FEATURES = [
  "title",
  "editor",
  "thumbnail",
  "excerpt",
  "comments",
  "revisions",
  "author",
  "page-attributes",
  "custom-fields",
  "trackbacks",
  "post-formats"
];
function toFormData(row) {
  const config = row.config ?? {};
  const labels = pickStoredLabels(
    config.labels,
    STRING_LABEL_KEYS
  );
  const supports = Array.isArray(config.supports) ? config.supports.filter(
    (s) => SUPPORT_FEATURES.includes(s)
  ) : [...DEFAULT_SUPPORTS];
  return {
    id: row.id,
    slug: row.slug,
    status: row.status,
    title: { raw: row.title.raw },
    config: {
      labels: { singular_name: "", ...labels },
      taxonomies: Array.isArray(config.taxonomies) ? config.taxonomies : [],
      supports,
      description: config.description ?? "",
      public: config.public ?? true,
      hierarchical: config.hierarchical ?? false,
      has_archive: config.has_archive ?? false,
      show_in_rest: config.show_in_rest ?? true
    },
    count: row.count
  };
}
function serializeForSave(data) {
  const { config } = data;
  const labels = serializeLabels(
    config.labels,
    STRING_LABEL_KEYS
  );
  const description = config.description.trim();
  return {
    ...data.id !== void 0 ? { id: data.id } : {},
    slug: data.slug,
    status: data.status,
    title: data.title.raw,
    config: {
      labels,
      taxonomies: config.taxonomies,
      supports: config.supports,
      public: config.public,
      hierarchical: config.hierarchical,
      has_archive: config.has_archive,
      show_in_rest: config.show_in_rest,
      ...description !== "" ? { description } : {}
    }
  };
}
var CORE_TAXONOMY_SLUGS = ["category", "post_tag"];
function usePublicTaxonomies() {
  const taxonomies = (0, import_data6.useSelect)(
    (select2) => select2(import_core_data5.store).getTaxonomies({ per_page: -1 }),
    []
  );
  return (0, import_element48.useMemo)(() => {
    return taxonomies?.filter((t) => !!t.visibility?.public).sort((a, b) => {
      const aIsCore = CORE_TAXONOMY_SLUGS.includes(a.slug);
      const bIsCore = CORE_TAXONOMY_SLUGS.includes(b.slug);
      if (aIsCore !== bIsCore) {
        return aIsCore ? -1 : 1;
      }
      return a.name.localeCompare(b.name);
    });
  }, [taxonomies]);
}

// packages/content-types/build-module/post-types/fields/general.mjs
var import_jsx_runtime63 = __toESM(require_jsx_runtime(), 1);
var SUPPORT_LABELS = {
  title: (0, import_i18n12.__)("Title"),
  editor: (0, import_i18n12.__)("Editor"),
  thumbnail: (0, import_i18n12.__)("Featured image"),
  excerpt: (0, import_i18n12.__)("Excerpt"),
  comments: (0, import_i18n12.__)("Comments"),
  revisions: (0, import_i18n12.__)("Revisions"),
  author: (0, import_i18n12.__)("Author"),
  "page-attributes": (0, import_i18n12.__)("Page attributes"),
  "custom-fields": (0, import_i18n12.__)("Custom fields"),
  trackbacks: (0, import_i18n12.__)("Trackbacks"),
  "post-formats": (0, import_i18n12.__)("Post formats")
};
var descriptionField = createDescriptionField(
  (0, import_i18n12.__)(
    "Optional summary of the post type. Shown in admin UIs that surface post type details."
  )
);
var publicField = createBooleanField("public", (0, import_i18n12.__)("Public"), {
  description: (0, import_i18n12.__)(
    "Whether the post type is intended for use publicly either via the admin interface or by front-end users."
  )
});
var hierarchicalField = createBooleanField(
  "hierarchical",
  (0, import_i18n12.__)("Hierarchical"),
  {
    description: (0, import_i18n12.__)(
      "When on, posts of this type can have parent-child relationships like pages, and the parent picker is shown in the editor. When off, they behave like posts."
    )
  }
);
var hasArchiveField = createBooleanField(
  "has_archive",
  (0, import_i18n12.__)("Has archive"),
  {
    description: (0, import_i18n12.__)(
      "Whether the post type has an archive page (e.g. /book/). Requires permalink rewrite rules to be flushed after enabling."
    )
  }
);
var showInRestField = createBooleanField(
  "show_in_rest",
  (0, import_i18n12.__)("Show in REST API"),
  {
    description: (0, import_i18n12.__)(
      "Required for the block editor. Disable only if posts of this type should not be available via the REST API."
    )
  }
);
var countField = {
  id: "count",
  label: (0, import_i18n12.__)("Posts"),
  type: "integer",
  readOnly: true,
  render: ({ item }) => {
    const count = item.count;
    if (item.status !== "publish" || !count) {
      return /* @__PURE__ */ (0, import_jsx_runtime63.jsx)("span", { "aria-hidden": "true", children: "—" });
    }
    return /* @__PURE__ */ (0, import_jsx_runtime63.jsx)(
      Link,
      {
        href: (0, import_url2.addQueryArgs)("edit.php", {
          post_type: item.slug
        }),
        children: count
      }
    );
  },
  enableSorting: false,
  filterBy: false
};
var supportsField = {
  id: "supports",
  label: (0, import_i18n12.__)("Supports"),
  type: "array",
  description: (0, import_i18n12.__)(
    "Editor features and metadata enabled for posts of this type."
  ),
  elements: SUPPORT_FEATURES.map((feature) => ({
    value: feature,
    label: SUPPORT_LABELS[feature]
  })),
  enableSorting: false,
  getValue: ({ item }) => item.config.supports,
  setValue: ({ item, value }) => ({
    config: {
      ...item.config,
      supports: Array.isArray(value) ? value.filter(
        (v) => SUPPORT_FEATURES.includes(v)
      ) : []
    }
  }),
  render: ({ item }) => {
    const features = item.config.supports;
    if (!features || features.length === 0) {
      return /* @__PURE__ */ (0, import_jsx_runtime63.jsx)("span", { "aria-hidden": "true", children: "—" });
    }
    return /* @__PURE__ */ (0, import_jsx_runtime63.jsx)(
      OverflowingBadges,
      {
        items: features.map((f) => ({
          key: f,
          label: SUPPORT_LABELS[f] ?? f
        }))
      }
    );
  },
  filterBy: false
};
var SLUG_MAX_LENGTH = 20;
function useSlugField(originalSlug, currentValue) {
  const registeredPostTypes = (0, import_data7.useSelect)(
    (select2) => select2(import_core_data6.store).getPostTypes(),
    []
  );
  const showRenameWarning = originalSlug !== void 0 && currentValue !== originalSlug;
  return (0, import_element49.useMemo)(
    () => ({
      id: "slug",
      label: (0, import_i18n12.__)("Post type key"),
      type: "text",
      enableGlobalSearch: true,
      description: /* @__PURE__ */ (0, import_jsx_runtime63.jsxs)(Stack, { direction: "column", gap: "sm", render: /* @__PURE__ */ (0, import_jsx_runtime63.jsx)("span", {}), children: [
        showRenameWarning && /* @__PURE__ */ (0, import_jsx_runtime63.jsx)(notice_exports.Root, { intent: "warning", render: /* @__PURE__ */ (0, import_jsx_runtime63.jsx)("span", {}), children: /* @__PURE__ */ (0, import_jsx_runtime63.jsx)(notice_exports.Description, { children: (0, import_i18n12.__)(
          "Changing the key renames the post type — existing posts may become inaccessible until a migration updates the database."
        ) }) }),
        /* @__PURE__ */ (0, import_jsx_runtime63.jsx)("span", { children: (0, import_i18n12.__)(
          "Lower case letters, numbers, underscores, and dashes only. Maximum length: 20 characters."
        ) })
      ] }),
      isValid: {
        required: true,
        pattern: "^[a-z0-9_\\-]+$",
        maxLength: SLUG_MAX_LENGTH,
        custom: async (value) => {
          const slug = value.slug;
          if (originalSlug !== void 0 && slug === originalSlug) {
            return null;
          }
          const slugTaken = (registeredPostTypes ?? []).some(
            (pt) => pt.slug === slug
          );
          if (slugTaken) {
            return (0, import_i18n12.__)("This post type key is already in use.");
          }
          const drafts = await (0, import_data7.resolveSelect)(
            import_core_data6.store
          ).getEntityRecords("postType", POST_TYPE_ENTITY, {
            slug,
            status: "draft",
            _fields: "id,name",
            per_page: 1
          });
          return drafts?.length ? (0, import_i18n12.__)("This post type key is already in use.") : null;
        }
      },
      Edit: SlugEdit,
      filterBy: false,
      enableSorting: false
    }),
    [registeredPostTypes, originalSlug, showRenameWarning]
  );
}
function useTaxonomiesField() {
  const publicTaxonomies = usePublicTaxonomies();
  return (0, import_element49.useMemo)(() => {
    const elements = (publicTaxonomies ?? []).map((tax) => ({
      value: tax.slug,
      label: tax.name
    }));
    const labelMap = Object.fromEntries(
      elements.map((e) => [e.value, e.label])
    );
    return {
      id: "taxonomies",
      label: (0, import_i18n12.__)("Taxonomies"),
      type: "array",
      description: (0, import_i18n12.__)(
        "One or more taxonomies that should be associated with this post type."
      ),
      elements,
      enableSorting: false,
      getValue: ({ item }) => item.config.taxonomies,
      setValue: ({ item, value }) => ({
        config: {
          ...item.config,
          taxonomies: Array.isArray(value) ? value : []
        }
      }),
      render: ({ item }) => {
        const slugs = item.config.taxonomies;
        if (!slugs || slugs.length === 0) {
          return /* @__PURE__ */ (0, import_jsx_runtime63.jsx)("span", { "aria-hidden": "true", children: "—" });
        }
        return /* @__PURE__ */ (0, import_jsx_runtime63.jsx)(
          OverflowingBadges,
          {
            items: slugs.map((s) => ({
              key: s,
              label: labelMap[s] ?? s
            }))
          }
        );
      },
      filterBy: false
    };
  }, [publicTaxonomies]);
}
var defaultForm = {
  layout: { type: "regular" },
  fields: [
    "plural_name",
    "singular_name",
    "slug",
    "taxonomies",
    "public",
    "hierarchical",
    "has_archive",
    "status"
  ]
};
var generalForm = {
  layout: { type: "regular" },
  fields: [
    "plural_name",
    "singular_name",
    "slug",
    "description",
    "taxonomies",
    "supports",
    "public",
    "hierarchical",
    "has_archive",
    "show_in_rest",
    "status"
  ]
};

// packages/content-types/build-module/post-types/actions/duplicate.mjs
var import_jsx_runtime64 = __toESM(require_jsx_runtime(), 1);
var SLUG_MAX_LENGTH2 = 20;
var duplicateForm = {
  layout: { type: "regular" },
  fields: ["plural_name", "singular_name", "slug"]
};
function buildCopySlug(slug) {
  const match = slug.match(/^(.*?)(\d+)$/);
  const base = match ? match[1] : slug;
  const nextNumber = String(match ? parseInt(match[2], 10) + 1 : 2);
  return `${base.slice(
    0,
    SLUG_MAX_LENGTH2 - nextNumber.length
  )}${nextNumber}`;
}
function DuplicatePostTypeModal({
  items,
  closeModal,
  onActionPerformed
}) {
  const source = items[0];
  const [data, setData] = (0, import_element50.useState)(() => ({
    ...source,
    id: void 0,
    status: "draft",
    title: {
      raw: (0, import_i18n13.sprintf)(
        /* translators: %s: existing post type title. */
        (0, import_i18n13._x)("%s (Copy)", "post type"),
        source.title.raw
      )
    },
    slug: buildCopySlug(source.slug)
  }));
  const [isDuplicating, setIsDuplicating] = (0, import_element50.useState)(false);
  const slugField = useSlugField(void 0, data.slug);
  const fields = (0, import_element50.useMemo)(
    () => [
      pluralLabelField,
      singularLabelField,
      slugField
    ],
    [slugField]
  );
  const { validity, isValid } = (0, import_dataviews.useFormValidity)(
    data,
    fields,
    duplicateForm
  );
  const { saveEntityRecord } = (0, import_data8.useDispatch)(import_core_data7.store);
  const { createSuccessNotice, createErrorNotice } = (0, import_data8.useDispatch)(import_notices3.store);
  async function onDuplicate() {
    if (isDuplicating || !isValid) {
      return;
    }
    setIsDuplicating(true);
    try {
      await saveEntityRecord(
        "postType",
        POST_TYPE_ENTITY,
        serializeForSave(data),
        { throwOnError: true }
      );
      createSuccessNotice(
        (0, import_i18n13.sprintf)(
          /* translators: %s: post type plural label. */
          (0, import_i18n13.__)('"%s" post type created.'),
          data.title.raw
        ),
        { type: "snackbar" }
      );
      onActionPerformed?.(items);
      closeModal?.();
    } catch (error2) {
      const typedError = error2;
      createErrorNotice(
        typedError?.message && typedError.code !== "unknown_error" ? typedError.message : (0, import_i18n13.__)("Failed to duplicate post type."),
        { type: "snackbar" }
      );
    } finally {
      setIsDuplicating(false);
    }
  }
  return /* @__PURE__ */ (0, import_jsx_runtime64.jsxs)(Stack, { direction: "column", gap: "md", children: [
    /* @__PURE__ */ (0, import_jsx_runtime64.jsx)(
      import_dataviews.DataForm,
      {
        data,
        fields,
        form: duplicateForm,
        validity,
        onChange: (edits) => setData(
          (prev) => ({ ...prev, ...edits })
        )
      }
    ),
    /* @__PURE__ */ (0, import_jsx_runtime64.jsxs)(Stack, { direction: "row", justify: "flex-end", gap: "sm", children: [
      /* @__PURE__ */ (0, import_jsx_runtime64.jsx)(
        import_components5.Button,
        {
          __next40pxDefaultSize: true,
          variant: "tertiary",
          onClick: closeModal,
          disabled: isDuplicating,
          accessibleWhenDisabled: true,
          children: (0, import_i18n13.__)("Cancel")
        }
      ),
      /* @__PURE__ */ (0, import_jsx_runtime64.jsx)(
        import_components5.Button,
        {
          __next40pxDefaultSize: true,
          variant: "primary",
          isBusy: isDuplicating,
          disabled: isDuplicating || !isValid,
          accessibleWhenDisabled: true,
          onClick: onDuplicate,
          children: (0, import_i18n13._x)("Duplicate", "action label")
        }
      )
    ] })
  ] });
}
var duplicatePostTypeAction = {
  id: "duplicate-post-type",
  label: (0, import_i18n13._x)("Duplicate", "action label"),
  icon: copy_default,
  modalHeader: (0, import_i18n13.__)("Duplicate post type"),
  modalFocusOnMount: "firstContentElement",
  RenderModal: DuplicatePostTypeModal
};
var duplicate_default = duplicatePostTypeAction;

// packages/content-types/build-module/post-types/actions/view-posts.mjs
var import_i18n14 = __toESM(require_i18n(), 1);
var import_url3 = __toESM(require_url(), 1);
var viewPostsAction = {
  id: "view-posts",
  label: (items) => items[0]?.config.labels.view_items || (items[0]?.config.hierarchical ? (0, import_i18n14.__)("View pages") : (0, import_i18n14.__)("View posts")),
  // Drafts are not registered with WP, so `edit.php?post_type=…`
  // would 404. Only surface the link for active post types.
  isEligible: (item) => item.status === "publish",
  callback: (items, { onActionPerformed }) => {
    const item = items[0];
    if (!item?.slug) {
      return;
    }
    document.location.href = (0, import_url3.addQueryArgs)("edit.php", {
      post_type: item.slug
    });
    onActionPerformed?.(items);
  }
};
var view_posts_default = viewPostsAction;

// packages/content-types/build-module/post-types/fields/labels.mjs
var import_i18n16 = __toESM(require_i18n(), 1);

// packages/content-types/build-module/utils/labels.mjs
var import_components6 = __toESM(require_components(), 1);
var import_i18n15 = __toESM(require_i18n(), 1);
var import_jsx_runtime65 = __toESM(require_jsx_runtime(), 1);
var LABELS_ACTIONS_FIELD_ID = "__labels_actions";
function createLabelsActionsField(options) {
  const { labelKeys, deriveLabels: deriveLabels3, helpText } = options;
  function LabelsActionsEdit({
    data,
    onChange
  }) {
    const plural = data.title.raw.trim();
    const singular = data.config.labels.singular_name.trim();
    const canAutoFill = !!plural.length && !!singular.length;
    const currentLabels = data.config.labels;
    const hasOverrides = labelKeys.some(
      (key) => key !== "singular_name" && (currentLabels[key] ?? "") !== ""
    );
    return /* @__PURE__ */ (0, import_jsx_runtime65.jsxs)(Stack, { direction: "column", gap: "md", children: [
      /* @__PURE__ */ (0, import_jsx_runtime65.jsx)(Text, { variant: "body-md", children: helpText }),
      /* @__PURE__ */ (0, import_jsx_runtime65.jsxs)(Stack, { direction: "row", justify: "flex-end", gap: "sm", children: [
        /* @__PURE__ */ (0, import_jsx_runtime65.jsx)(
          import_components6.Button,
          {
            __next40pxDefaultSize: true,
            variant: "secondary",
            size: "compact",
            accessibleWhenDisabled: true,
            disabled: !canAutoFill,
            onClick: () => onChange({
              config: {
                ...data.config,
                labels: {
                  ...data.config.labels,
                  ...deriveLabels3(plural, singular)
                }
              }
            }),
            children: (0, import_i18n15.__)("Auto-fill labels")
          }
        ),
        /* @__PURE__ */ (0, import_jsx_runtime65.jsx)(
          import_components6.Button,
          {
            __next40pxDefaultSize: true,
            size: "compact",
            icon: trash_default,
            isDestructive: true,
            label: (0, import_i18n15.__)("Clear labels"),
            accessibleWhenDisabled: true,
            disabled: !hasOverrides,
            onClick: () => {
              const cleared = {
                singular_name: data.config.labels.singular_name
              };
              for (const key of labelKeys) {
                if (key !== "singular_name") {
                  cleared[key] = "";
                }
              }
              onChange({
                config: { ...data.config, labels: cleared }
              });
            }
          }
        )
      ] })
    ] });
  }
  return {
    id: LABELS_ACTIONS_FIELD_ID,
    label: "",
    getValue: () => "",
    setValue: () => ({}),
    Edit: LabelsActionsEdit,
    enableSorting: false,
    filterBy: false
  };
}

// packages/content-types/build-module/post-types/fields/labels.mjs
var menuNameField = createLabelField("menu_name", (0, import_i18n16.__)("Menu name"), {
  placeholder: (0, import_i18n16.__)("Posts"),
  description: (0, import_i18n16.__)("Defaults to the plural label.")
});
var allItemsField = createLabelField("all_items", (0, import_i18n16.__)("All items"), {
  placeholder: (0, import_i18n16.__)("All Posts")
});
var addNewField = createLabelField("add_new", (0, import_i18n16.__)("Add new"), {
  placeholder: (0, import_i18n16.__)("Add New"),
  description: (0, import_i18n16.__)("Shown in the admin menu and on toolbar buttons.")
});
var addNewItemLabelField = createLabelField(
  "add_new_item",
  (0, import_i18n16.__)("Add new item"),
  { placeholder: (0, import_i18n16.__)("Add New Post") }
);
var editItemField = createLabelField("edit_item", (0, import_i18n16.__)("Edit item"), {
  placeholder: (0, import_i18n16.__)("Edit Post")
});
var newItemField = createLabelField("new_item", (0, import_i18n16.__)("New item"), {
  placeholder: (0, import_i18n16.__)("New Post")
});
var viewItemField = createLabelField("view_item", (0, import_i18n16.__)("View item"), {
  placeholder: (0, import_i18n16.__)("View Post")
});
var viewItemsField = createLabelField(
  "view_items",
  (0, import_i18n16.__)("View items"),
  {
    placeholder: (0, import_i18n16.__)("View Posts"),
    description: (0, import_i18n16.__)("Used as the link label for the post type archive.")
  }
);
var searchItemsField = createLabelField(
  "search_items",
  (0, import_i18n16.__)("Search items"),
  { placeholder: (0, import_i18n16.__)("Search Posts") }
);
var notFoundField = createLabelField("not_found", (0, import_i18n16.__)("Not found"), {
  placeholder: (0, import_i18n16.__)("No posts found."),
  description: (0, import_i18n16.__)("Shown in the admin list when no posts match.")
});
var notFoundInTrashField = createLabelField(
  "not_found_in_trash",
  (0, import_i18n16.__)("Not found in trash"),
  { placeholder: (0, import_i18n16.__)("No posts found in Trash.") }
);
var archivesField = createLabelField("archives", (0, import_i18n16.__)("Archives"), {
  placeholder: (0, import_i18n16.__)("Post Archives"),
  description: (0, import_i18n16.__)(
    "Used in the navigation menus block when adding a link to the post type archive."
  )
});
var attributesField = createLabelField(
  "attributes",
  (0, import_i18n16.__)("Attributes"),
  {
    placeholder: (0, import_i18n16.__)("Post Attributes"),
    description: (0, import_i18n16.__)(
      "Title of the Attributes meta box. Not used on non-hierarchical post types."
    ),
    isVisible: (item) => item.config.hierarchical
  }
);
var parentItemColonField = createLabelField(
  "parent_item_colon",
  (0, import_i18n16.__)("Parent item with colon"),
  {
    placeholder: (0, import_i18n16.__)("Parent Page:"),
    description: (0, import_i18n16.__)(
      "Shown above the parent dropdown. Not used on non-hierarchical post types."
    ),
    isVisible: (item) => item.config.hierarchical
  }
);
var insertIntoItemField = createLabelField(
  "insert_into_item",
  (0, import_i18n16.__)("Insert into item"),
  {
    placeholder: (0, import_i18n16.__)("Insert into post"),
    description: (0, import_i18n16.__)("Shown in the media library uploader.")
  }
);
var uploadedToThisItemField = createLabelField(
  "uploaded_to_this_item",
  (0, import_i18n16.__)("Uploaded to this item"),
  {
    placeholder: (0, import_i18n16.__)("Uploaded to this post")
  }
);
var featuredImageField = createLabelField(
  "featured_image",
  (0, import_i18n16.__)("Featured image"),
  {
    placeholder: (0, import_i18n16.__)("Featured image")
  }
);
var setFeaturedImageField = createLabelField(
  "set_featured_image",
  (0, import_i18n16.__)("Set featured image"),
  {
    placeholder: (0, import_i18n16.__)("Set featured image")
  }
);
var removeFeaturedImageField = createLabelField(
  "remove_featured_image",
  (0, import_i18n16.__)("Remove featured image"),
  {
    placeholder: (0, import_i18n16.__)("Remove featured image")
  }
);
var useFeaturedImageField = createLabelField(
  "use_featured_image",
  (0, import_i18n16.__)("Use as featured image"),
  {
    placeholder: (0, import_i18n16.__)("Use as featured image")
  }
);
var filterItemsListField = createLabelField(
  "filter_items_list",
  (0, import_i18n16.__)("Filter items list"),
  {
    placeholder: (0, import_i18n16.__)("Filter posts list"),
    description: (0, import_i18n16.__)(
      "Screen reader text for the admin list filter controls."
    )
  }
);
var itemsListNavigationField = createLabelField(
  "items_list_navigation",
  (0, import_i18n16.__)("Items list navigation"),
  {
    placeholder: (0, import_i18n16.__)("Posts list navigation"),
    description: (0, import_i18n16.__)("Screen reader text for the admin list pagination.")
  }
);
var itemsListField = createLabelField(
  "items_list",
  (0, import_i18n16.__)("Items list"),
  {
    placeholder: (0, import_i18n16.__)("Posts list"),
    description: (0, import_i18n16.__)("Screen reader text for the admin list table.")
  }
);
var labelsActionsField = createLabelsActionsField(
  {
    labelKeys: STRING_LABEL_KEYS,
    deriveLabels,
    helpText: (0, import_i18n16.__)(
      "Override the text Retraceur shows in admin lists, menus, and forms. Auto-fill replaces every label below with values derived from the current plural and singular names — including any you have already customized. Clearing removes all overrides so Retraceur falls back to its defaults. If you rename the post type after auto-filling, click Auto-fill again to keep them in sync."
    )
  }
);
var labelsForm = {
  layout: { type: "regular" },
  fields: [
    {
      id: LABELS_ACTIONS_FIELD_ID,
      layout: { type: "regular", labelPosition: "none" }
    },
    // singular_name lives in the General card, so exclude it here.
    ...STRING_LABEL_KEYS.filter((key) => key !== "singular_name")
  ]
};

// packages/content-types/build-module/post-types/actions/edit.mjs
var import_element51 = __toESM(require_element(), 1);
var import_i18n17 = __toESM(require_i18n(), 1);
import { useNavigate as useNavigate2 } from "@wordpress/route";
function useEditPostTypeAction() {
  const navigate = useNavigate2();
  return (0, import_element51.useMemo)(
    () => ({
      id: "edit-post-type",
      label: (0, import_i18n17.__)("Edit"),
      callback: (items) => {
        const item = items[0];
        if (item?.id === void 0) {
          return;
        }
        navigate({
          to: `${POST_TYPES_PATH}/${item.id}`
        });
      }
    }),
    [navigate]
  );
}

// packages/content-types/build-module/post-types/actions/quick-edit.mjs
var import_components7 = __toESM(require_components(), 1);
var import_core_data8 = __toESM(require_core_data(), 1);
var import_data9 = __toESM(require_data(), 1);
var import_dataviews2 = __toESM(require_dataviews(), 1);
var import_element52 = __toESM(require_element(), 1);
var import_i18n18 = __toESM(require_i18n(), 1);
var import_notices4 = __toESM(require_notices(), 1);
var import_jsx_runtime66 = __toESM(require_jsx_runtime(), 1);
function QuickEditPostTypeModal({
  items,
  closeModal
}) {
  const item = items[0];
  const [data, setData] = (0, import_element52.useState)(item);
  const [isSaving, setIsSaving] = (0, import_element52.useState)(false);
  const slugField = useSlugField(item.slug, data.slug);
  const taxonomiesField = useTaxonomiesField();
  const fields = (0, import_element52.useMemo)(
    () => [
      pluralLabelField,
      singularLabelField,
      slugField,
      taxonomiesField,
      publicField,
      hierarchicalField,
      hasArchiveField,
      statusField
    ],
    [slugField, taxonomiesField]
  );
  const { validity, isValid } = (0, import_dataviews2.useFormValidity)(data, fields, defaultForm);
  const { saveEntityRecord } = (0, import_data9.useDispatch)(import_core_data8.store);
  const { createSuccessNotice, createErrorNotice } = (0, import_data9.useDispatch)(import_notices4.store);
  const maybeInvalidateCache = useMaybeInvalidateContentTypeCache();
  async function onSave() {
    if (isSaving || !isValid) {
      return;
    }
    setIsSaving(true);
    try {
      await saveEntityRecord(
        "postType",
        POST_TYPE_ENTITY,
        serializeForSave({ ...data, id: item.id }),
        { throwOnError: true }
      );
      createSuccessNotice(
        (0, import_i18n18.sprintf)(
          /* translators: %s: post type plural label. */
          (0, import_i18n18.__)('"%s" post type updated.'),
          data.title.raw
        ),
        { type: "snackbar" }
      );
      maybeInvalidateCache(
        item.config.taxonomies,
        data.config.taxonomies,
        TAXONOMY_ENTITY
      );
      closeModal?.();
    } catch (error2) {
      createErrorNotice(
        error2?.message && error2?.code !== "unknown_error" ? error2.message : (0, import_i18n18.__)("Failed to update post type."),
        { type: "snackbar" }
      );
    } finally {
      setIsSaving(false);
    }
  }
  return /* @__PURE__ */ (0, import_jsx_runtime66.jsxs)(
    "form",
    {
      onSubmit: (event) => {
        event.preventDefault();
        onSave();
      },
      children: [
        /* @__PURE__ */ (0, import_jsx_runtime66.jsxs)(
          Stack,
          {
            className: "dataviews-action-modal__quick-edit-post-type-header",
            direction: "row",
            justify: "space-between",
            align: "center",
            children: [
              /* @__PURE__ */ (0, import_jsx_runtime66.jsx)(Text, { variant: "heading-sm", render: /* @__PURE__ */ (0, import_jsx_runtime66.jsx)("h2", {}), children: (0, import_i18n18.__)("Quick edit post type") }),
              /* @__PURE__ */ (0, import_jsx_runtime66.jsx)(
                import_components7.Button,
                {
                  size: "small",
                  icon: close_small_default,
                  label: (0, import_i18n18.__)("Close"),
                  onClick: closeModal
                }
              )
            ]
          }
        ),
        /* @__PURE__ */ (0, import_jsx_runtime66.jsx)("div", { className: "dataviews-action-modal__quick-edit-post-type-content", children: /* @__PURE__ */ (0, import_jsx_runtime66.jsx)(
          import_dataviews2.DataForm,
          {
            data,
            fields,
            form: defaultForm,
            validity,
            onChange: (edits) => setData(
              (prev) => ({ ...prev, ...edits })
            )
          }
        ) }),
        /* @__PURE__ */ (0, import_jsx_runtime66.jsxs)(
          Stack,
          {
            className: "dataviews-action-modal__quick-edit-post-type-footer",
            direction: "row",
            gap: "sm",
            children: [
              /* @__PURE__ */ (0, import_jsx_runtime66.jsx)(
                import_components7.Button,
                {
                  __next40pxDefaultSize: true,
                  variant: "secondary",
                  onClick: closeModal,
                  children: (0, import_i18n18.__)("Cancel")
                }
              ),
              /* @__PURE__ */ (0, import_jsx_runtime66.jsx)(
                import_components7.Button,
                {
                  __next40pxDefaultSize: true,
                  variant: "primary",
                  type: "submit",
                  isBusy: isSaving,
                  disabled: isSaving || !isValid,
                  accessibleWhenDisabled: true,
                  children: (0, import_i18n18.__)("Done")
                }
              )
            ]
          }
        )
      ]
    }
  );
}
var quickEditPostTypeAction = {
  id: "quick-edit-post-type",
  label: (0, import_i18n18.__)("Quick edit"),
  icon: pencil_default,
  isPrimary: true,
  hideModalHeader: true,
  RenderModal: QuickEditPostTypeModal
};
var quick_edit_default = quickEditPostTypeAction;

// packages/content-types/build-module/post-types/list.mjs
var import_jsx_runtime67 = __toESM(require_jsx_runtime(), 1);
var defaultLayouts = {
  table: {}
};
var DEFAULT_VIEW = {
  type: "table",
  perPage: 20,
  page: 1,
  fields: ["taxonomies", "count", "status"],
  titleField: "title",
  layout: {
    styles: {
      taxonomies: { minWidth: 230 },
      supports: { minWidth: 230 }
    }
  }
};
function PostTypesList() {
  const navigate = useNavigate3();
  const searchParams = useSearch({ from: POST_TYPES_PATH });
  const handleQueryParamsChange = (0, import_element53.useCallback)(
    (params) => {
      navigate({
        search: {
          ...searchParams,
          ...params
        }
      });
    },
    [searchParams, navigate]
  );
  const { view, updateView, isModified, resetToDefault } = useView({
    kind: "postType",
    name: POST_TYPE_ENTITY,
    slug: "default",
    defaultView: DEFAULT_VIEW,
    queryParams: searchParams,
    onChangeQueryParams: handleQueryParamsChange
  });
  const editAction = useEditPostTypeAction();
  const postTypeActions = (0, import_element53.useMemo)(
    () => [
      editAction,
      quick_edit_default,
      duplicate_default,
      view_posts_default,
      activate_default,
      deactivate_default,
      delete_default
    ],
    [editAction]
  );
  const slugField = useSlugField();
  const taxonomiesField = useTaxonomiesField();
  const fields = (0, import_element53.useMemo)(
    () => [
      titleField,
      taxonomiesField,
      countField,
      statusField,
      publicField,
      slugField,
      hierarchicalField,
      hasArchiveField,
      supportsField
    ],
    [slugField, taxonomiesField]
  );
  const queryArgs = (0, import_element53.useMemo)(() => {
    const statusFilter = view.filters?.find(
      (filter) => filter.field === "status"
    );
    return {
      per_page: view.perPage,
      page: view.page,
      context: "edit",
      order: view.sort?.direction,
      orderby: view.sort?.field,
      search: view.search,
      status: statusFilter?.value ?? ["publish", "draft"]
    };
  }, [view]);
  const { records, isResolving, hasResolved, totalItems, totalPages } = (0, import_core_data9.useEntityRecords)(
    "postType",
    POST_TYPE_ENTITY,
    queryArgs
  );
  const data = (0, import_element53.useMemo)(
    () => (records ?? []).map(toFormData),
    [records]
  );
  const paginationInfo = (0, import_element53.useMemo)(
    () => ({
      totalItems: totalItems ?? 0,
      totalPages: totalPages ?? 0
    }),
    [totalItems, totalPages]
  );
  return /* @__PURE__ */ (0, import_jsx_runtime67.jsx)(
    import_dataviews3.DataViews,
    {
      data,
      fields,
      actions: postTypeActions,
      view,
      onChangeView: updateView,
      onReset: isModified ? resetToDefault : false,
      isLoading: isResolving || !hasResolved,
      paginationInfo,
      defaultLayouts,
      getItemId: (item) => String(item.id),
      isItemClickable: () => true,
      onClickItem: (item) => navigate({
        to: `${POST_TYPES_PATH}/${item.id}`
      }),
      header: /* @__PURE__ */ (0, import_jsx_runtime67.jsx)(
        import_components8.Button,
        {
          variant: "primary",
          size: "compact",
          __next40pxDefaultSize: true,
          onClick: () => navigate({
            to: `${POST_TYPES_PATH}/${NEW_ID}`
          }),
          children: (0, import_i18n19.__)("Add post type")
        }
      )
    }
  );
}

// packages/content-types/build-module/post-types/edit.mjs
var import_components9 = __toESM(require_components(), 1);
var import_compose3 = __toESM(require_compose(), 1);
var import_core_data10 = __toESM(require_core_data(), 1);
var import_data10 = __toESM(require_data(), 1);
var import_dataviews4 = __toESM(require_dataviews(), 1);
var import_element54 = __toESM(require_element(), 1);
var import_i18n20 = __toESM(require_i18n(), 1);
var import_notices5 = __toESM(require_notices(), 1);
import { useNavigate as useNavigate4, useParams } from "@wordpress/route";
var import_jsx_runtime68 = __toESM(require_jsx_runtime(), 1);
function PostTypeEdit() {
  const { id } = useParams({ from: `${POST_TYPES_PATH}/$id` });
  const navigate = useNavigate4();
  const isAddMode = id === NEW_ID;
  const postTypeId = parseInt(id, 10);
  const record = (0, import_data10.useSelect)(
    (select2) => {
      return !isAddMode && // beforeLoad (route.ts) guarantees the record is in cache.
      select2(import_core_data10.store).getEntityRecord(
        "postType",
        POST_TYPE_ENTITY,
        postTypeId
      );
    },
    [isAddMode, postTypeId]
  );
  const initialData = !isAddMode && record ? toFormData(record) : BLANK_RECORD;
  const title = isAddMode ? (0, import_i18n20.__)("Add post type") : initialData.title.raw;
  const commonProps = { initialData, title };
  const postTypePageProps = isAddMode ? {
    ...commonProps,
    isAddMode: true,
    breadcrumbLabel: (0, import_i18n20.__)("Add new"),
    subTitle: (0, import_i18n20.__)(
      "Define a new post type. Fill in the essentials under General; expand Labels to customize."
    ),
    onSaved: (saved) => navigate({
      to: `${POST_TYPES_PATH}/${saved.id}`
    })
  } : {
    ...commonProps,
    isAddMode: false,
    breadcrumbLabel: title,
    subTitle: (0, import_i18n20.__)(
      "Edit this post type. Expand the Labels section to adjust labels."
    )
  };
  return /* @__PURE__ */ (0, import_jsx_runtime68.jsx)(PostTypePage, { ...postTypePageProps }, id);
}
function PostTypePage({
  isAddMode,
  initialData,
  title,
  breadcrumbLabel,
  subTitle,
  onSaved
}) {
  const [data, setData] = (0, import_element54.useState)(initialData);
  const [isSaving, setIsSaving] = (0, import_element54.useState)(false);
  const originalSlug = !isAddMode ? initialData.slug : void 0;
  const slugField = useSlugField(originalSlug, data.slug);
  const taxonomiesField = useTaxonomiesField();
  const fields = (0, import_element54.useMemo)(
    () => [
      // General
      pluralLabelField,
      singularLabelField,
      slugField,
      descriptionField,
      taxonomiesField,
      supportsField,
      publicField,
      hierarchicalField,
      hasArchiveField,
      showInRestField,
      statusField,
      // Labels
      labelsActionsField,
      menuNameField,
      allItemsField,
      addNewField,
      addNewItemLabelField,
      editItemField,
      newItemField,
      viewItemField,
      viewItemsField,
      searchItemsField,
      notFoundField,
      notFoundInTrashField,
      parentItemColonField,
      archivesField,
      attributesField,
      insertIntoItemField,
      uploadedToThisItemField,
      featuredImageField,
      setFeaturedImageField,
      removeFeaturedImageField,
      useFeaturedImageField,
      filterItemsListField,
      itemsListNavigationField,
      itemsListField
    ],
    [slugField, taxonomiesField]
  );
  const form = (0, import_element54.useMemo)(
    () => ({
      layout: { type: "card", isCollapsible: true },
      fields: [
        {
          id: "general",
          label: (0, import_i18n20.__)("General"),
          description: (0, import_i18n20.__)(
            "Core identity, taxonomies, supports, and activation."
          ),
          layout: {
            type: "card",
            isCollapsible: true,
            isOpened: true
          },
          children: generalForm.fields
        },
        {
          id: "labels",
          label: (0, import_i18n20.__)("Labels"),
          layout: {
            type: "card",
            isCollapsible: true,
            isOpened: false
          },
          children: labelsForm.fields
        }
      ]
    }),
    []
  );
  const { validity, isValid } = (0, import_dataviews4.useFormValidity)(data, fields, form);
  const formId = (0, import_compose3.useInstanceId)(PostTypePage, "post-type-form");
  const { saveEntityRecord } = (0, import_data10.useDispatch)(import_core_data10.store);
  const { createSuccessNotice, createErrorNotice } = (0, import_data10.useDispatch)(import_notices5.store);
  const maybeInvalidateCache = useMaybeInvalidateContentTypeCache();
  async function onSave() {
    if (isSaving || !isValid) {
      return;
    }
    setIsSaving(true);
    try {
      const saved = await saveEntityRecord(
        "postType",
        POST_TYPE_ENTITY,
        serializeForSave(data),
        { throwOnError: true }
      );
      const successMessage = isAddMode ? (0, import_i18n20.sprintf)(
        /* translators: %s: post type plural label. */
        (0, import_i18n20.__)('"%s" post type created.'),
        data.title.raw
      ) : (0, import_i18n20.sprintf)(
        /* translators: %s: post type plural label. */
        (0, import_i18n20.__)('"%s" post type updated.'),
        data.title.raw
      );
      createSuccessNotice(successMessage, { type: "snackbar" });
      maybeInvalidateCache(
        initialData.config.taxonomies,
        data.config.taxonomies,
        TAXONOMY_ENTITY
      );
      if (saved?.id !== void 0) {
        onSaved?.({ ...data, id: saved.id });
      }
    } catch (error2) {
      let errorMessage;
      if (error2?.message && error2?.code !== "unknown_error") {
        errorMessage = error2.message;
      } else if (isAddMode) {
        errorMessage = (0, import_i18n20.__)("Failed to create post type.");
      } else {
        errorMessage = (0, import_i18n20.__)("Failed to update post type.");
      }
      createErrorNotice(errorMessage, { type: "snackbar" });
    } finally {
      setIsSaving(false);
    }
  }
  return /* @__PURE__ */ (0, import_jsx_runtime68.jsx)(
    page_default,
    {
      ariaLabel: title,
      breadcrumbs: /* @__PURE__ */ (0, import_jsx_runtime68.jsx)(
        breadcrumbs_default,
        {
          items: [
            { label: (0, import_i18n20.__)("Post Types"), to: POST_TYPES_PATH },
            { label: breadcrumbLabel }
          ]
        }
      ),
      subTitle,
      actions: /* @__PURE__ */ (0, import_jsx_runtime68.jsx)(
        import_components9.Button,
        {
          __next40pxDefaultSize: true,
          variant: "primary",
          size: "compact",
          type: "submit",
          form: formId,
          isBusy: isSaving,
          disabled: isSaving || !isValid,
          accessibleWhenDisabled: true,
          children: isAddMode ? (0, import_i18n20.__)("Create") : (0, import_i18n20.__)("Save")
        }
      ),
      children: /* @__PURE__ */ (0, import_jsx_runtime68.jsx)(
        Stack,
        {
          direction: "column",
          gap: "md",
          className: "post-type-form",
          render: /* @__PURE__ */ (0, import_jsx_runtime68.jsx)(
            "form",
            {
              id: formId,
              onSubmit: (event) => {
                event.preventDefault();
                onSave();
              }
            }
          ),
          children: /* @__PURE__ */ (0, import_jsx_runtime68.jsx)(
            import_dataviews4.DataForm,
            {
              data,
              fields,
              form,
              validity,
              onChange: (edits) => setData(
                (prev) => ({
                  ...prev,
                  ...edits
                })
              )
            }
          )
        }
      )
    }
  );
}

// packages/content-types/build-module/taxonomies/list.mjs
var import_components13 = __toESM(require_components(), 1);
var import_dataviews7 = __toESM(require_dataviews(), 1);
var import_core_data16 = __toESM(require_core_data(), 1);
var import_element61 = __toESM(require_element(), 1);
var import_i18n33 = __toESM(require_i18n(), 1);
import { useNavigate as useNavigate6, useSearch as useSearch2 } from "@wordpress/route";

// packages/content-types/build-module/taxonomies/actions/activate.mjs
var import_i18n21 = __toESM(require_i18n(), 1);
var activateAction2 = createStatusAction({
  id: "activate",
  label: (0, import_i18n21.__)("Activate"),
  entity: TAXONOMY_ENTITY,
  targetStatus: "publish",
  messages: {
    successSingle: (0, import_i18n21.__)("Taxonomy activated."),
    successMany: (count) => (0, import_i18n21.sprintf)(
      /* translators: %d: The number of taxonomies. */
      (0, import_i18n21._n)(
        "%d taxonomy activated.",
        "%d taxonomies activated.",
        count
      ),
      count
    ),
    failSingle: (0, import_i18n21.__)("Failed to activate taxonomy."),
    failMany: (0, import_i18n21.__)("Failed to activate taxonomies."),
    errorSingle: (message) => (0, import_i18n21.sprintf)(
      /* translators: %s: an error message */
      (0, import_i18n21.__)("An error occurred while activating the taxonomy: %s"),
      message
    ),
    errorMany: (messages) => (0, import_i18n21.sprintf)(
      /* translators: %s: a list of comma separated error messages */
      (0, import_i18n21.__)(
        "Some errors occurred while activating the taxonomies: %s"
      ),
      messages
    )
  }
});
var activate_default2 = activateAction2;

// packages/content-types/build-module/taxonomies/actions/deactivate.mjs
var import_i18n22 = __toESM(require_i18n(), 1);
var deactivateAction2 = createStatusAction({
  id: "deactivate",
  label: (0, import_i18n22.__)("Deactivate"),
  entity: TAXONOMY_ENTITY,
  targetStatus: "draft",
  messages: {
    successSingle: (0, import_i18n22.__)("Taxonomy deactivated."),
    successMany: (count) => (0, import_i18n22.sprintf)(
      /* translators: %d: The number of taxonomies. */
      (0, import_i18n22._n)(
        "%d taxonomy deactivated.",
        "%d taxonomies deactivated.",
        count
      ),
      count
    ),
    failSingle: (0, import_i18n22.__)("Failed to deactivate taxonomy."),
    failMany: (0, import_i18n22.__)("Failed to deactivate taxonomies."),
    errorSingle: (message) => (0, import_i18n22.sprintf)(
      /* translators: %s: an error message */
      (0, import_i18n22.__)("An error occurred while deactivating the taxonomy: %s"),
      message
    ),
    errorMany: (messages) => (0, import_i18n22.sprintf)(
      /* translators: %s: a list of comma separated error messages */
      (0, import_i18n22.__)(
        "Some errors occurred while deactivating the taxonomies: %s"
      ),
      messages
    )
  }
});
var deactivate_default2 = deactivateAction2;

// packages/content-types/build-module/taxonomies/actions/delete.mjs
var import_components10 = __toESM(require_components(), 1);
var import_core_data11 = __toESM(require_core_data(), 1);
var import_data11 = __toESM(require_data(), 1);
var import_element55 = __toESM(require_element(), 1);
var import_i18n23 = __toESM(require_i18n(), 1);
var import_notices6 = __toESM(require_notices(), 1);
var import_jsx_runtime69 = __toESM(require_jsx_runtime(), 1);
function DeleteTaxonomyModal({
  items,
  closeModal,
  onActionPerformed
}) {
  const [isDeleting, setIsDeleting] = (0, import_element55.useState)(false);
  const { deleteEntityRecord } = (0, import_data11.useDispatch)(import_core_data11.store);
  const { createSuccessNotice, createErrorNotice } = (0, import_data11.useDispatch)(import_notices6.store);
  const maybeInvalidateCache = useMaybeInvalidateContentTypeCache();
  async function onDelete() {
    if (isDeleting) {
      return;
    }
    setIsDeleting(true);
    const itemsToDelete = items.filter((item) => item.id !== void 0);
    const promiseResult = await Promise.allSettled(
      itemsToDelete.map(
        (item) => deleteEntityRecord(
          "postType",
          TAXONOMY_ENTITY,
          item.id,
          { force: true },
          { throwOnError: true }
        )
      )
    );
    if (promiseResult.every(({ status }) => status === "fulfilled")) {
      createSuccessNotice(
        itemsToDelete.length === 1 ? (0, import_i18n23.sprintf)(
          /* translators: %s: The taxonomy's plural label. */
          (0, import_i18n23.__)('"%s" taxonomy deleted.'),
          itemsToDelete[0].title.raw
        ) : (0, import_i18n23.sprintf)(
          /* translators: %d: The number of taxonomies. */
          (0, import_i18n23._n)(
            "%d taxonomy deleted.",
            "%d taxonomies deleted.",
            itemsToDelete.length
          ),
          itemsToDelete.length
        ),
        { type: "snackbar" }
      );
    } else {
      let errorMessage;
      if (promiseResult.length === 1) {
        const typedError = promiseResult[0];
        if (typedError.reason?.message && typedError.reason.code !== "unknown_error") {
          errorMessage = typedError.reason.message;
        } else {
          errorMessage = (0, import_i18n23.__)("Failed to delete taxonomy.");
        }
      } else {
        const errorMessages = /* @__PURE__ */ new Set();
        const failedPromises = promiseResult.filter(
          ({ status }) => status === "rejected"
        );
        for (const failedPromise of failedPromises) {
          const typedError = failedPromise;
          if (typedError.reason?.message && typedError.reason.code !== "unknown_error") {
            errorMessages.add(typedError.reason.message);
          }
        }
        if (errorMessages.size === 0) {
          errorMessage = (0, import_i18n23.__)("Failed to delete taxonomies.");
        } else if (errorMessages.size === 1) {
          errorMessage = (0, import_i18n23.sprintf)(
            /* translators: %s: an error message */
            (0, import_i18n23.__)(
              "An error occurred while deleting the taxonomy: %s"
            ),
            [...errorMessages][0]
          );
        } else {
          errorMessage = (0, import_i18n23.sprintf)(
            /* translators: %s: a list of comma separated error messages */
            (0, import_i18n23.__)(
              "Some errors occurred while deleting the taxonomies: %s"
            ),
            [...errorMessages].join(",")
          );
        }
      }
      createErrorNotice(errorMessage, { type: "snackbar" });
    }
    const deletedRefs = itemsToDelete.filter((_, i) => promiseResult[i].status === "fulfilled").flatMap((item) => item.config.object_type);
    maybeInvalidateCache(deletedRefs, [], POST_TYPE_ENTITY);
    onActionPerformed?.(itemsToDelete);
    setIsDeleting(false);
    closeModal?.();
  }
  return /* @__PURE__ */ (0, import_jsx_runtime69.jsxs)(Stack, { direction: "column", gap: "md", children: [
    /* @__PURE__ */ (0, import_jsx_runtime69.jsx)(Text, { children: items.length > 1 ? (0, import_i18n23.sprintf)(
      /* translators: %d: number of taxonomies to delete. */
      (0, import_i18n23._n)(
        "Are you sure you want to delete %d taxonomy?",
        "Are you sure you want to delete %d taxonomies?",
        items.length
      ),
      items.length
    ) : (0, import_i18n23.sprintf)(
      /* translators: %s: The taxonomy's plural label. */
      (0, import_i18n23.__)('Are you sure you want to delete "%s"?'),
      items[0].title.raw
    ) }),
    /* @__PURE__ */ (0, import_jsx_runtime69.jsxs)(Stack, { direction: "row", justify: "flex-end", gap: "sm", children: [
      /* @__PURE__ */ (0, import_jsx_runtime69.jsx)(
        import_components10.Button,
        {
          __next40pxDefaultSize: true,
          variant: "tertiary",
          onClick: closeModal,
          disabled: isDeleting,
          accessibleWhenDisabled: true,
          children: (0, import_i18n23.__)("Cancel")
        }
      ),
      /* @__PURE__ */ (0, import_jsx_runtime69.jsx)(
        import_components10.Button,
        {
          __next40pxDefaultSize: true,
          variant: "primary",
          isDestructive: true,
          isBusy: isDeleting,
          disabled: isDeleting,
          accessibleWhenDisabled: true,
          onClick: onDelete,
          children: (0, import_i18n23._x)("Delete", "verb")
        }
      )
    ] })
  ] });
}
var deleteTaxonomyAction = {
  id: "delete-taxonomy",
  label: (0, import_i18n23._x)("Delete", "verb"),
  icon: trash_default,
  supportsBulk: true,
  hideModalHeader: true,
  modalFocusOnMount: "firstContentElement",
  modalSize: "small",
  RenderModal: DeleteTaxonomyModal
};
var delete_default2 = deleteTaxonomyAction;

// packages/content-types/build-module/taxonomies/actions/duplicate.mjs
var import_components11 = __toESM(require_components(), 1);
var import_core_data14 = __toESM(require_core_data(), 1);
var import_data14 = __toESM(require_data(), 1);
var import_dataviews5 = __toESM(require_dataviews(), 1);
var import_element58 = __toESM(require_element(), 1);
var import_i18n26 = __toESM(require_i18n(), 1);
var import_notices7 = __toESM(require_notices(), 1);

// packages/content-types/build-module/taxonomies/fields/general.mjs
var import_core_data13 = __toESM(require_core_data(), 1);
var import_data13 = __toESM(require_data(), 1);
var import_element57 = __toESM(require_element(), 1);
var import_i18n25 = __toESM(require_i18n(), 1);
var import_url4 = __toESM(require_url(), 1);

// packages/content-types/build-module/taxonomies/utils.mjs
var import_core_data12 = __toESM(require_core_data(), 1);
var import_data12 = __toESM(require_data(), 1);
var import_element56 = __toESM(require_element(), 1);
var import_i18n24 = __toESM(require_i18n(), 1);
var BLANK_RECORD2 = {
  slug: "",
  status: "publish",
  title: { raw: "" },
  config: {
    labels: { singular_name: "" },
    object_type: [],
    description: "",
    public: true,
    hierarchical: false,
    publicly_queryable: true,
    show_ui: true,
    show_in_menu: true,
    show_in_nav_menus: true,
    show_tagcloud: true,
    show_in_quick_edit: true,
    show_admin_column: false,
    show_in_rest: true,
    sort: false,
    default_term_enabled: false,
    default_term: { name: "" }
  }
};
var STRING_LABEL_KEYS2 = [
  "singular_name",
  "menu_name",
  "all_items",
  "edit_item",
  "view_item",
  "update_item",
  "add_new_item",
  "new_item_name",
  "search_items",
  "not_found",
  "back_to_items",
  "parent_item",
  "popular_items",
  "separate_items_with_commas",
  "parent_item_colon",
  "add_or_remove_items",
  "choose_from_most_used"
];
function deriveLabels2(plural, singular) {
  const lcPlural = plural.toLowerCase();
  return {
    menu_name: plural,
    all_items: (0, import_i18n24.sprintf)(
      /* translators: %s: Plural taxonomy label. */
      (0, import_i18n24.__)("All %s"),
      plural
    ),
    edit_item: (0, import_i18n24.sprintf)(
      /* translators: %s: Singular taxonomy label. */
      (0, import_i18n24.__)("Edit %s"),
      singular
    ),
    view_item: (0, import_i18n24.sprintf)(
      /* translators: %s: Singular taxonomy label. */
      (0, import_i18n24.__)("View %s"),
      singular
    ),
    update_item: (0, import_i18n24.sprintf)(
      /* translators: %s: Singular taxonomy label. */
      (0, import_i18n24.__)("Update %s"),
      singular
    ),
    add_new_item: (0, import_i18n24.sprintf)(
      /* translators: %s: Singular taxonomy label. */
      (0, import_i18n24.__)("Add New %s"),
      singular
    ),
    new_item_name: (0, import_i18n24.sprintf)(
      /* translators: %s: Singular taxonomy label. */
      (0, import_i18n24.__)("New %s Name"),
      singular
    ),
    search_items: (0, import_i18n24.sprintf)(
      /* translators: %s: Plural taxonomy label. */
      (0, import_i18n24.__)("Search %s"),
      plural
    ),
    not_found: (0, import_i18n24.sprintf)(
      /* translators: %s: Plural taxonomy label, lowercase. */
      (0, import_i18n24.__)("No %s found."),
      lcPlural
    ),
    back_to_items: (0, import_i18n24.sprintf)(
      /* translators: %s: Plural taxonomy label. */
      (0, import_i18n24.__)("← Back to %s"),
      plural
    ),
    parent_item: (0, import_i18n24.sprintf)(
      /* translators: %s: Singular taxonomy label. */
      (0, import_i18n24.__)("Parent %s"),
      singular
    ),
    popular_items: (0, import_i18n24.sprintf)(
      /* translators: %s: Plural taxonomy label. */
      (0, import_i18n24.__)("Popular %s"),
      plural
    ),
    separate_items_with_commas: (0, import_i18n24.sprintf)(
      /* translators: %s: Plural taxonomy label, lowercase. */
      (0, import_i18n24.__)("Separate %s with commas"),
      lcPlural
    ),
    parent_item_colon: (0, import_i18n24.sprintf)(
      /* translators: %s: Singular taxonomy label. */
      (0, import_i18n24.__)("Parent %s:"),
      singular
    ),
    add_or_remove_items: (0, import_i18n24.sprintf)(
      /* translators: %s: Plural taxonomy label, lowercase. */
      (0, import_i18n24.__)("Add or remove %s"),
      lcPlural
    ),
    choose_from_most_used: (0, import_i18n24.sprintf)(
      /* translators: %s: Plural taxonomy label, lowercase. */
      (0, import_i18n24.__)("Choose from the most used %s"),
      lcPlural
    )
  };
}
function toFormData2(row) {
  const config = row.config ?? {};
  const labels = pickStoredLabels(
    config.labels,
    STRING_LABEL_KEYS2
  );
  const defaultTermName = config.default_term?.name ?? "";
  const formConfig = {
    labels: { singular_name: "", ...labels },
    object_type: Array.isArray(row.object_type) ? row.object_type : [],
    description: config.description ?? "",
    public: config.public,
    hierarchical: config.hierarchical,
    publicly_queryable: config.publicly_queryable,
    show_ui: config.show_ui,
    show_in_menu: config.show_in_menu,
    show_in_nav_menus: config.show_in_nav_menus,
    show_tagcloud: config.show_tagcloud,
    show_in_quick_edit: config.show_in_quick_edit,
    show_admin_column: config.show_admin_column,
    show_in_rest: config.show_in_rest,
    sort: !!config.sort,
    default_term_enabled: defaultTermName !== "",
    default_term: { name: defaultTermName }
  };
  return {
    id: row.id,
    slug: row.slug,
    status: row.status,
    title: { raw: row.title.raw },
    config: formConfig,
    count: row.count
  };
}
function serializeForSave2(data) {
  const { config } = data;
  const labels = serializeLabels(
    config.labels,
    STRING_LABEL_KEYS2
  );
  const description = config.description.trim();
  const defaultTermName = config.default_term.name.trim();
  const includeDefaultTerm = config.default_term_enabled && defaultTermName !== "";
  return {
    ...data.id !== void 0 ? { id: data.id } : {},
    slug: data.slug,
    status: data.status,
    title: data.title.raw,
    object_type: config.object_type,
    config: {
      labels,
      public: config.public,
      hierarchical: config.hierarchical,
      publicly_queryable: config.publicly_queryable,
      show_ui: config.show_ui,
      show_in_menu: config.show_in_menu,
      show_in_nav_menus: config.show_in_nav_menus,
      show_tagcloud: config.show_tagcloud,
      show_in_quick_edit: config.show_in_quick_edit,
      show_admin_column: config.show_admin_column,
      show_in_rest: config.show_in_rest,
      sort: config.sort,
      ...description !== "" ? { description } : {},
      ...includeDefaultTerm ? { default_term: { name: defaultTermName } } : {}
    }
  };
}
function usePublicPostTypes() {
  const postTypes = (0, import_data12.useSelect)(
    (select2) => select2(import_core_data12.store).getPostTypes({ per_page: -1 }),
    []
  );
  return (0, import_element56.useMemo)(() => {
    return postTypes?.filter(({ viewable }) => viewable).sort((a, b) => {
      if (a.slug === "post") {
        return -1;
      }
      if (b.slug === "post") {
        return 1;
      }
      return a.name.localeCompare(b.name);
    });
  }, [postTypes]);
}

// packages/content-types/build-module/taxonomies/fields/general.mjs
var import_jsx_runtime70 = __toESM(require_jsx_runtime(), 1);
var descriptionField2 = createDescriptionField(
  (0, import_i18n25.__)(
    "Optional summary of the taxonomy. Shown in admin UIs that surface taxonomy details."
  )
);
var hierarchicalField2 = createBooleanField(
  "hierarchical",
  (0, import_i18n25.__)("Hierarchical"),
  {
    description: (0, import_i18n25.__)(
      "When on, terms behave like categories with parent-child relationships. When off, terms behave like tags."
    )
  }
);
var SLUG_MAX_LENGTH3 = 32;
function useSlugField2(originalSlug, currentValue) {
  const registeredTaxonomies = (0, import_data13.useSelect)(
    (select2) => select2(import_core_data13.store).getTaxonomies(),
    []
  );
  const showRenameWarning = originalSlug !== void 0 && currentValue !== originalSlug;
  return (0, import_element57.useMemo)(
    () => ({
      id: "slug",
      label: (0, import_i18n25.__)("Taxonomy key"),
      type: "text",
      enableGlobalSearch: true,
      description: /* @__PURE__ */ (0, import_jsx_runtime70.jsxs)(Stack, { direction: "column", gap: "sm", render: /* @__PURE__ */ (0, import_jsx_runtime70.jsx)("span", {}), children: [
        showRenameWarning && /* @__PURE__ */ (0, import_jsx_runtime70.jsx)(notice_exports.Root, { intent: "warning", render: /* @__PURE__ */ (0, import_jsx_runtime70.jsx)("span", {}), children: /* @__PURE__ */ (0, import_jsx_runtime70.jsx)(notice_exports.Description, { children: (0, import_i18n25.__)(
          "Changing the key renames the taxonomy — existing terms may become inaccessible until a migration updates the database."
        ) }) }),
        /* @__PURE__ */ (0, import_jsx_runtime70.jsx)("span", { children: (0, import_i18n25.__)(
          "Lower case letters, numbers, underscores, and dashes only. Maximum length: 32 characters."
        ) })
      ] }),
      isValid: {
        required: true,
        pattern: "^[a-z0-9_\\-]+$",
        maxLength: SLUG_MAX_LENGTH3,
        custom: async (value) => {
          const slug = value.slug;
          if (originalSlug !== void 0 && slug === originalSlug) {
            return null;
          }
          const slugTaken = (registeredTaxonomies ?? []).some(
            (t) => t.slug === slug
          );
          if (slugTaken) {
            return (0, import_i18n25.__)("This taxonomy key is already in use.");
          }
          const drafts = await (0, import_data13.resolveSelect)(
            import_core_data13.store
          ).getEntityRecords("postType", TAXONOMY_ENTITY, {
            slug,
            status: "draft",
            _fields: "id,name",
            per_page: 1
          });
          return drafts?.length ? (0, import_i18n25.__)("This taxonomy key is already in use.") : null;
        }
      },
      Edit: SlugEdit,
      filterBy: false,
      enableSorting: false
    }),
    [registeredTaxonomies, originalSlug, showRenameWarning]
  );
}
function useObjectTypeField() {
  const publicPostTypes = usePublicPostTypes();
  return (0, import_element57.useMemo)(() => {
    const elements = (publicPostTypes ?? []).map((pt) => ({
      value: pt.slug,
      label: pt.name
    }));
    const labelMap = Object.fromEntries(
      elements.map((e) => [e.value, e.label])
    );
    return {
      id: "object_type",
      label: (0, import_i18n25.__)("Post types"),
      type: "array",
      description: (0, import_i18n25.__)(
        "One or more post types with which the taxonomy should be associated."
      ),
      elements,
      enableSorting: false,
      getValue: ({ item }) => item.config.object_type,
      setValue: ({ item, value }) => ({
        config: {
          ...item.config,
          object_type: Array.isArray(value) ? value : []
        }
      }),
      render: ({ item }) => {
        const slugs = item.config.object_type;
        if (!slugs || slugs.length === 0) {
          return /* @__PURE__ */ (0, import_jsx_runtime70.jsx)("span", { "aria-hidden": "true", children: "—" });
        }
        return /* @__PURE__ */ (0, import_jsx_runtime70.jsx)(
          OverflowingBadges,
          {
            items: slugs.map((s) => ({
              key: s,
              label: labelMap[s] ?? s
            }))
          }
        );
      },
      isValid: { required: true },
      filterBy: { operators: ["isAny"] }
    };
  }, [publicPostTypes]);
}
var countField2 = {
  id: "count",
  label: (0, import_i18n25.__)("Terms"),
  type: "integer",
  readOnly: true,
  render: ({ item }) => {
    const count = item.count;
    if (item.status !== "publish" || !count) {
      return /* @__PURE__ */ (0, import_jsx_runtime70.jsx)("span", { "aria-hidden": "true", children: "—" });
    }
    const postType = item.config.object_type?.[0];
    if (!postType) {
      return count;
    }
    return /* @__PURE__ */ (0, import_jsx_runtime70.jsx)(
      Link,
      {
        href: (0, import_url4.addQueryArgs)("edit-tags.php", {
          taxonomy: item.slug,
          post_type: postType
        }),
        children: count
      }
    );
  },
  enableSorting: false,
  filterBy: false
};
var defaultForm2 = {
  layout: { type: "regular" },
  fields: [
    "plural_name",
    "singular_name",
    "slug",
    "object_type",
    "hierarchical",
    "status"
  ]
};
var generalFormFields = [
  "plural_name",
  "singular_name",
  "slug",
  "object_type",
  "description",
  "hierarchical",
  "status"
];

// packages/content-types/build-module/taxonomies/actions/duplicate.mjs
var import_jsx_runtime71 = __toESM(require_jsx_runtime(), 1);
var SLUG_MAX_LENGTH4 = 32;
var duplicateForm2 = {
  layout: { type: "regular" },
  fields: ["plural_name", "singular_name", "slug"]
};
function buildCopySlug2(slug) {
  const match = slug.match(/^(.*?)(\d+)$/);
  const base = match ? match[1] : slug;
  const nextNumber = String(match ? parseInt(match[2], 10) + 1 : 2);
  return `${base.slice(
    0,
    SLUG_MAX_LENGTH4 - nextNumber.length
  )}${nextNumber}`;
}
function DuplicateTaxonomyModal({
  items,
  closeModal,
  onActionPerformed
}) {
  const source = items[0];
  const [data, setData] = (0, import_element58.useState)(() => ({
    ...source,
    id: void 0,
    status: "draft",
    title: {
      raw: (0, import_i18n26.sprintf)(
        /* translators: %s: existing taxonomy title. */
        (0, import_i18n26._x)("%s (Copy)", "taxonomy"),
        source.title.raw
      )
    },
    slug: buildCopySlug2(source.slug)
  }));
  const [isDuplicating, setIsDuplicating] = (0, import_element58.useState)(false);
  const slugField = useSlugField2(void 0, data.slug);
  const fields = (0, import_element58.useMemo)(
    () => [
      pluralLabelField,
      singularLabelField,
      slugField
    ],
    [slugField]
  );
  const { validity, isValid } = (0, import_dataviews5.useFormValidity)(
    data,
    fields,
    duplicateForm2
  );
  const { saveEntityRecord } = (0, import_data14.useDispatch)(import_core_data14.store);
  const { createSuccessNotice, createErrorNotice } = (0, import_data14.useDispatch)(import_notices7.store);
  async function onDuplicate() {
    if (isDuplicating || !isValid) {
      return;
    }
    setIsDuplicating(true);
    try {
      await saveEntityRecord(
        "postType",
        TAXONOMY_ENTITY,
        serializeForSave2(data),
        { throwOnError: true }
      );
      createSuccessNotice(
        (0, import_i18n26.sprintf)(
          /* translators: %s: taxonomy plural label. */
          (0, import_i18n26.__)('"%s" taxonomy created.'),
          data.title.raw
        ),
        { type: "snackbar" }
      );
      onActionPerformed?.(items);
      closeModal?.();
    } catch (error2) {
      const typedError = error2;
      createErrorNotice(
        typedError?.message && typedError.code !== "unknown_error" ? typedError.message : (0, import_i18n26.__)("Failed to duplicate taxonomy."),
        { type: "snackbar" }
      );
    } finally {
      setIsDuplicating(false);
    }
  }
  return /* @__PURE__ */ (0, import_jsx_runtime71.jsxs)(Stack, { direction: "column", gap: "md", children: [
    /* @__PURE__ */ (0, import_jsx_runtime71.jsx)(
      import_dataviews5.DataForm,
      {
        data,
        fields,
        form: duplicateForm2,
        validity,
        onChange: (edits) => setData(
          (prev) => ({ ...prev, ...edits })
        )
      }
    ),
    /* @__PURE__ */ (0, import_jsx_runtime71.jsxs)(Stack, { direction: "row", justify: "flex-end", gap: "sm", children: [
      /* @__PURE__ */ (0, import_jsx_runtime71.jsx)(
        import_components11.Button,
        {
          __next40pxDefaultSize: true,
          variant: "tertiary",
          onClick: closeModal,
          disabled: isDuplicating,
          accessibleWhenDisabled: true,
          children: (0, import_i18n26.__)("Cancel")
        }
      ),
      /* @__PURE__ */ (0, import_jsx_runtime71.jsx)(
        import_components11.Button,
        {
          __next40pxDefaultSize: true,
          variant: "primary",
          isBusy: isDuplicating,
          disabled: isDuplicating || !isValid,
          accessibleWhenDisabled: true,
          onClick: onDuplicate,
          children: (0, import_i18n26._x)("Duplicate", "action label")
        }
      )
    ] })
  ] });
}
var duplicateTaxonomyAction = {
  id: "duplicate-taxonomy",
  label: (0, import_i18n26._x)("Duplicate", "action label"),
  icon: copy_default,
  modalHeader: (0, import_i18n26.__)("Duplicate taxonomy"),
  modalFocusOnMount: "firstContentElement",
  RenderModal: DuplicateTaxonomyModal
};
var duplicate_default2 = duplicateTaxonomyAction;

// packages/content-types/build-module/taxonomies/actions/view-terms.mjs
var import_i18n27 = __toESM(require_i18n(), 1);
var import_url5 = __toESM(require_url(), 1);
var viewTermsAction = {
  id: "view-terms",
  label: (0, import_i18n27.__)("View terms"),
  // Drafts aren't registered, and `edit-tags.php` requires a `post_type`
  // query arg to render the term list, so the taxonomy must also be
  // attached to at least one post type.
  isEligible: (item) => item.status === "publish" && Array.isArray(item.config.object_type) && item.config.object_type.length > 0,
  callback: (items, { onActionPerformed }) => {
    const item = items[0];
    const postType = item?.config.object_type?.[0];
    if (!item?.slug || !postType) {
      return;
    }
    document.location.href = (0, import_url5.addQueryArgs)("edit-tags.php", {
      taxonomy: item.slug,
      post_type: postType
    });
    onActionPerformed?.(items);
  }
};
var view_terms_default = viewTermsAction;

// packages/content-types/build-module/taxonomies/fields/advanced.mjs
var import_i18n28 = __toESM(require_i18n(), 1);
var sortField = createBooleanField("sort", (0, import_i18n28.__)("Sort terms"), {
  description: (0, import_i18n28.__)(
    "Whether terms in this taxonomy should be saved in the order they are assigned to an item."
  )
});
var defaultTermEnabledField = createBooleanField(
  "default_term_enabled",
  (0, import_i18n28.__)("Set a default term"),
  {
    description: (0, import_i18n28.__)(
      'Default term to be used for the taxonomy, similar to how "Uncategorized" works for categories.'
    )
  }
);
var defaultTermNameField = {
  id: "default_term_name",
  label: (0, import_i18n28.__)("Default term name"),
  type: "text",
  description: (0, import_i18n28.__)(
    "Once saved, updating the name creates a new term — the previous default term remains in the terms list. To change the term's slug or description, edit it from the terms list."
  ),
  getValue: ({ item }) => item.config.default_term.name,
  setValue: ({ item, value }) => ({
    config: {
      ...item.config,
      default_term: { name: String(value ?? "") }
    }
  }),
  isValid: {
    // `useFormValidity` does not skip invisible fields, so `required:
    // true` would mark the form invalid whenever the toggle is off.
    // Gate the requirement on the toggle via `custom` instead.
    custom: (item) => {
      if (!item.config.default_term_enabled) {
        return null;
      }
      return item.config.default_term.name.trim() ? null : (0, import_i18n28.__)("A default term name is required.");
    },
    // Mirrors `wp_terms.name` column width (varchar(200)).
    maxLength: 200
  },
  isVisible: (item) => item.config.default_term_enabled,
  enableSorting: false,
  filterBy: false
};
var advancedFormFields = [
  "sort",
  "default_term_enabled",
  "default_term_name"
];

// packages/content-types/build-module/taxonomies/fields/labels.mjs
var import_i18n29 = __toESM(require_i18n(), 1);
var menuNameField2 = createLabelField("menu_name", (0, import_i18n29.__)("Menu name"), {
  placeholder: (0, import_i18n29.__)("Categories"),
  description: (0, import_i18n29.__)("Defaults to the plural label.")
});
var allItemsField2 = createLabelField("all_items", (0, import_i18n29.__)("All items"), {
  placeholder: (0, import_i18n29.__)("All Categories")
});
var editItemField2 = createLabelField("edit_item", (0, import_i18n29.__)("Edit item"), {
  placeholder: (0, import_i18n29.__)("Edit Category")
});
var viewItemField2 = createLabelField("view_item", (0, import_i18n29.__)("View item"), {
  placeholder: (0, import_i18n29.__)("View Category")
});
var updateItemField = createLabelField(
  "update_item",
  (0, import_i18n29.__)("Update item"),
  { placeholder: (0, import_i18n29.__)("Update Category") }
);
var addNewItemLabelField2 = createLabelField(
  "add_new_item",
  (0, import_i18n29.__)("Add new item"),
  { placeholder: (0, import_i18n29.__)("Add New Category") }
);
var newItemNameField = createLabelField(
  "new_item_name",
  (0, import_i18n29.__)("New item name"),
  { placeholder: (0, import_i18n29.__)("New Category Name") }
);
var searchItemsField2 = createLabelField(
  "search_items",
  (0, import_i18n29.__)("Search items"),
  { placeholder: (0, import_i18n29.__)("Search Categories") }
);
var notFoundField2 = createLabelField("not_found", (0, import_i18n29.__)("Not found"), {
  placeholder: (0, import_i18n29.__)("No categories found."),
  description: (0, import_i18n29.__)(
    "The text displayed when no terms are available in the term meta box and tag cloud."
  )
});
var backToItemsField = createLabelField(
  "back_to_items",
  (0, import_i18n29.__)("Back to items"),
  {
    placeholder: (0, import_i18n29.__)("← Back to Categories"),
    description: (0, import_i18n29.__)("Label displayed after a term has been updated.")
  }
);
var parentItemField = createLabelField(
  "parent_item",
  (0, import_i18n29.__)("Parent item"),
  {
    placeholder: (0, import_i18n29.__)("Parent Category"),
    description: (0, import_i18n29.__)("Not used on non-hierarchical taxonomies."),
    isVisible: (item) => item.config.hierarchical
  }
);
var popularItemsField = createLabelField(
  "popular_items",
  (0, import_i18n29.__)("Popular items"),
  {
    placeholder: (0, import_i18n29.__)("Popular Tags"),
    description: (0, import_i18n29.__)(
      "The popular items text. Not used on hierarchical taxonomies."
    ),
    isVisible: (item) => !item.config.hierarchical
  }
);
var separateItemsField = createLabelField(
  "separate_items_with_commas",
  (0, import_i18n29.__)("Separate items with commas"),
  {
    placeholder: (0, import_i18n29.__)("Separate tags with commas"),
    description: (0, import_i18n29.__)(
      "Shown in the taxonomy meta box. Not used on hierarchical taxonomies."
    ),
    isVisible: (item) => !item.config.hierarchical
  }
);
var parentItemColonField2 = createLabelField(
  "parent_item_colon",
  (0, import_i18n29.__)("Parent item with colon"),
  {
    placeholder: (0, import_i18n29.__)("Parent Category:"),
    description: (0, import_i18n29.__)("Same as Parent item, with a colon at the end."),
    isVisible: (item) => item.config.hierarchical
  }
);
var addOrRemoveItemsField = createLabelField(
  "add_or_remove_items",
  (0, import_i18n29.__)("Add or remove items"),
  {
    placeholder: (0, import_i18n29.__)("Add or remove tags"),
    description: (0, import_i18n29.__)(
      "Shown in the meta box when JavaScript is disabled. Not used on hierarchical taxonomies."
    ),
    isVisible: (item) => !item.config.hierarchical
  }
);
var chooseFromMostUsedField = createLabelField(
  "choose_from_most_used",
  (0, import_i18n29.__)("Choose from the most used"),
  {
    placeholder: (0, import_i18n29.__)("Choose from the most used tags"),
    description: (0, import_i18n29.__)(
      "Shown in the taxonomy meta box. Not used on hierarchical taxonomies."
    ),
    isVisible: (item) => !item.config.hierarchical
  }
);
var labelsActionsField2 = createLabelsActionsField(
  {
    labelKeys: STRING_LABEL_KEYS2,
    deriveLabels: deriveLabels2,
    helpText: (0, import_i18n29.__)(
      "Override the text Retraceur shows in admin lists, menus, and forms. Auto-fill replaces every label below with values derived from the current plural and singular names — including any you have already customized. Clearing removes all overrides so Retraceur falls back to its defaults. If you rename the taxonomy after auto-filling, click Auto-fill again to keep them in sync."
    )
  }
);
var labelsFormFields = [
  {
    id: LABELS_ACTIONS_FIELD_ID,
    layout: { type: "regular", labelPosition: "none" }
  },
  // singular_name lives in the General card, so exclude it here.
  ...STRING_LABEL_KEYS2.filter((key) => key !== "singular_name")
];

// packages/content-types/build-module/taxonomies/fields/visibility.mjs
var import_i18n30 = __toESM(require_i18n(), 1);
var publicField2 = createBooleanField("public", (0, import_i18n30.__)("Public"), {
  description: (0, import_i18n30.__)(
    "Whether a taxonomy is intended for use publicly either via the admin interface or by front-end users."
  )
});
var showInRestField2 = createBooleanField(
  "show_in_rest",
  (0, import_i18n30.__)("Show in REST API"),
  {
    description: (0, import_i18n30.__)(
      "Required for the block editor. Turn off only for taxonomies that should not be exposed via REST."
    )
  }
);
var publiclyQueryableField = createBooleanField(
  "publicly_queryable",
  (0, import_i18n30.__)("Publicly queryable"),
  {
    description: (0, import_i18n30.__)(
      "Whether front-end queries (e.g. ?taxonomy=…&term=…) can return terms from this taxonomy."
    )
  }
);
var showUiField = createBooleanField(
  "show_ui",
  (0, import_i18n30.__)("Show admin UI"),
  {
    description: (0, import_i18n30.__)(
      "Whether to generate a default admin interface for managing terms."
    )
  }
);
var showInMenuField = createBooleanField(
  "show_in_menu",
  (0, import_i18n30.__)("Show in admin menu"),
  {
    description: (0, import_i18n30.__)(
      "Whether to show the taxonomy in the admin menu. Has no effect when Show admin UI is off; the value is preserved either way."
    ),
    // Hide when `show_ui` is off — `show_in_menu` is silently ignored by
    // register_taxonomy() in that case, so showing the toggle would be
    // misleading. The stored value is preserved across the toggle.
    isVisible: (item) => item.config.show_ui
  }
);
var showInQuickEditField = createBooleanField(
  "show_in_quick_edit",
  (0, import_i18n30.__)("Show in Quick Edit"),
  {
    description: (0, import_i18n30.__)(
      "Whether to show the taxonomy in the Quick/Bulk Edit panel."
    )
  }
);
var showAdminColumnField = createBooleanField(
  "show_admin_column",
  (0, import_i18n30.__)("Show admin column"),
  {
    description: (0, import_i18n30.__)(
      "Whether to display a column for the taxonomy on the associated post type list tables."
    )
  }
);
var showInNavMenusField = createBooleanField(
  "show_in_nav_menus",
  (0, import_i18n30.__)("Available in nav menus"),
  {
    description: (0, import_i18n30.__)(
      "Whether terms are selectable in the theme nav menu builder."
    )
  }
);
var showTagcloudField = createBooleanField(
  "show_tagcloud",
  (0, import_i18n30.__)("Available in Tag Cloud widget"),
  {
    description: (0, import_i18n30.__)(
      "Whether terms can be displayed in the Tag Cloud widget."
    )
  }
);
var visibilityFormFields = [
  "public",
  "show_in_rest",
  "publicly_queryable",
  "show_ui",
  "show_in_menu",
  "show_in_quick_edit",
  "show_in_nav_menus",
  "show_tagcloud",
  "show_admin_column"
];

// packages/content-types/build-module/taxonomies/actions/edit.mjs
var import_element59 = __toESM(require_element(), 1);
var import_i18n31 = __toESM(require_i18n(), 1);
import { useNavigate as useNavigate5 } from "@wordpress/route";
function useEditTaxonomyAction() {
  const navigate = useNavigate5();
  return (0, import_element59.useMemo)(
    () => ({
      id: "edit-taxonomy",
      label: (0, import_i18n31.__)("Edit"),
      callback: (items) => {
        const item = items[0];
        if (item?.id === void 0) {
          return;
        }
        navigate({
          to: `${TAXONOMIES_PATH}/${item.id}`
        });
      }
    }),
    [navigate]
  );
}

// packages/content-types/build-module/taxonomies/actions/quick-edit.mjs
var import_components12 = __toESM(require_components(), 1);
var import_core_data15 = __toESM(require_core_data(), 1);
var import_data15 = __toESM(require_data(), 1);
var import_dataviews6 = __toESM(require_dataviews(), 1);
var import_element60 = __toESM(require_element(), 1);
var import_i18n32 = __toESM(require_i18n(), 1);
var import_notices8 = __toESM(require_notices(), 1);
var import_jsx_runtime72 = __toESM(require_jsx_runtime(), 1);
function QuickEditTaxonomyModal({
  items,
  closeModal
}) {
  const item = items[0];
  const [data, setData] = (0, import_element60.useState)(item);
  const [isSaving, setIsSaving] = (0, import_element60.useState)(false);
  const slugField = useSlugField2(item.slug, data.slug);
  const objectTypeField = useObjectTypeField();
  const fields = (0, import_element60.useMemo)(
    () => [
      pluralLabelField,
      singularLabelField,
      slugField,
      objectTypeField,
      publicField2,
      hierarchicalField2,
      statusField
    ],
    [slugField, objectTypeField]
  );
  const { validity, isValid } = (0, import_dataviews6.useFormValidity)(data, fields, defaultForm2);
  const { saveEntityRecord } = (0, import_data15.useDispatch)(import_core_data15.store);
  const { createSuccessNotice, createErrorNotice } = (0, import_data15.useDispatch)(import_notices8.store);
  const maybeInvalidateCache = useMaybeInvalidateContentTypeCache();
  async function onSave() {
    if (isSaving || !isValid) {
      return;
    }
    setIsSaving(true);
    try {
      await saveEntityRecord(
        "postType",
        TAXONOMY_ENTITY,
        serializeForSave2({ ...data, id: item.id }),
        { throwOnError: true }
      );
      createSuccessNotice(
        (0, import_i18n32.sprintf)(
          /* translators: %s: taxonomy plural label. */
          (0, import_i18n32.__)('"%s" taxonomy updated.'),
          data.title.raw
        ),
        { type: "snackbar" }
      );
      maybeInvalidateCache(
        item.config.object_type,
        data.config.object_type,
        POST_TYPE_ENTITY
      );
      closeModal?.();
    } catch (error2) {
      createErrorNotice(
        error2?.message && error2?.code !== "unknown_error" ? error2.message : (0, import_i18n32.__)("Failed to update taxonomy."),
        { type: "snackbar" }
      );
    } finally {
      setIsSaving(false);
    }
  }
  return /* @__PURE__ */ (0, import_jsx_runtime72.jsxs)(
    "form",
    {
      onSubmit: (event) => {
        event.preventDefault();
        onSave();
      },
      children: [
        /* @__PURE__ */ (0, import_jsx_runtime72.jsxs)(
          Stack,
          {
            className: "dataviews-action-modal__quick-edit-taxonomy-header",
            direction: "row",
            justify: "space-between",
            align: "center",
            children: [
              /* @__PURE__ */ (0, import_jsx_runtime72.jsx)(Text, { variant: "heading-sm", render: /* @__PURE__ */ (0, import_jsx_runtime72.jsx)("h2", {}), children: (0, import_i18n32.__)("Quick edit taxonomy") }),
              /* @__PURE__ */ (0, import_jsx_runtime72.jsx)(
                import_components12.Button,
                {
                  size: "small",
                  icon: close_small_default,
                  label: (0, import_i18n32.__)("Close"),
                  onClick: closeModal
                }
              )
            ]
          }
        ),
        /* @__PURE__ */ (0, import_jsx_runtime72.jsx)("div", { className: "dataviews-action-modal__quick-edit-taxonomy-content", children: /* @__PURE__ */ (0, import_jsx_runtime72.jsx)(
          import_dataviews6.DataForm,
          {
            data,
            fields,
            form: defaultForm2,
            validity,
            onChange: (edits) => setData(
              (prev) => ({ ...prev, ...edits })
            )
          }
        ) }),
        /* @__PURE__ */ (0, import_jsx_runtime72.jsxs)(
          Stack,
          {
            className: "dataviews-action-modal__quick-edit-taxonomy-footer",
            direction: "row",
            gap: "sm",
            children: [
              /* @__PURE__ */ (0, import_jsx_runtime72.jsx)(
                import_components12.Button,
                {
                  __next40pxDefaultSize: true,
                  variant: "secondary",
                  onClick: closeModal,
                  children: (0, import_i18n32.__)("Cancel")
                }
              ),
              /* @__PURE__ */ (0, import_jsx_runtime72.jsx)(
                import_components12.Button,
                {
                  __next40pxDefaultSize: true,
                  variant: "primary",
                  type: "submit",
                  isBusy: isSaving,
                  disabled: isSaving || !isValid,
                  accessibleWhenDisabled: true,
                  children: (0, import_i18n32.__)("Done")
                }
              )
            ]
          }
        )
      ]
    }
  );
}
var quickEditTaxonomyAction = {
  id: "quick-edit-taxonomy",
  label: (0, import_i18n32.__)("Quick edit"),
  icon: pencil_default,
  isPrimary: true,
  hideModalHeader: true,
  RenderModal: QuickEditTaxonomyModal
};
var quick_edit_default2 = quickEditTaxonomyAction;

// packages/content-types/build-module/taxonomies/list.mjs
var import_jsx_runtime73 = __toESM(require_jsx_runtime(), 1);
var defaultLayouts2 = {
  table: {}
};
var DEFAULT_VIEW2 = {
  type: "table",
  perPage: 20,
  page: 1,
  fields: ["object_type", "count", "status"],
  titleField: "title",
  layout: {
    styles: {
      object_type: { minWidth: 230 }
    }
  }
};
function TaxonomiesList() {
  const navigate = useNavigate6();
  const searchParams = useSearch2({ from: TAXONOMIES_PATH });
  const handleQueryParamsChange = (0, import_element61.useCallback)(
    (params) => {
      navigate({
        search: {
          ...searchParams,
          ...params
        }
      });
    },
    [searchParams, navigate]
  );
  const { view, updateView, isModified, resetToDefault } = useView({
    kind: "postType",
    name: TAXONOMY_ENTITY,
    slug: "default",
    defaultView: DEFAULT_VIEW2,
    queryParams: searchParams,
    onChangeQueryParams: handleQueryParamsChange
  });
  const editAction = useEditTaxonomyAction();
  const taxonomyActions = (0, import_element61.useMemo)(
    () => [
      editAction,
      quick_edit_default2,
      duplicate_default2,
      view_terms_default,
      activate_default2,
      deactivate_default2,
      delete_default2
    ],
    [editAction]
  );
  const slugField = useSlugField2();
  const objectTypeField = useObjectTypeField();
  const fields = (0, import_element61.useMemo)(
    () => [
      titleField,
      objectTypeField,
      countField2,
      statusField,
      publicField2,
      slugField,
      hierarchicalField2
    ],
    [slugField, objectTypeField]
  );
  const queryArgs = (0, import_element61.useMemo)(() => {
    const statusFilter = view.filters?.find(
      (filter) => filter.field === "status"
    );
    const objectTypeFilter = view.filters?.find(
      (filter) => filter.field === "object_type"
    );
    return {
      per_page: view.perPage,
      page: view.page,
      context: "edit",
      order: view.sort?.direction,
      orderby: view.sort?.field,
      search: view.search,
      status: statusFilter?.value ?? ["publish", "draft"],
      object_type: objectTypeFilter?.value
    };
  }, [view]);
  const { records, isResolving, hasResolved, totalItems, totalPages } = (0, import_core_data16.useEntityRecords)(
    "postType",
    TAXONOMY_ENTITY,
    queryArgs
  );
  const data = (0, import_element61.useMemo)(
    () => (records ?? []).map(toFormData2),
    [records]
  );
  const paginationInfo = (0, import_element61.useMemo)(
    () => ({
      totalItems: totalItems ?? 0,
      totalPages: totalPages ?? 0
    }),
    [totalItems, totalPages]
  );
  return /* @__PURE__ */ (0, import_jsx_runtime73.jsx)(
    import_dataviews7.DataViews,
    {
      data,
      fields,
      actions: taxonomyActions,
      view,
      onChangeView: updateView,
      onReset: isModified ? resetToDefault : false,
      isLoading: isResolving || !hasResolved,
      paginationInfo,
      defaultLayouts: defaultLayouts2,
      getItemId: (item) => String(item.id),
      isItemClickable: () => true,
      onClickItem: (item) => navigate({
        to: `${TAXONOMIES_PATH}/${item.id}`
      }),
      header: /* @__PURE__ */ (0, import_jsx_runtime73.jsx)(
        import_components13.Button,
        {
          variant: "primary",
          size: "compact",
          __next40pxDefaultSize: true,
          onClick: () => navigate({
            to: `${TAXONOMIES_PATH}/${NEW_ID}`
          }),
          children: (0, import_i18n33.__)("Add taxonomy")
        }
      )
    }
  );
}

// packages/content-types/build-module/taxonomies/edit.mjs
var import_components14 = __toESM(require_components(), 1);
var import_compose4 = __toESM(require_compose(), 1);
var import_core_data17 = __toESM(require_core_data(), 1);
var import_data16 = __toESM(require_data(), 1);
var import_dataviews8 = __toESM(require_dataviews(), 1);
var import_element62 = __toESM(require_element(), 1);
var import_i18n34 = __toESM(require_i18n(), 1);
var import_notices9 = __toESM(require_notices(), 1);
import { useNavigate as useNavigate7, useParams as useParams2 } from "@wordpress/route";
var import_jsx_runtime74 = __toESM(require_jsx_runtime(), 1);
function TaxonomyEdit() {
  const { id } = useParams2({ from: `${TAXONOMIES_PATH}/$id` });
  const navigate = useNavigate7();
  const isAddMode = id === NEW_ID;
  const taxonomyId = parseInt(id, 10);
  const record = (0, import_data16.useSelect)(
    (select2) => {
      return !isAddMode && // beforeLoad (route.ts) guarantees the record is in cache.
      select2(import_core_data17.store).getEntityRecord(
        "postType",
        TAXONOMY_ENTITY,
        taxonomyId
      );
    },
    [isAddMode, taxonomyId]
  );
  const initialData = !isAddMode && record ? toFormData2(record) : BLANK_RECORD2;
  const title = isAddMode ? (0, import_i18n34.__)("Add taxonomy") : initialData.title.raw;
  const commonProps = { initialData, title };
  const taxonomyPageProps = isAddMode ? {
    ...commonProps,
    isAddMode: true,
    breadcrumbLabel: (0, import_i18n34.__)("Add new"),
    subTitle: (0, import_i18n34.__)(
      "Define a new taxonomy. Fill in the essentials under General; expand Labels to customize."
    ),
    onSaved: (saved) => navigate({
      to: `${TAXONOMIES_PATH}/${saved.id}`
    })
  } : {
    ...commonProps,
    isAddMode: false,
    breadcrumbLabel: title,
    subTitle: (0, import_i18n34.__)(
      "Edit this taxonomy. Expand the Labels section to adjust labels."
    )
  };
  return /* @__PURE__ */ (0, import_jsx_runtime74.jsx)(TaxonomyPage, { ...taxonomyPageProps }, id);
}
function TaxonomyPage({
  isAddMode,
  initialData,
  title,
  breadcrumbLabel,
  subTitle,
  onSaved
}) {
  const [data, setData] = (0, import_element62.useState)(initialData);
  const [isSaving, setIsSaving] = (0, import_element62.useState)(false);
  const originalSlug = !isAddMode ? initialData.slug : void 0;
  const slugField = useSlugField2(originalSlug, data.slug);
  const objectTypeField = useObjectTypeField();
  const fields = (0, import_element62.useMemo)(
    () => [
      // General
      pluralLabelField,
      singularLabelField,
      slugField,
      descriptionField2,
      objectTypeField,
      hierarchicalField2,
      statusField,
      // Visibility
      publicField2,
      showInRestField2,
      publiclyQueryableField,
      showUiField,
      showInMenuField,
      showInQuickEditField,
      showAdminColumnField,
      showInNavMenusField,
      showTagcloudField,
      // Labels
      labelsActionsField2,
      menuNameField2,
      allItemsField2,
      editItemField2,
      viewItemField2,
      updateItemField,
      addNewItemLabelField2,
      newItemNameField,
      searchItemsField2,
      notFoundField2,
      backToItemsField,
      parentItemField,
      popularItemsField,
      separateItemsField,
      parentItemColonField2,
      addOrRemoveItemsField,
      chooseFromMostUsedField,
      // Advanced
      sortField,
      defaultTermEnabledField,
      defaultTermNameField
    ],
    [slugField, objectTypeField]
  );
  const form = (0, import_element62.useMemo)(
    () => ({
      layout: { type: "card", isCollapsible: true },
      fields: [
        {
          id: "general",
          label: (0, import_i18n34.__)("General"),
          description: (0, import_i18n34.__)(
            "Core identity, post types, and activation."
          ),
          layout: {
            type: "card",
            isCollapsible: true,
            isOpened: true
          },
          children: generalFormFields
        },
        {
          id: "visibility",
          label: (0, import_i18n34.__)("Visibility"),
          description: (0, import_i18n34.__)(
            "Where this taxonomy appears: REST API, admin UI, and front-end surfaces."
          ),
          layout: {
            type: "card",
            isCollapsible: true,
            isOpened: false
          },
          children: visibilityFormFields
        },
        {
          id: "labels",
          label: (0, import_i18n34.__)("Labels"),
          layout: {
            type: "card",
            isCollapsible: true,
            isOpened: false
          },
          children: labelsFormFields
        },
        {
          id: "advanced",
          label: (0, import_i18n34.__)("Advanced"),
          layout: {
            type: "card",
            isCollapsible: true,
            isOpened: false
          },
          children: advancedFormFields
        }
      ]
    }),
    []
  );
  const { validity, isValid } = (0, import_dataviews8.useFormValidity)(data, fields, form);
  const formId = (0, import_compose4.useInstanceId)(TaxonomyPage, "taxonomy-form");
  const { saveEntityRecord } = (0, import_data16.useDispatch)(import_core_data17.store);
  const { createSuccessNotice, createErrorNotice } = (0, import_data16.useDispatch)(import_notices9.store);
  const maybeInvalidateCache = useMaybeInvalidateContentTypeCache();
  async function onSave() {
    if (isSaving || !isValid) {
      return;
    }
    setIsSaving(true);
    try {
      const saved = await saveEntityRecord(
        "postType",
        TAXONOMY_ENTITY,
        serializeForSave2(data),
        { throwOnError: true }
      );
      const successMessage = isAddMode ? (0, import_i18n34.sprintf)(
        /* translators: %s: taxonomy plural label. */
        (0, import_i18n34.__)('"%s" taxonomy created.'),
        data.title.raw
      ) : (0, import_i18n34.sprintf)(
        /* translators: %s: taxonomy plural label. */
        (0, import_i18n34.__)('"%s" taxonomy updated.'),
        data.title.raw
      );
      createSuccessNotice(successMessage, { type: "snackbar" });
      maybeInvalidateCache(
        initialData.config.object_type,
        data.config.object_type,
        POST_TYPE_ENTITY
      );
      if (saved?.id !== void 0) {
        onSaved?.({ ...data, id: saved.id });
      }
    } catch (error2) {
      let errorMessage;
      if (error2?.message && error2?.code !== "unknown_error") {
        errorMessage = error2.message;
      } else if (isAddMode) {
        errorMessage = (0, import_i18n34.__)("Failed to create taxonomy.");
      } else {
        errorMessage = (0, import_i18n34.__)("Failed to update taxonomy.");
      }
      createErrorNotice(errorMessage, { type: "snackbar" });
    } finally {
      setIsSaving(false);
    }
  }
  return /* @__PURE__ */ (0, import_jsx_runtime74.jsx)(
    page_default,
    {
      ariaLabel: title,
      breadcrumbs: /* @__PURE__ */ (0, import_jsx_runtime74.jsx)(
        breadcrumbs_default,
        {
          items: [
            { label: (0, import_i18n34.__)("Taxonomies"), to: TAXONOMIES_PATH },
            { label: breadcrumbLabel }
          ]
        }
      ),
      subTitle,
      actions: /* @__PURE__ */ (0, import_jsx_runtime74.jsx)(
        import_components14.Button,
        {
          __next40pxDefaultSize: true,
          variant: "primary",
          size: "compact",
          type: "submit",
          form: formId,
          isBusy: isSaving,
          disabled: isSaving || !isValid,
          accessibleWhenDisabled: true,
          children: isAddMode ? (0, import_i18n34.__)("Create") : (0, import_i18n34.__)("Save")
        }
      ),
      children: /* @__PURE__ */ (0, import_jsx_runtime74.jsx)(
        Stack,
        {
          direction: "column",
          gap: "md",
          className: "taxonomy-form",
          render: /* @__PURE__ */ (0, import_jsx_runtime74.jsx)(
            "form",
            {
              id: formId,
              onSubmit: (event) => {
                event.preventDefault();
                onSave();
              }
            }
          ),
          children: /* @__PURE__ */ (0, import_jsx_runtime74.jsx)(
            import_dataviews8.DataForm,
            {
              data,
              fields,
              form,
              validity,
              onChange: (edits) => setData(
                (prev) => ({
                  ...prev,
                  ...edits
                })
              )
            }
          )
        }
      )
    }
  );
}
export {
  Layout,
  NEW_ID,
  POST_TYPES_PATH,
  POST_TYPE_ENTITY,
  PostTypeEdit,
  PostTypesList,
  TAXONOMIES_PATH,
  TAXONOMY_ENTITY,
  TaxonomiesList,
  TaxonomyEdit
};
/*! Bundled license information:

use-sync-external-store/cjs/use-sync-external-store-shim.development.js:
  (**
   * @license React
   * use-sync-external-store-shim.development.js
   *
   * Copyright (c) Meta Platforms, Inc. and affiliates.
   *
   * This source code is licensed under the MIT license found in the
   * LICENSE file in the root directory of this source tree.
   *)

use-sync-external-store/cjs/use-sync-external-store-shim/with-selector.development.js:
  (**
   * @license React
   * use-sync-external-store-shim/with-selector.development.js
   *
   * Copyright (c) Meta Platforms, Inc. and affiliates.
   *
   * This source code is licensed under the MIT license found in the
   * LICENSE file in the root directory of this source tree.
   *)

tabbable/dist/index.esm.js:
  (*!
  * tabbable 6.4.0
  * @license MIT, https://github.com/focus-trap/tabbable/blob/master/LICENSE
  *)
*/
//# sourceMappingURL=index.js.map
