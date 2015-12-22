
-----------------------------------------------------------------------
-- content
-----------------------------------------------------------------------

DROP TABLE IF EXISTS [content];

CREATE TABLE [content]
(
    [id] INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
    [page_name] VARCHAR(255) NOT NULL,
    [content] MEDIUMTEXT NOT NULL,
    UNIQUE ([id])
);
