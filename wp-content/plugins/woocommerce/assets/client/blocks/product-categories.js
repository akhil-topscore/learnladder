(() => {
    var e,
        t,
        o,
        r = {
            614: (e, t, o) => {
                "use strict";
                o.r(t);
                var r = o(1609);
                const a = window.wp.blocks;
                var c = o(7104),
                    l = o(6518);
                o(5614);
                const n = JSON.parse(
                    '{"name":"woocommerce/product-categories","title":"Product Categories List","category":"woocommerce","description":"Show all product categories as a list or dropdown.","keywords":["WooCommerce"],"supports":{"align":["wide","full"],"html":false,"color":{"background":false,"link":true},"typography":{"fontSize":true,"lineHeight":true}},"attributes":{"align":{"type":"string"},"hasCount":{"type":"boolean","default":true},"hasImage":{"type":"boolean","default":false},"hasEmpty":{"type":"boolean","default":false},"isDropdown":{"type":"boolean","default":false},"isHierarchical":{"type":"boolean","default":true},"showChildrenOnly":{"type":"boolean","default":false}},"example":{"attributes":{"hasCount":true,"hasImage":false}},"textdomain":"woocommerce","apiVersion":3,"$schema":"https://schemas.wp.org/trunk/block.json"}'
                );
                o(5456);
                const s = window.wp.blockEditor;
                var i = o(7723);
                const d = window.wp.serverSideRender;
                var p = o.n(d);
                const u = (e) => !((e) => null === e)(e) && e instanceof Object && e.constructor === Object,
                    m = window.wp.data,
                    h = window.wp.components,
                    w = () =>
                        (0, r.createElement)(
                            h.Placeholder,
                            { icon: (0, r.createElement)(c.A, { icon: l.A }), label: (0, i.__)("Product Categories List", "woocommerce"), className: "wc-block-product-categories" },
                            (0, i.__)("This block displays the product categories for your store. To use it you first need to create a product and assign it to a category.", "woocommerce")
                        ),
                    g = ({ attributes: e, setAttributes: t, name: o }) => {
                        const a = (0, m.useSelect)((e) => e("core/edit-site")),
                            c = (0, m.useSelect)((e) => e("core/edit-widgets")),
                            l = ((e) => {
                                if (u(e)) {
                                    const t = e.getEditedPostType();
                                    return "wp_template" === t || "wp_template_part" === t;
                                }
                                return !1;
                            })(a),
                            n = ((e) => {
                                if (u(e)) {
                                    const t = e.getWidgetAreas();
                                    return Array.isArray(t) && t.length > 0;
                                }
                                return !1;
                            })(c),
                            d = (0, s.useBlockProps)({ className: "wc-block-product-categories" });
                        return (0, r.createElement)(
                            "div",
                            { ...d },
                            (() => {
                                const { hasCount: o, hasImage: a, hasEmpty: c, isDropdown: d, isHierarchical: p, showChildrenOnly: u } = e;
                                return (0, r.createElement)(
                                    s.InspectorControls,
                                    { key: "inspector" },
                                    (0, r.createElement)(
                                        h.PanelBody,
                                        { title: (0, i.__)("List Settings", "woocommerce"), initialOpen: !0 },
                                        (0, r.createElement)(
                                            h.__experimentalToggleGroupControl,
                                            { label: (0, i.__)("Display style", "woocommerce"), value: d ? "dropdown" : "list", onChange: (e) => t({ isDropdown: "dropdown" === e }) },
                                            (0, r.createElement)(h.__experimentalToggleGroupControlOption, { value: "list", label: (0, i.__)("List", "woocommerce") }),
                                            (0, r.createElement)(h.__experimentalToggleGroupControlOption, { value: "dropdown", label: (0, i.__)("Dropdown", "woocommerce") })
                                        )
                                    ),
                                    (0, r.createElement)(
                                        h.PanelBody,
                                        { title: (0, i.__)("Content", "woocommerce"), initialOpen: !0 },
                                        (0, r.createElement)(h.ToggleControl, { label: (0, i.__)("Show product count", "woocommerce"), checked: o, onChange: () => t({ hasCount: !o }) }),
                                        !d &&
                                            (0, r.createElement)(h.ToggleControl, {
                                                label: (0, i.__)("Show category images", "woocommerce"),
                                                help: a ? (0, i.__)("Category images are visible.", "woocommerce") : (0, i.__)("Category images are hidden.", "woocommerce"),
                                                checked: a,
                                                onChange: () => t({ hasImage: !a }),
                                            }),
                                        (0, r.createElement)(h.ToggleControl, { label: (0, i.__)("Show hierarchy", "woocommerce"), checked: p, onChange: () => t({ isHierarchical: !p }) }),
                                        (0, r.createElement)(h.ToggleControl, { label: (0, i.__)("Show empty categories", "woocommerce"), checked: c, onChange: () => t({ hasEmpty: !c }) }),
                                        (l || n) &&
                                            (0, r.createElement)(h.ToggleControl, {
                                                label: (0, i.__)("Only show children of current category", "woocommerce"),
                                                help: (0, i.__)("This will affect product category pages", "woocommerce"),
                                                checked: u,
                                                onChange: () => t({ showChildrenOnly: !u }),
                                            })
                                    )
                                );
                            })(),
                            (0, r.createElement)(h.Disabled, null, (0, r.createElement)(p(), { block: o, attributes: e, EmptyResponsePlaceholder: w }))
                        );
                    };
                (0, a.registerBlockType)(n, {
                    icon: { src: (0, r.createElement)(c.A, { icon: l.A, className: "wc-block-editor-components-block-icon" }) },
                    transforms: {
                        from: [
                            {
                                type: "block",
                                blocks: ["core/legacy-widget"],
                                isMatch: ({ idBase: e, instance: t }) => "woocommerce_product_categories" === e && !(null == t || !t.raw),
                                transform: ({ instance: e }) =>
                                    (0, a.createBlock)("woocommerce/product-categories", { hasCount: !!e.raw.count, hasEmpty: !e.raw.hide_empty, isDropdown: !!e.raw.dropdown, isHierarchical: !!e.raw.hierarchical }),
                            },
                        ],
                    },
                    deprecated: [
                        {
                            attributes: {
                                hasCount: { type: "boolean", default: !0, source: "attribute", selector: "div", attribute: "data-has-count" },
                                hasEmpty: { type: "boolean", default: !1, source: "attribute", selector: "div", attribute: "data-has-empty" },
                                isDropdown: { type: "boolean", default: !1, source: "attribute", selector: "div", attribute: "data-is-dropdown" },
                                isHierarchical: { type: "boolean", default: !0, source: "attribute", selector: "div", attribute: "data-is-hierarchical" },
                            },
                            migrate: (e) => e,
                            save(e) {
                                const { hasCount: t, hasEmpty: o, isDropdown: a, isHierarchical: c } = e,
                                    l = {};
                                return (
                                    t && (l["data-has-count"] = !0),
                                    o && (l["data-has-empty"] = !0),
                                    a && (l["data-is-dropdown"] = !0),
                                    c && (l["data-is-hierarchical"] = !0),
                                    (0, r.createElement)(
                                        "div",
                                        { className: "is-loading", ...l },
                                        a
                                            ? (0, r.createElement)("span", { "aria-hidden": !0, className: "wc-block-product-categories__placeholder" })
                                            : (0, r.createElement)(
                                                  "ul",
                                                  { "aria-hidden": !0 },
                                                  (0, r.createElement)("li", null, (0, r.createElement)("span", { className: "wc-block-product-categories__placeholder" })),
                                                  (0, r.createElement)("li", null, (0, r.createElement)("span", { className: "wc-block-product-categories__placeholder" })),
                                                  (0, r.createElement)("li", null, (0, r.createElement)("span", { className: "wc-block-product-categories__placeholder" }))
                                              )
                                    )
                                );
                            },
                        },
                    ],
                    edit: (e) => {
                        const t = (0, s.useBlockProps)();
                        return (0, r.createElement)("div", { ...t }, (0, r.createElement)(g, { ...e }));
                    },
                    save: () => null,
                });
            },
            5614: () => {},
            5456: () => {},
            1609: (e) => {
                "use strict";
                e.exports = window.React;
            },
            6087: (e) => {
                "use strict";
                e.exports = window.wp.element;
            },
            7723: (e) => {
                "use strict";
                e.exports = window.wp.i18n;
            },
            5573: (e) => {
                "use strict";
                e.exports = window.wp.primitives;
            },
        },
        a = {};
    function c(e) {
        var t = a[e];
        if (void 0 !== t) return t.exports;
        var o = (a[e] = { exports: {} });
        return r[e].call(o.exports, o, o.exports, c), o.exports;
    }
    (c.m = r),
        (e = []),
        (c.O = (t, o, r, a) => {
            if (!o) {
                var l = 1 / 0;
                for (d = 0; d < e.length; d++) {
                    for (var [o, r, a] = e[d], n = !0, s = 0; s < o.length; s++) (!1 & a || l >= a) && Object.keys(c.O).every((e) => c.O[e](o[s])) ? o.splice(s--, 1) : ((n = !1), a < l && (l = a));
                    if (n) {
                        e.splice(d--, 1);
                        var i = r();
                        void 0 !== i && (t = i);
                    }
                }
                return t;
            }
            a = a || 0;
            for (var d = e.length; d > 0 && e[d - 1][2] > a; d--) e[d] = e[d - 1];
            e[d] = [o, r, a];
        }),
        (c.n = (e) => {
            var t = e && e.__esModule ? () => e.default : () => e;
            return c.d(t, { a: t }), t;
        }),
        (o = Object.getPrototypeOf ? (e) => Object.getPrototypeOf(e) : (e) => e.__proto__),
        (c.t = function (e, r) {
            if ((1 & r && (e = this(e)), 8 & r)) return e;
            if ("object" == typeof e && e) {
                if (4 & r && e.__esModule) return e;
                if (16 & r && "function" == typeof e.then) return e;
            }
            var a = Object.create(null);
            c.r(a);
            var l = {};
            t = t || [null, o({}), o([]), o(o)];
            for (var n = 2 & r && e; "object" == typeof n && !~t.indexOf(n); n = o(n)) Object.getOwnPropertyNames(n).forEach((t) => (l[t] = () => e[t]));
            return (l.default = () => e), c.d(a, l), a;
        }),
        (c.d = (e, t) => {
            for (var o in t) c.o(t, o) && !c.o(e, o) && Object.defineProperty(e, o, { enumerable: !0, get: t[o] });
        }),
        (c.o = (e, t) => Object.prototype.hasOwnProperty.call(e, t)),
        (c.r = (e) => {
            "undefined" != typeof Symbol && Symbol.toStringTag && Object.defineProperty(e, Symbol.toStringTag, { value: "Module" }), Object.defineProperty(e, "__esModule", { value: !0 });
        }),
        (c.j = 2845),
        (() => {
            var e = { 2845: 0 };
            c.O.j = (t) => 0 === e[t];
            var t = (t, o) => {
                    var r,
                        a,
                        [l, n, s] = o,
                        i = 0;
                    if (l.some((t) => 0 !== e[t])) {
                        for (r in n) c.o(n, r) && (c.m[r] = n[r]);
                        if (s) var d = s(c);
                    }
                    for (t && t(o); i < l.length; i++) (a = l[i]), c.o(e, a) && e[a] && e[a][0](), (e[a] = 0);
                    return c.O(d);
                },
                o = (self.webpackChunkwebpackWcBlocksMainJsonp = self.webpackChunkwebpackWcBlocksMainJsonp || []);
            o.forEach(t.bind(null, 0)), (o.push = t.bind(null, o.push.bind(o)));
        })();
    var l = c.O(void 0, [94], () => c(614));
    (l = c.O(l)), (((this.wc = this.wc || {}).blocks = this.wc.blocks || {})["product-categories"] = l);
})();
