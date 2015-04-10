<xsl:stylesheet version="2.0"
                xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
                xmlns:xs="http://www.w3.org/2001/XMLSchema"
                xmlns="http://www.w3.org/TR/xhtml1/strict">
    <xsl:output method="html"/>
    <xsl:template match="/">
        <html>
            <head>
            </head>
            <body>
                <h1>L'actualité de la santée</h1>
                <h2><xsl:value-of select="rss/channel/title"/></h2>
                <h3>Nombre d'articles : <xsl:value-of select="count(rss/channel/item)"/></h3>
                <ul>
                <xsl:for-each select="rss/channel/item">
                    <li><ul>
                        <li><xsl:value-of select="title" /></li>
                        <li><xsl:value-of select="description" /></li>
                        <li><a><xsl:value-of select="link" /></a></li>
                    </ul></li>
                </xsl:for-each>
                </ul>
            </body>
        </html>
    </xsl:template>
</xsl:stylesheet>