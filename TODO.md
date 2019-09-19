Classes
=======

## OpenTexts
Interaction [user, Texts]

   *Opens files in order to process them in
   the main program. It returns both the text
   as a string, and an array containing the
   text broken into paragraphs.*

   - Opens .txt files     ✓
   - Opens .docx files
   - Opens .pdf files

## PrepText
Interaction [Text Opener, Match]

   *Prepares texts for processing, one paragraph
   at a time, returning various data structures:*

   - $text: the paragraph as typed in the document.
   - $words: the paragraph, stripped of punctuation
     and split on white-space.
   - $keywords: an array of the index (in $words) of
     all content words (i.e. not 'the', 'and', etc).

## Match
Interaction [Texts, Matches]

   *This is the class that does the searching work,
   and saves results. The final text will be
   represented as an array of these objects*

   - Takes in $keyword
   - Searches forwards
   - Searches backwards
   - Stores index span in $text
   - Stores index span in $words
   - Stores info in the type of formatting required
   - Stores info on how 'greedy' the regex is (L & R)

## Span Match (extends Match)
Interaction [Matches]

   *This is a version of `Match` which is not passed
   $keyword, but the span in $text. It is used for
   filling in gaps in the text which are not covered
   by `Match` objects representing plagiarism.*

## MatcheBundle
Interaction [Match, Span Match, Texts, Overlaps, Text]

   *This is an array of all the plagiarised sections
   of $text, represented by `Match` objects. It has
   a few functions:

   - Handles the greediness of the Match objects, so
     that white-space and punctuation are not duplicated.
   - Handles any overlaps between two Matches
   - Inserts extra `Span Match` objects to represent
     all text which is *not* plagiarised.

## FixOverlaps
Interaction [Matches]

   *A class to handle any overlaps in the paragraph
   i.e. the `Matches` object.*

## BuildParagraph
Interaction [Matches]

   *This takes in an array of `Match` objects, which
   represents a complete paragraph (no gaps). I.e. it
   is the same as $text, but with all the formatting
   information. It outputs a formatted object ready
   to be written to one of the following text formats:

   - .docx
   - .html
   - .php
   - .markdown
