/**
 * Make of language slugs to prism slugs.
 *
 * @todo extract to JSON file for reuse.
 *
 * @type {Object}
 */
const map = {
    'js': 'javascript',
    'sass': 'scss',
    'py': 'python',
    'html': 'markup',
    'xml': 'markup',
};

/**
 * Map a language slug to its prism slug.
 *
 * @param {string} slug - Language slug.
 * @returns {string} Prism slug.
 */
module.exports = function prismSlug(slug) {
    return map[slug] || slug;

};
