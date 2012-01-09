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
        document: {
            open : 'pimcore.document.document.open'
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

// All Pimcore Core Events

/**
 * @param Ext.Toolbar
 * @see layout/toolbar
 */
pimcore.event.pimcoreLayoutToolbarRender = 'pimcoreLayoutToolbarRender';

/**
 * @param Ext.tree.TreePanel
 * @see document/tree
 */
pimcore.event.pimcoreDocumentTreeRender = 'pimcoreDocumentTreeRender';

/**
 * @param Ext.menu.Menu
 * @param int DocumentId
 * @see document/tree
 */
pimcore.event.pimcoreDocumentTreeContextMenuRender = 'pimcoreDocumentTreeContextMenuRender';


/**
 * @param Ext.menu.Menu
 * @param int DocumentId
 * @see asset/tree
 */
pimcore.event.pimcoreAssetTreeContextMenuRender = 'pimcoreAssetTreeContextMenuRender'


/**
 * @param Ext.menu.Menu
 * @param int DocumentId
 * @see object/tree
 */
pimcore.event.pimcoreObjectTreeContextMenuRender = 'pimcoreObjectTreeContextMenuRender';


pimcore.event.pimcoreDocumentPreOpen = "pimcoreDocumentPreOpen";