<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE xsl:stylesheet SYSTEM "xhtml-math11-f.dtd">
<xsl:stylesheet version="2.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
xmlns:doc="espaceDoc"
xmlns:xs="http://www.w3.org/2001/XMLSchema"
xmlns:m="http://www.w3.org/1998/Math/MathML">

<xsl:output 
  method="html"
  encoding="UTF-8"
  doctype-public="-//W3C//DTD XHTML 1.1 plus MathML 2.0//EN"
  doctype-system="xhtml-math11-f.dtd"
  indent="yes" />


<xsl:template match="/">
  <html><body>
     <xsl:apply-templates select="@*|*|text()|processing-instruction()" />
  </body></html>
</xsl:template>

<xsl:template match="phrase[lit/*[position()=last() and self::ponctuation]]">YOP<xsl:value-of select="."/></xsl:template>

<xsl:template match="doc:doc">
	<h1>Test</h1>
	<xsl:value-of select="phrase[lit/*[position()=last() and self::ponctuation]]"/>
  <h1>Statistiques du document</h1>
	<ul>
		<li>Nombre de phrases:<xsl:value-of select="count(phrase)"/></li>
		<li>Nombre de mots:<xsl:value-of select="count(phrase/lit/mot) + count(titre/lit/mot) + count(ul/li/mot)"/></li>
		<li>Nombre d'expressions mathématiques:<xsl:value-of select="count(phrase/m:math) + count(titre/m:math) + count(ul/li/m:math)"/></li>
		<xsl:variable name="nbComplexe" as="xs:integer" select="count(phrase/m:math[descendant::m:mfrac or descendant::m:msqrt])
			+ count(titre/m:math[descendant::m:mfrac or descendant::m:msqrt])
			+ count(ul/li/m:math[descendant::m:mfrac or descendant::m:msqrt])"/>
		<li>Nombre d'expressions mathématiques "complexes":<xsl:value-of select="$nbComplexe"/></li>
		<li>Titres de niveau 1 non suivi de titres de niveau 2:
			<ul>
				<xsl:for-each select="titre[@niveauOrig='1']">
					<xsl:if test="following-sibling::titre[1]/@niveauOrig = '1'">
						<li><xsl:value-of select="."/></li>
					</xsl:if>
				</xsl:for-each>
			</ul>
		</li>
	</ul>
  <hr/>
	<h1>Sommaire</h1>
	<ul>
	<xsl:for-each select="titre[@niveauOrig='1']">
		<li>
		<xsl:call-template name="titreMath"/>
		<xsl:if test="following-sibling::titre/@niveauOrig='2'">
			<ul>
				<!-- Nombre de titres de niveau 1 suivant ce titre de niveau 1 -->
				<xsl:variable name="posSuiv" select="count(following-sibling::titre[@niveauOrig='1'])"/>
				<!-- Sous-liste de titres de niveau 2 ayant le même nombre de titre de niveau 1 qui suivent que le titre de niveau un père (valeur de $posSuiv)-->
				<xsl:for-each select="following-sibling::titre[@niveauOrig='2' and count(following-sibling::titre[@niveauOrig='1'])=$posSuiv]">
					<li><xsl:call-template name="titreMath"/></li>
				</xsl:for-each>
			</ul>
		</xsl:if>
		</li>
	</xsl:for-each>
	</ul>
	<hr/>
	<xsl:apply-templates select="@*|*|text()|processing-instruction()"/>
</xsl:template>

<xsl:template match="titre[@niveauOrig='1']">
	<h1>
		<xsl:call-template name="checkTitre"/>
	</h1>
</xsl:template>

<xsl:template match="titre[@niveauOrig='2']">
	<h2>
		<xsl:call-template name="checkTitre"/>
	</h2>
</xsl:template>

<xsl:template name="checkTitre">
	<xsl:variable name="valeur" select="."/>
	<xsl:for-each select="*">
		<xsl:choose>
			<xsl:when test="local-name(.)='math'">
				<xsl:copy-of select="."/>
			</xsl:when>
			<xsl:otherwise>
				<xsl:value-of select="translate(., 'abcdefghijklmnopqrstuvwxyzàâéèêëîïôùûüáíóúñìòäö', 'ABCDEFGHIJKLMNOPQRSTUVWXYZÀÂÉÈÊËÎÏÔÙÛÜÁÍÓÚÑÌÒÄÖ')"/>
			</xsl:otherwise>
		</xsl:choose>
		<xsl:text> </xsl:text>
	</xsl:for-each>

	<xsl:if test="preceding-sibling::titre[.=$valeur]">
		<xsl:value-of select="'(#2)'"/>
	</xsl:if>
</xsl:template>

<xsl:template name="titreMath">
	<xsl:for-each select="*">
		<xsl:choose>
			<xsl:when test="local-name(.)='math'">
				<xsl:copy-of select="."/>
			</xsl:when>
			<xsl:otherwise>
				<xsl:value-of select="."/>
			</xsl:otherwise>
		</xsl:choose>
		<xsl:text> </xsl:text>
	</xsl:for-each>
</xsl:template>

<xsl:template match="m:math">
	<xsl:copy-of select="."/>
	<xsl:call-template name="grec">
		<xsl:with-param name="noeud" select="."/>
	</xsl:call-template>
</xsl:template>

<xsl:template name="grec">
	<xsl:param name="noeud"/>
	<xsl:if test="./descendant::*[contains(.,'&#945;') or contains(.,'&#916;')]">
		<xsl:text> (contient des lettres grecques)</xsl:text>
	</xsl:if>
</xsl:template>

<xsl:template match="lit">
	<xsl:call-template name="titreMath"/>
</xsl:template>

<xsl:template match="ul">
	<p>
	<ul>
		<xsl:apply-templates select="@*|*|text()"/>
	</ul>
	</p>
</xsl:template>

<xsl:template match="phrase">
	<p>
		<xsl:apply-templates select="@*|*|text()"/>
	</p>
</xsl:template>

<xsl:template match="li">
	<li>
		<xsl:apply-templates select="@*|*|text()"/>
	</li>
</xsl:template>

</xsl:stylesheet>
  
