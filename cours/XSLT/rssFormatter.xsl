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
                <h1><xsl:value-of select="channel/title"/></h1>
                <h1><xsl:value-of select="channel/description"/></h1>
                <ul>
                <xsl:for-each select="channel/item">
                    <ul>
                        <li><xsl:value-of select="title" /></li>
                        <li><xsl:value-of select="description" /></li>

                    </ul>
                </xsl:for-each>
                </ul>
            </body>
        </html>
    </xsl:template>
</xsl:stylesheet>