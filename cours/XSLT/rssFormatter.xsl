<xsl:stylesheet version="2.0"
                xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
                xmlns:xs="http://www.w3.org/2001/XMLSchema"
                xmlns="http://www.w3.org/TR/xhtml1/strict">
    <xsl:output method="html"/>
    <html>
        <head>

        </head>
        <body>
        <xsl:template match="/">

            <xsl:for-each select="feed_info/entry_1">
                <Record>
                    <ID><xsl:value-of select="id" /></ID>
                    <PublicationDate><xsl:value-of select='xs:dateTime("1970-01-01T00:00:00") + xs:integer(pub_date) * xs:dayTimeDuration("PT1S")'/></PublicationDate>
                </Record>
            </xsl:for-each>
        </Records>
        </xsl:template>
    </body>
    </html>
</xsl:stylesheet>