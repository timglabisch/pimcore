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
            'open': 'pimcore.document.page.open',
            'tabPanel': {
                /**
                 * @param Ext.TabPanel
                 * @see pimcore.document.page
                 */
                'render': 'pimcore.document.page.tabPanel.render'
            }
        },
        'email' : {
            /**
             * @param pimcore.document.email
             * @see pimcore.document.email
             */
            'open': 'pimcore.document.email.open',
            'tabPanel': {
                /**
                 * @param Ext.TabPanel
                 * @see pimcore.document.email
                 */
                'render': 'pimcore.document.email.tabPanel.render'
            }
        },
        'folder' : {
            /**
             * @param pimcore.document.folder
             * @see pimcore.document.folder
             */
            'open': 'pimcore.document.folder.open',
            'tabPanel': {
                /**
                 * @param Ext.TabPanel
                 * @see pimcore.document.folder
                 */
                'render': 'pimcore.document.folder.tabPanel.render'
            }
        },
        'hardlink' : {
            /**
             * @param pimcore.document.hardlink
             * @see pimcore.document.hardlink
             */
            'open': 'pimcore.document.hardlink.open',
            'tabPanel': {
                /**
                 * @param Ext.TabPanel
                 * @see pimcore.document.hardlink
                 */
                'render': 'pimcore.document.hardlink.tabPanel.render'
            }
        },
        'link' : {
            /**
             * @param pimcore.document.link
             * @see pimcore.document.link
             */
            'open': 'pimcore.document.link.open',
            'tabPanel': {
                /**
                 * @param Ext.TabPanel
                 * @see pimcore.document.link
                 */
                'render': 'pimcore.document.link.tabPanel.render'
            }
        },
        'snippet' : {
            /**
             * @param pimcore.document.snippet
             * @see pimcore.document.snippet
             */
            'open': 'pimcore.document.snippet.open',
            'tabPanel': {
                /**
                 * @param Ext.TabPanel
                 * @see pimcore.document.snippet
                 */
                'render': 'pimcore.document.snippet.tabPanel.render'
            }
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
        'document': {
            /**
             * @param pimcore.asset.document
             * @see pimcore.asset.document
             */
            'open': 'pimcore.asset.document.open'
        },
        'folder': {
            /**
             * @param pimcore.asset.folder
             * @see pimcore.asset.folder
             */
            'open': 'pimcore.asset.folder.open'
        },
        'image': {
            /**
             * @param pimcore.asset.image
             * @see pimcore.asset.image
             */
            'open': 'pimcore.asset.image.open'
        },
        'text': {
            /**
             * @param pimcore.asset.text
             * @see pimcore.asset.text
             */
            'open': 'pimcore.asset.text.open'
        },
        'video': {
            /**
             * @param pimcore.asset.video
             * @see pimcore.asset.video
             */
            'open': 'pimcore.asset.video.open'
        },
        'unknown': {
            /**
             * @param pimcore.asset.unknown
             * @see pimcore.asset.unknown
             */
            'open': 'pimcore.asset.unknown.open'
        },
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