/**
 * Pimcore
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.pimcore.org/license
 *
 * @copyright  Copyright (c) 2009-2010 elements.at New Media Solutions GmbH (http://www.elements.at)
 * @license    http://www.pimcore.org/license     New BSD License
 */

pimcore.registerNS("pimcore");

pimcore.event = Ext.extend(Ext.util.Observable, {});

/**
 * All Events
 */

pimcore.event.pimcore = {
    'layout': {
        'toolbar': {
            /**
             * @param Ext.Toolbar
             * @see layout/toolbar
             */
            'render': 'pimcore.layout.toolbar.render'
        }
    },
    'document': {
        'page': {
            /**
             * @param pimcore.document.page
             * @see pimcore.document.page
             */
            'open': 'pimcore.document.page.open'
        },
        'email' : {
            /**
             * @param pimcore.document.email
             * @see pimcore.document.email
             */
            'open': 'pimcore.document.email.open'
        },
        'folder' : {
            /**
             * @param pimcore.document.folder
             * @see pimcore.document.folder
             */
            'open': 'pimcore.document.folder.open'
        },
        'hardlink' : {
            /**
             * @param pimcore.document.hardlink
             * @see pimcore.document.hardlink
             */
            'open': 'pimcore.document.hardlink.open'
        },
        'link' : {
            /**
             * @param pimcore.document.link
             * @see pimcore.document.link
             */
            'open': 'pimcore.document.link.open'
        },
        'snippet' : {
            /**
             * @param pimcore.document.snippet
             * @see pimcore.document.snippet
             */
            'open': 'pimcore.document.link.open'
        },
        'tree': {
            /**
             * @param Ext.tree.TreePanel
             * @see document/tree
             */
            'render': 'pimcore.document.tree.render',
                'node': {
                'contextMenu' : {
                    /**
                     * @param Ext.tree.TreePanel
                     * @see document/tree
                     */
                    'render': 'pimcore.document.tree.node.contextMenu.render'
                }
            }
        }
    },
    'asset': {
        'tree': {
            'node': {
                'contextMenu' : {
                    /**
                     * @param Ext.tree.TreePanel
                     * @see document/tree
                     */
                    'render': 'pimcore.asset.tree.node.contextMenu.render'
                }
            }
        }
    },
    'object': {
        'tree': {
            'node': {
                'contextMenu' : {
                    /**
                     * @param Ext.tree.TreePanel
                     * @see document/tree
                     */
                    'render': 'pimcore.object.tree.node.contextMenu.render'
                }
            }
        }
    }
}