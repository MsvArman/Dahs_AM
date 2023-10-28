/*! ColReorder 1.1.3
 * ©2010-2014 SpryMedia Ltd - datatables.net/license
 */

/**
 * @summary     ColReorder
 * @description Provide the ability to reorder columns in a DataTable
 * @version     1.1.3
 * @file        dataTables.colReorder.js
 * @author      SpryMedia Ltd (www.sprymedia.co.uk)
 * @contact     www.sprymedia.co.uk/contact
 * @copyright   Copyright 2010-2014 SpryMedia Ltd.
 *
 * This source file is free software, available under the following license:
 *   MIT license - http://datatables.net/license/mit
 *
 * This source file is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY
 * or FITNESS FOR A PARTICULAR PURPOSE. See the license files for details.
 *
 * For details please refer to: http://www.datatables.net
 */

(function(window, document, undefined) {


/**
 * Switch the key value pairing of an index array to be value key (i.e. the old value is now the
 * key). For example consider [ 2, 0, 1 ] this would be returned as [ 1, 2, 0 ].
 *  @method  fnInvertKeyValues
 *  @param   array aIn Array to switch around
 *  @returns array
 */
function fnInvertKeyValues( aIn )
{
	var aRet=[];
	for ( var i=0, iLen=aIn.length ; i<iLen ; i++ )
	{
		aRet[ aIn[i] ] = i;
	}
	return aRet;
}


/**
 * Modify an array by switching the position of two elements
 *  @method  fnArraySwitch
 *  @param   array aArray Array to consider, will be modified by reference (i.e. no return)
 *  @param   int iFrom From point
 *  @param   int iTo Insert point
 *  @returns void
 */
function fnArraySwitch( aArray, iFrom, iTo )
{
	var mStore = aArray.splice( iFrom, 1 )[0];
	aArray.splice( iTo, 0, mStore );
}


/**
 * Switch the positions of nodes in a parent node (note this is specifically designed for
 * table rows). Note this function considers all element nodes under the parent!
 *  @method  fnDomSwitch
 *  @param   string sTag Tag to consider
 *  @param   int iFrom Element to move
 *  @param   int Point to element the element to (before this point), can be null for append
 *  @returns void
 */
function fnDomSwitch( nParent, iFrom, iTo )
{
	var anTags = [];
	for ( var i=0, iLen=nParent.childNodes.length ; i<iLen ; i++ )
	{
		if ( nParent.childNodes[i].nodeType == 1 )
		{
			anTags.push( nParent.childNodes[i] );
		}
	}
	var nStore = anTags[ iFrom ];

	if ( iTo !== null )
	{
		nParent.insertBefore( nStore, anTags[iTo] );
	}
	else
	{
		nParent.appendChild( nStore );
	}
}



var factory = function( $, DataTable ) {
"use strict";

/**
 * Plug-in for DataTables which will reorder the internal column structure by taking the column
 * from one position (iFrom) and insert it into a given point (iTo).
 *  @method  $.fn.dataTableExt.oApi.fnColReorder
 *  @param   object oSettings DataTables settings object - automatically added by DataTables!
 *  @param   int iFrom Take the column to be repositioned from this point
 *  @param   int iTo and insert it into this point
 *  @returns void
 */
$.fn.dataTableExt.oApi.fnColReorder = function ( oSettings, iFrom, iTo )
{
	var v110 = $.fn.dataTable.Api ? true : false;
	var i, iLen, j, jLen, iCols=oSettings.aoColumns.length, nTrs, oCol;
	var attrMap = function ( obj, prop, mapping ) {
		if ( ! obj[ prop ] ) {
			return;
		}

		var a = obj[ prop ].split('.');
		var num = a.shift();

		if ( isNaN( num*1 ) ) {
			return;
		}

		obj[ prop ] = mapping[ num*1 ]+'.'+a.join('.');
	};

	/* Sanity check in the input */
	if ( iFrom == iTo )
	{
		/* Pointless reorder */
		return;
	}

	if ( iFrom < 0 || iFrom >= iCols )
	{
		this.oApi._fnLog( oSettings, 1, "ColReorder 'from' index is out of bounds: "+iFrom );
		return;
	}

	if ( iTo < 0 || iTo >= iCols )
	{
		this.oApi._fnLog( oSettings, 1, "ColReorder 'to' index is out of bounds: "+iTo );
		return;
	}

	/*
	 * Calculate the new column array index, so we have a mapping between the old and new
	 */
	var aiMapping = [];
	for ( i=0, iLen=iCols ; i<iLen ; i++ )
	{
		aiMapping[i] = i;
	}
	fnArraySwitch( aiMapping, iFrom, iTo );
	var aiInvertMapping = fnInvertKeyValues( aiMapping );


	/*
	 * Convert all internal indexing to the new column order indexes
	 */
	/* Sorting */
	for ( i=0, iLen=oSettings.aaSorting.length ; i<iLen ; i++ )
	{
		oSettings.aaSorting[i][0] = aiInvertMapping[ oSettings.aaSorting[i][0] ];
	}

	/* Fixed sorting */
	if ( oSettings.aaSortingFixed !== null )
	{
		for ( i=0, iLen=oSettings.aaSortingFixed.length ; i<iLen ; i++ )
		{
			oSettings.aaSortingFixed[i][0] = aiInvertMapping[ oSettings.aaSortingFixed[i][0] ];
		}
	}

	/* Data column sorting (the column which the sort for a given column should take place on) */
	for ( i=0, iLen=iCols ; i<iLen ; i++ )
	{
		oCol = oSettings.aoColumns[i];
		for ( j=0, jLen=oCol.aDataSort.length ; j<jLen ; j++ )
		{
			oCol.aDataSort[j] = aiInvertMapping[ oCol.aDataSort[j] ];
		}

		// Update the column indexes
		if ( v110 ) {
			oCol.idx = aiInvertMapping[ oCol.idx ];
		}
	}

	if ( v110 ) {
		// Update 1.10 optimised sort class removal variable
		$.each( oSettings.aLastSort, function (i, val) {
			oSettings.aLastSort[i].src = aiInvertMapping[ val.src ];
		} );
	}

	/* Update the Get and Set functions for each column */
	for ( i=0, iLen=iCols ; i<iLen ; i++ )
	{
		oCol = oSettings.aoColumns[i];

		if ( typeof oCol.mData == 'number' ) {
			oCol.mData = aiInvertMapping[ oCol.mData ];

			// regenerate the get / set functions
			oSettings.oApi._fnColumnOptions( oSettings, i, {} );
		}
		else if ( $.isPlainObject( oCol.mData ) ) {
			// HTML5 data sourced
			attrMap( oCol.mData, '_',      aiInvertMapping );
			attrMap( oCol.mData, 'filter', aiInvertMapping );
			attrMap( oCol.mData, 'sort',   aiInvertMapping );
			attrMap( oCol.mData, 'type',   aiInvertMapping );

			// regenerate the get / set functions
			oSettings.oApi._fnColumnOptions( oSettings, i, {} );
		}
	}


	/*
	 * Move the DOM elements
	 */
	if ( oSettings.aoColumns[iFrom].bVisible )
	{
		/* Calculate the current visible index and the point to insert the node before. The insert
		 * before needs to take into account that there might not be an element to insert before,
		 * in which case it will be null, and an appendChild should be used
		 */
		var iVisibleIndex = this.oApi._fnColumnIndexToVisible( oSettings, iFrom );
		var iInsertBeforeIndex = null;

		i = iTo < iFrom ? iTo : iTo + 1;
		while ( iInsertBeforeIndex === null && i < iCols )
		{
			iInsertBeforeIndex = this.oApi._fnColumnIndexToVisible( oSettings, i );
			i++;
		}

		/* Header */
		nTrs = oSettings.nTHead.getElementsByTagName('tr');
		for ( i=0, iLen=nTrs.length ; i<iLen ; i++ )
		{
			fnDomSwitch( nTrs[i], iVisibleIndex, iInsertBeforeIndex );
		}

		/* Footer */
		if ( oSettings.nTFoot !== null )
		{
			nTrs = oSettings.nTFoot.getElementsByTagName('tr');
			for ( i=0, iLen=nTrs.length ; i<iLen ; i++ )
			{
				fnDomSwitch( nTrs[i], iVisibleIndex, iInsertBeforeIndex );
			}
		}

		/* Body */
		for ( i=0, iLen=oSettings.aoData.length ; i<iLen ; i++ )
		{
			if ( oSettings.aoData[i].nTr !== null )
			{
				fnDomSwitch( oSettings.aoData[i].nTr, iVisibleIndex, iInsertBeforeIndex );
			}
		}
	}

	/*
	 * Move the internal array elements
	 */
	/* Columns */
	fnArraySwitch( oSettings.aoColumns, iFrom, iTo );

	/* Search columns */
	fnArraySwitch( oSettings.aoPreSearchCols, iFrom, iTo );

	/* Array array - internal data anodes cache */
	for ( i=0, iLen=oSettings.aoData.length ; i<iLen ; i++ )
	{
		var data = oSettings.aoData[i];

		if ( v110 ) {
			// DataTables 1.10+
			if ( data.anCells ) {
				fnArraySwitch( data.anCells, iFrom, iTo );
			}

			// For DOM sourced data, the invalidate will reread the cell into
			// the data array, but for data sources as an array, they need to
			// be flipped
			if ( data.src !== 'dom' && $.isArray( data._aData ) ) {
				fnArraySwitch( data._aData, iFrom, iTo );
			}
		}
		else {
			// DataTables 1.9-
			if ( $.isArray( data._aData ) ) {
				fnArraySwitch( data._aData, iFrom, iTo );
			}
			fnArraySwitch( data._anHidden, iFrom, iTo );
		}
	}

	/* Reposition the header elements in the header layout array */
	for ( i=0, iLen=oSettings.aoHeader.length ; i<iLen ; i++ )
	{
		fnArraySwitch( oSettings.aoHeader[i], iFrom, iTo );
	}

	if ( oSettings.aoFooter !== null )
	{
		for ( i=0, iLen=oSettings.aoFooter.length ; i<iLen ; i++ )
		{
			fnArraySwitch( oSettings.aoFooter[i], iFrom, iTo );
		}
	}

	// In 1.10 we need to invalidate row cached data for sorting, filtering etc
	if ( v110 ) {
		var api = new $.fn.dataTable.Api( oSettings );
		api.rows().invalidate();
	}

	/*
	 * Update DataTables' event handlers
	 */

	/* Sort listener */
	for ( i=0, iLen=iCols ; i<iLen ; i++ )
	{
		$(oSettings.aoColumns[i].nTh).off('click.DT');
		this.oApi._fnSortAttachListener( oSettings, oSettings.aoColumns[i].nTh, i );
	}


	/* Fire an event so other plug-ins can update */
	$(oSettings.oInstance).trigger( 'column-reorder', [ oSettings, {
		"iFrom": iFrom,
		"iTo": iTo,
		"aiInvertMapping": aiInvertMapping
	} ] );
};


/**
 * ColReorder provides column visibility control for DataTables
 * @class ColReorder
 * @constructor
 * @param {object} dt DataTables settings object
 * @param {object} opts ColReorder options
 */
var ColReorder = function( dt, opts )
{
	var oDTSettings;

	if ( $.fn.dataTable.Api ) {
		oDTSettings = new $.fn.dataTable.Api( dt ).settings()[0];
	}
	// 1.9 compatibility
	else if ( dt.fnSettings ) {
		// DataTables object, convert to the settings object
		oDTSettings = dt.fnSettings();
	}
	else if ( typeof dt === 'string' ) {
		// jQuery selector
		if ( $.fn.dataTable.fnIsDataTable( $(dt)[0] ) ) {
			oDTSettings = $(dt).eq(0).dataTable().fnSettings();
		}
	}
	else if ( dt.nodeName && dt.nodeName.toLowerCase() === 'table' ) {
		// Table node
		if ( $.fn.dataTable.fnIsDataTable( dt.nodeName ) ) {
			oDTSettings = $(dt.nodeName).dataTable().fnSettings();
		}
	}
	else if ( dt instanceof jQuery ) {
		// jQuery object
		if ( $.fn.dataTable.fnIsDataTable( dt[0] ) ) {
			oDTSettings = dt.eq(0).dataTable().fnSettings();
		}
	}
	else {
		// DataTables settings object
		oDTSettings = dt;
	}

	// Ensure that we can't initialise on the same table twice
	if ( oDTSettings._colReorder ) {
		throw "ColReorder already initialised on table #"+oDTSettings.nTable.id;
	}

	// Convert from camelCase to Hungarian, just as DataTables does
	var camelToHungarian = $.fn.dataTable.camelToHungarian;
	if ( camelToHungarian ) {
		camelToHungarian( ColReorder.defaults, ColReorder.defaults, true );
		camelToHungarian( ColReorder.defaults, opts || {} );
	}


	/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * Public class variables
	 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */

	/**
	 * @namespace Settings object which contains customisable information for ColReorder instance
	 */
	this.s = {
		/**
		 * DataTables settings object
		 Sanit({
	.s *
		 * DataTabl(s settings object
		 San"nIsDa.s 	.stance
	 */
	the same t[* *);

ai */dSan"si, i* Pi/i object which * * * * * * * * l(s setti i, i* Pi/i objectect whic' && $.isArray( file is distrirtMafnSdobjectecIngarian( ColReorder.default)	 */
	the sameNta ==x is Search melfixent n Conowe column n( Coed) * * * * * * * * fSortsetti i, i* Pi/i intect whic' && $.is0ray( file fSortist0	 */
	the sameNta ==x is Search melfixe into, fiConvet   Cont n Conowe column n( Coed) * * * * * * * * fSortR   Csetti i, i* Pi/i intect whic' && $.is0ray( file fSortR   Cist0	 */
	the sameCConbackeorder =  Pi/ioy reliseintless hn, bing donh * * * * * * * * intlessCConbacksetti i, i* Pi/i order = settings object
		 San"nIsDa.s intlessCConbackstance
	 */
	the same/**
	 * @naIisable info, i* Pi/i o, wile )dragn"nIsDa.s wile ":t[0] )" whrtX":t-1,0] )" whrtY":t-1,0] )"offaTaX":t-1,0] )"offaTaY":t-1,0] )"whrget":t-1,0] )"whrgetrtBef":t-1,0] )"ConvrtBef":t-1ting	 */
	the sameIisable info objeciso, i* Pi/i

	/* Ree by takment toonte sond knthe fowt tha codonvere samement t. );

	/of objectsARRANy tak * * * ies:setting x: x-axisi

	/* Resetting e rement tnto thi* * * * * * * * aoThrgetssetti i, i* Pi/i  layosettings object
	[]n"nIsDa.s aoThrgets":	[]n"};
* * * */

	/**
	 * @naCommonsond will bMove the DOM  Pi/i o,  PubliReorder instance
	 *dom
	this.s = {
		/*ragge fot be an sorti * f o, wile )isimordng) * * * * * * * * dragn"nIs i, i* Pi/i t be ansettings object
		 San"nIsDa.s dragstance
	 */
	the sameTtakment toonrsor * * * * * * * * to thern"nIs i, i* Pi/i t be ansettings object
		 San"nIsDa.s to therstance
n"};
* * * Cer
 * @con logicstance
	 */. typ)
{
	var oDTSece
	 */. tSettings._colreIndeSece
	 *is.oAr
 * @c(om, iTo )ddificlity cConbackstanc
{
	var oDTx = this.oConbackReg(
{
	var oDT, 'aoDiclityoConback-re$. * xy(e
	 *is.Diclity,eInde), 'garian( Co'om, iTo );
eIndeSe};
* 
garian( Co. * to i* P	this;
	}


	/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 *).
 * variables
	 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */

	Ree ge Update then( Coal indexingot  i - in( Coal inEnsurn, detectnitia*/

	 whrt up.
ttingsTo );
e{Inde} Rt
 *  @`Inde` Pi/ichichs.aa
tti
ttingsy). For
tting  lse {
		// Datit[* *);

ai */RRANygarian( Co
tting  s doised oetti'#y). For' dt.eq(0).da {
tting      "sD{
		"'Rlf* ip'
tting  pts || *
tting  lse)ddih).of Fire art itbuttohe coree ge Updn( Coal 
tting  ti'#ree gO( Coal ' dh).of(astSort, fue) {
tting      e. *Fire Dobject();
tting      arian = $.fn.dagarian( Co(oised otaTaRee g();
tting  pts || *anc"TaRee g":astSort, fun ; i++ )
	aiMappings = [];
	for ( var i=e
	 */. tSettings.aaoFooter.length ; i<iLen ; i++ )a		anTage
	 */. tSettings.aoCol_garian( Co_iOt  )
	{reIndex );e
	 *is.O( Cotings.a( atMappinTo );
eIndeSeng	 */ * */

	`De *Fcatni` -date lculate the ts ColRfe Update ths, sources as .
ttingsTo );
e{s as } );

	/of ate the dthel bet handngs o *Fcatni `s.O( Co`endChild shouldelempfied by rert it in).
 * .
tting    `s.O( Co`eactsAsourrateher/steher.|| *anc"TaateCte theO( Co":astSort, fun ; i++To );
eInde.s.O( Co()Seng	 */ * */

	ate lculate the ts ColRfe Update ths, sources as .e rows).count  the o handnt for lementsparam  ravaiiquee dthel bet unctions for eac. Cte thelyhandnentse  ravxingot  i - in( Coal iRfe Update thsinEnsurn, detectnitia*/

	 whrt upta arrit incChildprown* *)l/* Sangakme fumn s.
ttingsTo );
e{s as } );

	/of ate the dthel bet hand
ttingsy). For
tting  lseate ate then( Coal iPi/i o, ised 
tting  s dos._colrearian = $.fn.dagarian( Co(o = $.fn.d ).s.O( Co()Sen *a * */

	Ste lcults ColRfe Update ths, Conv* Switch the po dthel bestribute*/

	n( Coal is as nt for.e rows).cougarian( ConeedsourrbrutundeThisap * ns */

	ability tofor ssoich isi

	rrent mectiFor lity tofor Fire svalidaocate*/

	ent to (be li - in( Co isistehlestupon.
ttingsect
 * s as } [ste] );

	/of ate the dthel bet tributettingn( Co.e row
tting  ).couFirry ate themariabakmecluded,vaiiquelh( a
eIndeis as .
ttingsTo );
e{Inde} Rt
 *  @`Inde` Pi/ichichs.aa
tti
ttingsy). For
tting  lseSwap (be lirse the seconddate ths
tting  arian = $.fn.dagarian( Co(o = $.fn.d ).s.O( Co( [1ice( 2, 3, 4]tMaptti
ttingsy). For
tting  lse	/*
	 * Mlirse ake the co * MendiPi/i o, ised  `#y). For`
tting  s doate lrearian = $.fn.dagarian( Co(o'#y). For' ).s.O( Co()Sen *ng  s dolirse =oate  num = a.sn *ng  ate  	anTaglirse a.sn *ng  arian = $.fn.dagarian( Co(o'#y). For' ).s.O( Co( ate tMaptti
ttingsy). For
tting  lseRFirrsei o, ised 'sgn( Cosn *ng  arian = $.fn.dagarian( Co(o'#y). For' ).s.O( Co(
tting    arian = $.fn.dagarian( Co(o'#y). For' ).s.O( Co().rFirrse()
tting  s || *anc"TaO( Co":astSort, fuisteen ; i++ )
	{steerCascument, uen ; i++ ) )
	aiMappingss = [];
	for ( var i=e
	 */. tSettings.aaoFooter.length ; i<iLen ;  i++ ))a		anTage
	 */. tSettings.aoCol_garian( Co_iOt  )
	{reIndTo );
 i;
	}
	eIndex );e
	 *is.O( Cotings.a( pping = fnInvertKeysteentMappinTo );
eIndeSeng	 *is;
	}


	/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *riv can).
 * v sortm  ravof aturseip *
	 *a
eJSta arr*Fcommende retupriv ca)
ttinles
	 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */

	Cer
 * @con logic
	 (iTo).
 *  @is.oAr
 * @c
	s point
 *  @retur	s poipriv ca|| *anc"is.oAr
 * @c":astSort, fun ; i++ )
	).coureIndeSec+ )
	gth ;= e
	 */. tSettings.aaoFooteSec+ )
	g;ppins
	 */
	/* dis intopositionlity tofor -e into, filef art t   Co Footer */e
	 */.it[*.iaSort */
	/* n ; i++ )e
	 */.fSort =/e
	 */.it[*.iaSort */
	/*eIndex );s
	 */
	/* dis intopositionlity tofor -e into, fit   Cotoilef a Foote
	 */.fSortR   C =/e
	 */.it[*.iaSort */
	/*R   C ?++ )e
	 */.it[*.iaSort */
	/*R   C :set	0;ppins
	D		obcConbacksit[* *);

ai */Reordeo Footer */e
	 */.it[*.TaRetlessCConback n ; i++ )e
	 */.intlessCConback =/e
	 */.it[*.TaRetlessCConbackeIndex );s
	)ddiTables' event iPi/i o, drag the d( obje nullsoimarkvxingot  i - iate then( Co	/* Body */
	 =/0; null th  i<iLen ; i++ )
		{
i > e
	 */.fSort-1=== null th ;- e
	 */.fSortR   C n ;  i++ ))e
	 *is.Mile rtAttachLii,ge
	 */. tSettings.aoColnThrom, iTo );
		* Markvxingot  i - iate then( Co	dy */* Crified by re/* Bo	e
	 */. tSettings.aoCol_garian( Co_iOt  )
	{ping[idex );s
	St cansardnga Foote
	 */.dtx = this.oConbackReg(ge
	 */. t, 'aoSt caSavePct
 s'LastSort, fuoStattingdt[0] )).cohis.St caSave.cCon(	).cotatting{reIndetings, 1, "Co_St ca"{reI );s
	)nsit[* *)iate then( Co	hn, bing this ised used
		 *aiO( CooreIndex oter */e
	 */.it[*.aiO( Coon ; i++ )aiO( Cooree
	 */.it[*.aiO( Co.sArray)g[idex );s
	St canloadfor sog =rder p Update then( Cont foro Footer */e
	 */.dtx LoadedSt can&&lse if (e
	 */.dtx LoadedSt caagarian( Co != 'cument, u!== n"nI(e
	 */.dtx LoadedSt caagarian( CoaoFooter== e
	 */. tSettings.aaoFooteon ; i++ )aiO( Cooree
	 */.dtx LoadedSt caagarian( Cog[idex );s
	Ifndex, so when( Conrt ipplray dossoi Footer */aiO( Coon ; i++ )s
	What therbebcConrow uoal iR *aftll reor {
		// Datit[* *);

ai *.	Ifn insert reon In 1.10++ )

	abiwach nto,li o, drawrce fonrt if*aftllt reon dosw.couIn 1.10 we dt t   CoawyosetnIsDa.sng ) {
).co*/. tSeb t[*Co Forte n ;  i++ ))		 *bD * f=? true : Bo	e
	 */. tSetDrawoConback		anTagi++ ))c"Ta":astSort, fungi++ ))cng ) {
).co*/. tSeb t[*Co Forte &&l!bD * f)++ ))cni++ ))cn	bD * f=?obje;++ ))cn			 *reata tMapping = fnInvertKeyVaO( Coon;++ ))cn	).co*is.O( Cotings.a.cCon(	).cotareata tn;++ ))cn}++ ))c},++ ))c"s(dt.":ings, 1, "Co_Pre"++ ))}{reIndTo );
		}
 ;  i++ ))		 *reata tMapping = fnInvertKeyVaO( Coon;++ ))).co*is.O( Cotings.a.cCon(	).cotareata tn;++ )o );
			}
		}
		ele
	 *is.SteoApi._fnColenSettings(),
* * * */

	S ge Update then( Cositionrces as 
	 (iTo).
 *  @is.O( Cotings.a
	ySwitch
 *  @param  	)nsa;

	/of  thegnt i objecdict		// Update then( Conr.coundChild shipplied
	s point
 *  @retur	s poipriv ca|| *anc"is.O( Cotings.a":astSort, fuiaen ; i++ )
	{gs.aoData!= e
	 */. tSettings.aaoFooteon ; i++ )e
	 */. tSettings.o{
		this.oApi.e
	 */. tSettings, 1, "Col-sa;

	/intlesstaTabre mi"les 1	"ma*
 *knthn nta ==x is Search. SkiInver."tn;++ ) ) {
			return;et=[];
	for ( var i=0aoFooter.length ; i<iLen ; i++ )s doate rtBefore$.it);

	Lii,gg{reInd)
		{
i !=oate rtBefon ;  i++ ))	}
	}ts ColRurarray by sw layout ar+ )
		{
			fnArraya,oate rtBefs[i].nT++ ))	}
Do/ Update theintlesstini o, ised  t ar+ )e
	 */. tSettings.o{xt.oApi.fnCo(oate rtBefs[i].nTndex );
			}
		Weon scrolly swIn 1.10 we *Fca
		/* Calculate thesizeh melConowePi/i o, num =o Footer */e
	 */.dtx Scroll.sXaoFoo""ts, e
	 */.dtx Scroll.sYaoFoo""tn ; i++ )e
	 */. tSettings.o{
		dgaritings.Sizy s(? trueoreIndex );
		Savei o, nt can upd)e
	 */. tSettings.o{
		this.SaveSt ca*/e
	 */.dt].nT++ e
	 *is.SteoApi._fnColenSettinooter */e
	 */.intlessCConback .nTFoot !== null )e
	 */.intlessCConback.cCon(	).is ettings(),
* * * */

	BFcale )we* Sangak takmeColenx is Searchtini o, ised tare/* ivrert iteir	 whrty swto th*/

	In 1.10 we *Ftlessi o, nt can Search melw.couortm  ravcouort	 whrty swto thy indexcaa*/

	reon re layngak taonrgainion st canload!
	 (iTo).
 *  @is.St caSave
	Reorder
 *  @param   ot
	 * Update Da st ca
	s point
 *  @param  JSON by ode rcookie@param  control for Dat	s poipriv ca|| *anc"is.St caSave":astSort, fui ot
	 *n ; i++false;
	var iarigh, iOt  )
	arcSec+ )
	oct
		oDTSete
	 */.dtSec+ )
	 Search 
		oCol = oSettings.anT++ oSt caagarian( CoiMappin );
		S Fixed sortter */oSt caaettings.af ( v110 ) 
	//.0bles ner */
	fr.lenoSt caaettings.aaoFooter.leiLengi++ ))oSt caaettings.aingFixed[ Search[ oSt caaettings.aingFixeol_garian( Co_iOt  )
	m, iTo );
			 *ags.aoPrepy =trirtMafnSdobject[], oSt caaeogs.aoPreSe].nT++ ener */
	for ( i=cings.aaoFooter.length ; i<iLen ;  i++ ))iOt  )
	arced[ Search[iol_garian( Co_iOt  )
	m,++ ))	}
)
	arceorting t ar+ )oSt caaeogs.aoPreSe[ iOt  )
	arcbj[ pags.aoPrepys.aoData))	}
Vcolumn vist ar+ )oSt caae[iFrreSe[ iOt  )
	arcbj[ p Search[iol[iFrom].m,++ ))	}
)
	arcelity tofor t ar+ )oSt caagarian( Co		anTagiOt  )
	arcbn;++ )o );
			}
		}er */oSt caan( Cof ( v110 ) 
	//.1+les ner */
	fr.lenoSt caan( CoaoFooter.leiLengi++ ))oSt caan( CoingFixed[ Search[ oSt caan( CoingFixeol_garian( Co_iOt  )
	m, iTo );
			 *st catings.arepy =trirtMafnSdobject[], oSt caa Search].nT++ ener */
	for ( i=cings.aaoFooter.length ; i<iLen ;  i++ ))iOt  )
	arced[ Search[iol_garian( Co_iOt  )
	m,++ ))	}
)
	arcs t ar+ )oSt caa Search[ iOt  )
	arcbj[ pst catings.arepys.aoData))	}
)
	arcelity tofor t ar+ )oSt caagarian( Co		anTagiOt  )
	arcbn;++ )o );
		g	 *is;
	}


	/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * Mile )drop the d(ag|| *an * * */

	)ddia wile )dthn /* Sort lrt itphrtyclu	 *TH t be anse (iTo).
 *  @is.Mile rtAttach
	s point
 *  @param
)
	arcemeCol
	s point
 *  @ers all eTh*TH t be anih).ofnitia*/

	oint
 *  @retur	s poipriv ca|| *anc"is.Mile rtAttach":astSort, fuii, eTh*n ; i++ )
	).coureIndeSec+$(umns[in( 'wile dthnagarian( Co'LastSort, fuengi++ )e. *Fire Dobject();
t))).co*is.Mile DthnacCon(	).cotae, eTh*n;
t)pts || ,
* * * */

	Mile )dthn onso*TH t be aniini o, ised s in thse (iTo).
 *  @is.Mile Dthn
	s point
 *  @eablese	Mile )eable
	s point
 *  @ers all eTh*TH t be ani columd(agged
	s point
 *  @retur	s poipriv ca|| *anc"is.Mile Dthn":astSort, fuie, eTh*n ; i++ )
	).coureIndeSe );s
	Stortomisable infoabououort	wile )tch the  used
		 *whrgetoettie.whrget dh)osest('mns.tdsplit('.')offaTaureIhrget.offaTa(plit('.')			oCont
seInt( $(umns[g );(' = $-igger( meCol'), 	if .shift();

dxerCascument, uenum*1 ) ) {
			return;e
	 */.wile . whrtXoCoe. ageX;rn;e
	 */.wile . whrtYoCoe. ageY;rn;e
	 */.wile .offaTaXoCoe. ageXl-soffaTa.lef ;rn;e
	 */.wile .offaTaYoCoe. ageYl-soffaTa.top;rn;e
	 */.wile .whrgetoete
	 */. tSettings.ao

dxeolnTh;//whrgetttings;e
	 */.wile .whrgetrtBefore
dxngs;e
	 */.wile .itiortBefore
dxng++ e
	 *is.Regolumn);x );s
	)ddiTables' event irt ite(window,  used
$(window, n ;  [in( 'wile mentagarian( Co'LastSort, fuengi++ ))).co*is.Mile 	/*
acCon(	).cotaebn;++ )o n ;  [in( 'wile upagarian( Co'LastSort, fuengi++ ))).co*is.Mile UpacCon(	).cotaebn;++ )o n || ,
* * * */

	Deal/RRANya wile )mentiTables + 1;
dragge foa// Tabl (iTo).
 *  @is.Mile 	/*

	s point
 *  @eablese	Mile )eable
	s point
 *  @retur	s poipriv ca|| *anc"is.Mile 	/*
":astSort, fuie*n ; i++ )
	).coureIndeSe );er */e
	 *dom.drag =nTFoot !== null )s
	Onl/* re* Calculdrag t be aniifuort	wile )hn, mentdia this is  disngs.o Conv* Swi whrt
etnIswto thy- e
	 lConow p Updust lrt meds smConvwile )ment DOM  weon sings.a the ootx, so w
etnIswto	rrenisibifuss.a drag t be anishthe foup
etnIsDa.sng ) {Math.pow(++ ))Math.pow(e. ageXl-se
	 */.wile . whrtX, 2) +++ ))Math.pow(e. ageYl-se
	 */.wile . whrtY, 2), 0.5enu< 5en ;  i++ ))nt
 * eIndTo );
e
	 *is.Cre* C*ragnt.cy)g[idex );s
	P
	/* Repositt be ani-ndexrethistowt thaiepositt be aniosith).of ocateed used
e
	 *dom.drag.cssagi++ )lef : e. ageXl-se
	 */.wile .offaTaX,++ )top: e. ageYl-se
	 */.wile .offaTaY
t)pts |		}
		}ainitialiculate the wile )tch the , ca
		/* Cawt tha takment tondChildgo used
		 *bSetf=? true : B		 *lastTortBeforee
	 */.wile .wortBef;urn;et=[];
	for 1 var i=e
	 */.aoThrgetss.aoData.length ; i<iLen ; i++ )
		{
e. ageXl< e
	 */.aoThrgets[i-1].x + ((e
	 */.aoThrgets[i].x-e
	 */.aoThrgets[i-1].x)/2) n ;  i++ ))e
	 *dom.to ther.cssag'lef ', e
	 */.aoThrgets[i-1].x n;++ ))).	 */.wile .wortBef = e
	 */.aoThrgets[i-1].to;++ ))bSetf=?obje;++ ))bre*knTndex );
			}
/eTtakment tot be aniwasat wto be reposlementsparam (/* Po).cn		}
/e * *ator)ay indexn thitvcouort	 forcng ) {
bSetfn ; i++ )e
	 *dom.to ther.cssag'lef ', e
	 */.aoThrgets[e
	 */.aoThrgetss.aoDat-1].x n;++ )).	 */.wile .wortBef = e
	 */.aoThrgets[e
	 */.aoThrgetss.aoDat-1].to;++ 
			}
/ePersablelity tofor g )re*ltime-ins cfor gs onsond lculate thehn, mentd oter */e
	 */.it[*.bRe*ltime-&&*lastTortBefo!=ree
	 */.wile .wortBef )gi++ )e
	 */. tSettings.o{xt.oApi.fnCo(oe
	 */.wile .itiortBef,ee
	 */.wile .wortBef );++ ;e
	 */.wile .itiortBeforee
	 */.wile .wortBef;u	+ e
	 *is.Regolumn);xings(),
* * * */

	Fit[shsoffuort	wile )drag the ment tolculate thewt tha1.10edbl (iTo).
 *  @is.Mile Up
	s point
 *  @eablese	Mile )eable
	s point
 *  @retur	s poipriv ca|| *anc"is.Mile Up":astSort, fuie*n ; i++ )
	).coureIndeSe );$(window, n.off( 'wile mentagarian( Co wile upagarian( Co' )Se );er */e
	 *dom.drag !nTFoot !== null )s
	R mentolculguion the DOM  *ancd
e
	 *dom.drag.t clae();++ )e
	 *dom.to ther.t clae();++ )e
	 *dom.dragoreIndex ot)e
	 *dom.to theroreIndex = n;s
	)ctuspecift ite(intless reord)e
	 */. tSettings.o{xt.oApi.fnCo(oe
	 */.wile .itiortBef,ee
	 */.wile .wortBef );++ ;e
	 *is.SteoApi._fnColenSett
		}
		Weon scrolly swIn 1.10 we *Fca
		/* Calculate thesizeh melConowePi/i o, num =o Footter */e
	 */.dtx Scroll.sXaoFoo""ts, e
	 */.dtx Scroll.sYaoFoo""tn ; null ))e
	 */. tSettings.o{
		dgaritings.Sizy s(? trueoreInd 
			};
		Savei o, nt can upd))e
	 */. tSettings.o{
		this.SaveSt ca*/e
	 */.dt].nT++ ter */e
	 */.intlessCConback .nTFoot !== nnull ))e
	 */.intlessCConback.cCon(	).is ettin)o );
		g	 *is;
;
	}

	/*
	 * Caadate rowparam RRANy tak o thslRfe Update th ment ts,sond lcu
	}

Reord o thsbl (iTo).
 *  @is.Regolum
	s point
 *  @retur	s poipriv ca|| *anc"is.Regolum":astSort, fun ; i++ )
	ettings.aoete
	 */. tSettings.anT++ e
	 */.aoThrgetss	aArray.0, e
	 */.aoThrgetsaoFooteonnT++ e
	 */.aoThrgetss	anTagi++ )"f":t $(e
	 */. tSetting).offaTa(p.lef ,0] )"wm,
	0
t)pts |		}
	forTo	{
		 =/0;rn;et=[];
	for ( var i=0ttings.aaoFooter.length ; i<iLen ; i++ )/ls.
 * Update th /s in thslemquesthe , In waaniit'si

	/* Re we *Fmaiialise on tifuort
etnIsi

	/* Re isngariatoiit'siimwww.steilef aor t   Cay indexonl/*inc*Fmbe aniosithintoCo	dy 
etnIsivent s Search
etnIsDa.sng ) {i !=oe
	 */.wile .itiortBefo== nnull ))rTo	{
		++eInd 
			};g ) {ettings.aoCol[iFrom].!== nnull ))e
	 */.aoThrgetss	anTagi++ ) )"f":t $(ettings.aoColnTh).offaTa(p.lef  + $(ettings.aoColnTh).ouoCoWidth(),++ ))c"tm,
		"iP{
		++ ))}{reIndTo );ex );s
	DisConowe Search]et=[bey swintlessally adrag the d( obj into, fit   Cotoilef a Footg ) {e
	 */.fSortR   C .nTF0en ; i++ )e
	 */.aoThrgetss	aArray.e
	 */.aoThrgetsaoFooteo- e
	 */.fSortR   C n; );ex );s
	DisConowe Search]et=[bey swintlessally adrag the d( obj into, filef art t   Co Footer */e
	 */.fSort .nTF0en ; i++ )e
	 */.aoThrgetss	aArray.0,/e
	 */.fSort );xings(),
* * * */

	repyiositTH t be ani e hops[bey swdrag*
 *p Updust lhn,  takmdea t.couortm  ravcctuspec*/

	mordnghitvcswitcy tak age.
	 (iTo).
 *  @is.ore* C*ragnt.c
	s point
 *  @retur	s poipriv ca|| *anc"is.ore* C*ragnt.c":astSort, fun ; i++ )
	scrolly sw=/e
	 */.dtx Scroll.sXaoFoo""ts, e
	 */.dtx Scroll.sYaoFoo"" |		}
	foot   datoete
	 */. tSettings.ao
e
	 */.wile .whrgetrtBefoolnTh;		}
	foot  Troreot   dat.der thnt.c;		}
	foot  T in oreot  Tr.der thnt.c;		}
	foot  Tsed oetot  T in .der thnt.c;		}
	foclrep datoet$(ot   dat dh)onen);x );s/it
 *
	 lC sl   Cl/*oddihombine infoinstanceofthe DOMta arrch isiort
ets/ifastese the etaitxret* This thensivreway IncChilde
	nkx is lRee b
ets/i o, ised sRRANygarian ss.ad s in thread therch.
 )e
	 *dom.dragore$(ot  Tsed dh)onent.cy true)n ;  [addCPubl( 'DTCR_h)onedTsed ' n ;  [ and a(++ ))$(ot  T in .h)onent.cy true)n[ and a(++ )))$(ot  Tr.h)onent.cy true)n[ and a(++ )))	clrep dat[0]++ ))))
 ))))
 )))
 )).cssagi++ )	

	/* Re: 'absingte',++ ))top: 0,++ ))lef : 0,++ ))width:t$(ot   dat douoCoWidth(),++ ))he   C:t$(ot   dat douoCoHe   C()
 ))} n ;  [ and aTo( 'body'ts |		}e
	 *dom.to therore$('<div></div>'n ;  [addCPubl( 'DTCR_to ther' )
 )).cssagi++ )	

	/* Re: 'absingte',++ ))top: scrolly sw?++ )))$('divn = $.fn.ds_scroll', e
	 */. tSettingWr andr).offaTa(p.top :++ )))$(e
	 */. tSetting).offaTa(p.top,++ ))he   C : scrolly sw?++ )))$('divn = $.fn.ds_scroll', e
	 */. tSettingWr andr).he   C() :++ )))$(e
	 */. tSetting).he   C()
 ))} n ;  [ and aTo( 'body'ts |ng	 */ * */

	Cleug-inugarian( Conmbevar fied by rs the Tables' event 
	 (iTo).
 *  @is.Diclity
	s point
 *  @retur	s poipriv ca|| *anc"is.Diclity":astSort, fun ; i++ )
	e;
	var;urn;et=[];r ( var i=e
	 */. tSetDrawoConback	.aoData.length ; i<iLen ; i++ )
		{
e
	 */. tSetDrawoConbackLastS(dt.erCasegs, 1, "Co_Pre'!== nnull ))e
	 */. tSetDrawoConback		aArray.se( iF;++ ))bre*knTndex );
			}$(e
	 */. tSetting).fSfnSd'*' n.off( 'agarian( Co' )Se );iable
		e
	 */. tSettings.aLastSort, funct Searc)gi++ )$( SearclnTh).t claeA );(' = $-igger( meCol');
t)pts |		}e
	 */. tSettings._colreIndex 	}e
	 */lreIndex 	g	 * * * */

	)ddia 	// thte is diart lculate thehin thsay indexkalue is visiblof*/

	ite(iowe column n( Coed. T
	 lConow pfast detectinfoins is visib,sond*/

	Pi/i objeo other melworksRRANyaSorttings.s objectlrep,  takl dat.r	s poipriv ca|| *anc"is.SteoApi._fnColen":astSort, fun ; i++iable
		e
	 */. tSettings.aLastSort, funct Searc)gi++ )$( SearclnTh).g );(' = $-igger( meCol' van;
t)pts || e};
* 
] ); ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ;
}


t - a nt
 *eterr opopopopopopopopopopopopopopopopopopopopopopopopopopopopopopopopopopopopopopopopopopopopopopopop/ ] );
};


/**
 * Col object
aTables sPi/iit[* *);

ai *};

	/**
	 * @n};

	/st - a optigarian( ColReorder.P	this;
* * * *rement, uety tofor fore Update thsinEnsurlida shippliedobject - autom * * ontit[* *);

ai *.	Ifnootxthis ised reon tcults ColnEnsu Update thsier */

	Piitcy oabakmeu Upd{
		 isiortlts Colle d.r	s poise ies as 
	 (iToReorderance
n";

	/st - a ttingsy). For
tting    lseUss.aiortl`ogarian( Co`/Reordeomeu Updrol for DalReorder@param 
tting    ti'#y). For' dt.eq(0).da {
tting        "sD{
		"'Rlf* ip',
tting        "ogarian( Co":t[0]ting            "VaO( Co":	[ 4, 3, 2Setti0 ]0]ting        }0]ting    pts || * ttingsy). For
tting    lseUss.ai`new` der
 * @constting    ti'#y). For' dt.eq(0).da)
| *
tting   ttingarian = $.fn.dagarian( Co(o'#y). For',t[0]ting        "VaO( Co":	[ 4, 3, 2Setti0 ]0]ting    pts || *ancVaO( Cotance
	 */ * */

	Redrawrto, ised 'sgate then( Cos.a tsiortlend wilr draw p Update th*/

	(`obje`)aor wach nto,li o, wile )isireetaild	(` true` -dReorder).e row
ttinnEnsu Uisvalidapersablea redrawronions flity tofor s objecinvolvrs th*/

	)jaxfliquestions ftime-if you  ravass.aiilrver-g tok *  rsss.aiih*/

	rol for Da.r	s poise iebooleug
	 (iToReordera truen";

	/st - a ttingsy). For
tting    lseUss.aiortl`ogarian( Co`/Reordeomeu Updrol for DalReorder@param 
tting    ti'#y). For' dt.eq(0).da {
tting        "sD{
		"'Rlf* ip',
tting        "ogarian( Co":t[0]ting            "bRe*ltime":tobje0]ting        }0]ting    pts || * ttingsy). For
tting    lseUss.ai`new` der
 * @constting    ti'#y). For' dt.eq(0).da)
| *
tting   ttingarian = $.fn.dagarian( Co(o'#y). For',t[0]ting        "bRe*ltime":tobje0]ting    pts || *ancbRe*ltime ? true	 */ * */

	Indicatn howemanydate thsindChild shfSort infrom one po into, fiConvelcu
	}

lef ). T
	 lalidase  automd sh1-if le dta arrpoint),tsih   ,tsiyou like.r	s poise ieint
	 (iToReordera0n";

	/st - a ttingsy). For
tting    lseUss.aiortl`ogarian( Co`/Reordeomeu Updrol for DalReorder@param 
tting    ti'#y). For' dt.eq(0).da {
tting        "sD{
		"'Rlf* ip',
tting        "ogarian( Co":t[0]ting            "iaSort */
	/*":t10]ting        }0]ting    pts || * ttingsy). For
tting    lseUss.ai`new` der
 * @constting    ti'#y). For' dt.eq(0).da)
| *
tting   ttingarian = $.fn.dagarian( Co(o'#y). For',t[0]ting        "iaSort */
	/*":t10]ting    pts || *anciaSort */
	/*: 0,+ * * */

	)s `iaSort */
	/*R   C`a arrpinto, fiConvelcu t   C.r	s poise ieint
	 (iToReordera0n";

	/st - a ttingsy). For
tting    lseUss.aiortl`ogarian( Co`/Reordeomeu Updrol for DalReorder@param 
tting    ti'#y). For' dt.eq(0).da {
tting        "sD{
		"'Rlf* ip',
tting        "ogarian( Co":t[0]ting            "iaSort */
	/*R   C":t10]ting        }0]ting    pts || * ttingsy). For
tting    lseUss.ai`new` der
 * @constting    ti'#y). For' dt.eq(0).da)
| *
tting   ttingarian = $.fn.dagarian( Co(o'#y). For',t[0]ting        "iaSort */
	/*R   C":t10]ting    pts || *anciaSort */
	/*R   C: 0,+ * * */

	CConbackeorder =   e hops[fisallweon ate thsier mn n( Coedr	s poise ieorder = f):retur	s poiReorderance
n";

	/st - a ttingsy). For
tting    lseUss.aiortl`ogarian( Co`/Reordeomeu Updrol for DalReorder@param 
tting    ti'#y). For' dt.eq(0).da {
tting        "sD{
		"'Rlf* ip',
tting        "ogarian( Co":t[0]ting            "TaRetlessCConback":astSort, funt[0]ting                alert(segs, thsin n( Coed'ts || *              }0]ting        }0]ting    pts || * ttingsy). For
tting    lseUss.ai`new` der
 * @constting    ti'#y). For' dt.eq(0).da)
| *
tting   ttingarian = $.fn.dagarian( Co(o'#y). For',t[0]ting        "TaRetlessCConback":astSort, funt[0]ting            alert(segs, thsin n( Coed'ts || *          }0]ting    pts || *stenaRetlessCConbacktance
e};
* 
); ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ;
}

oAr
 awo elemememememememememememememememememememememememememememememememememememememememememememememememe/] );
};


/**
 * Colirrsi *};

	/cAr
 awo lirrsi *};

	/ i* Pi/i  Saram 
tings object
		)s  ode optigarian( Colirrsi *P	t"1.1.3";
* 
); ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ;
}

 {
		// Datitterface elemememememememememememememememememememememememememememememememememememememememememememememememe/] )/ Exrome
arian = $.fn.dagarian( CoP	tgarian( Co;
arianD= $.fn.dagarian( CoP	tgarian( Co;
] )/ Regosheroattingfeamn ssRRANyrol for Dat}
	else if (arian = $.fn.dr== "stSort, "== n/i  lse if (arian = $.fn.dataTfnVrrsi *CSanit== "stSort, "== n/i  larian = $.fn.dataTfnVrrsi *CSani('1.9.3')dt, oparian = $.fn.dataTaoFeamn sss	anTagi++ "ppinic":astSort, (
aTables s)gi++ )v doised oets*/
	$(oSettings.onT++ ter */! sf ( oDTSettings._colReorde++ )
	{tinicoets*/
	$(oSettit;rde++ )
	fault=	{tinic.ttings._col||	{tinic.ogarian( Cots, opoData))tinggarian( Co(os*/
	$(odefault)nTndex );	}
		}
		el	ised {
		this.oApi.s*/
	$(odettings, 1, "Colattempt10 we e can't inie tab. Ignors.aisecond"oreInd 
			};nt
 * eIndex ); Nokl da control for Da element to*stec},++ "cFeamn s":inR",++ "sFeamn s":ingarian( Co"
)pts |}
}
		}
		alert(s"Waree b:ggarian( Cofliquisa, just as Dat1.9.3aor gre* Col-swwwn = $ised s.net/dthnload"s |}
] )/ API auge an
ai *}ings;

	if ( $.fn.dataTable.A

	if ( $.fn.dataT.regosher.triggian( Colree g()'LastSort, fu)  i++To );
eInde.it *ator(se() ===LastSort, fu ctf )gi++ )ctfSettings._coaTaRee g();
t)pts |)pts |		

	if ( $.fn.dataT.regosher.triggian( Coln( Co()'LastSort, fuysteent{i++ )
	{steent{i+++To );
eInde.it *ator(se() ===LastSort, fu ctf )gi++ ))ctfSettings._coaTaO( Co(os*/bn;++ )o n || 
			}To );
eInde.t whexaDataSort?++ )Inde.t whexa[0]Settings._coaTaO( Co() :++ )Index
)pts |}

To );
egarian( Co;
}; lse/factory
] )/ Dent,  sourceAMD module-if 

	rrentt}
	else if (ment, erCasestSort, !== (ment, .amuenum*1ment, ( ['jqnceo=La' = $ised s'], factoryts |}
}
		}}
	else if (exrortserCaseparam = 'tab    lsent.c/CommonJSb    factory(fliquisa('jqnceo=),fliquisa(' = $ised s')ts |}
}
		}}
	eltanceof&&l!tanceorian = $.fn.dagarian( CoPnum*1lseOent w inisimplr already in sounablel, stoInver mectiFor ethe 
ai *}	factory(ftanceo, tanceorian = $.fn.dts |}


})(windth,(window, s |