#!/usr/bin/env python

from lxml import etree


def validate(schema_file, data_file):

    data    = etree.parse(open(data_file))
    schema  = etree.XMLSchema(etree.parse(open(schema_file)))

    schema.assertValid(data)


if __name__ == '__main__':

    import sys

    try:
        schema_file, data_file = sys.argv[1:3]
    except:
        print ("Usage: %s <schema-file> <data-file>" % sys.argv[0])
        sys.exit(128)

    try:
        validate(schema_file, data_file)
        print("%s: %s is Valid." % (schema_file, data_file))
        sys.exit(0)

    except etree.DocumentInvalid:
        print("%s: %s is NOT VALID!" % (schema_file, data_file))
        sys.exit(1)

