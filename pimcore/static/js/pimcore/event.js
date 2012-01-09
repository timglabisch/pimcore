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

pimcore.event = Ext.extend(Ext.util.Observable, {


});

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