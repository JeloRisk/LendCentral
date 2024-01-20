"""
BNF PROGRAM

<program> ::= <statement> { <statement> }*
Pp
<statement> ::= <declaration>

<declaration> ::= <identifier> '=' <expression>

<expression> ::= <literal> | <identifier>

<literal> ::= <integer_literal> | <float_literal> | <string_literal>

<integer_literal> ::= ["-"] <digit> { <digit> }

<float_literal> ::= ["-"] <digit> { <digit> } "." <digit> { <digit> }

<string_literal> ::= '"' <character>* '"'

<character> ::= <any printable character>

<identifier> ::= <letter> | "_" { <letter> | <digit> | "_" } 

<letter> ::= "a" | "b" | ... | "z" | "A" | "B" | ... | "Z"

<digit> ::= '0' | '1' | '2' | ... | '9'


"""

def validateletter(char):
    """
    Function to parse <letter> rule.

    Parameters
    ----------
    char : str
        The character to be validated.

    Returns
    -------
    bool
        True if the character is a letter, False otherwise.
    """
    return 'a' <= char <= 'z' or 'A' <= char <= 'Z'


def validatedigit(char):
    """
    Function to parse <digit> rule

    Parameters
    ----------
    char : str
        The character to be validated.

    Returns
    -------
    bool
        True if the character is a digit, False otherwise.
    """
    return '0' <= char <= '9'


def validateidentifier(string):
    """
    Function to parse <identifier>

    Parameters
    ----------
    string : str
        The identifier to be validated.

    Returns
    -------
    bool
        True if the identifier is valid, False otherwise.
    """
    if not string:
        return False
    if not validateletter(string[0]) and string[0] != '_':
        return False
    for char in string[1:]:
        if not validateletter(char) and not validatedigit(char) and char != '_':
            return False
    return True


def validateinteger_literal(string):
    """
    Function to parse <integer_literal>

    Parameters
    ----------
    string : str
        The integer literal to be validated.

    Returns
    -------
    bool
        True if the integer literal is valid, False otherwise.
    """
    return string.isdigit() or (string[0] == '-' and string[1:].isdigit())


def validatefloat_literal(string):
    """
    Function to parse <float_literal>

    Parameters
    ----------
    string : str
        The float literal to be validated.

    Returns
    -------
    bool
        True if the float literal is valid, False otherwise.
    """
    parts = string.split('.')
    if len(parts) == 2 and validateinteger_literal(parts[0]) and parts[1].isdigit():
        return True
    return False


def validatestring_literal(string):
    """
    Function to parse <string_literal>

    Parameters
    ----------
    string : str
        The string literal to be validated.

    Returns
    -------
    bool
        True if the string literal is valid, False otherwise.
    """
    return string.startswith('"') and string.endswith('"')


def literal(string):
    """
    Function to parse <literal>

    Parameters
    ----------
    string : str
        The literal to be validated.

    Returns
    -------
    bool
        True if the literal is valid, False otherwise.
    """
    return validateinteger_literal(string) or validatefloat_literal(string) or validatestring_literal(string)


def valiidateexpression(string):
    """
    Function to parse <expression>

    Parameters
    ----------
    string : str
        The expression to be validated.

    Returns
    -------
    bool
        True if the expression is valid, False otherwise.
    """
    return literal(string) or validateidentifier(string)


def validatedeclaration(string):
    """
    Function to parse <declaration>

    Parameters
    ----------
    string : str
        The declaration to be validated.

    Returns
    -------
    bool
        True if the declaration is valid, False otherwise.
    """
    parts = string.split('=')
    if len(parts) == 2:
        identifier_part, expression_part = map(str.strip, parts)
        return validateidentifier(identifier_part) and valiidateexpression(expression_part)
    return False


def statement(string):
    """
    Function to parse <statement>

    Parameters
    ----------
    string : str
        The statement to be validated.

    Returns
    -------
    bool
        True if the statement is valid, False otherwise.
    """
    return validatedeclaration(string)


def program(string):
    """
    Function to parse <program>

    Parameters
    ----------
    string : str
        The program to be validated.

    Returns
    -------
    bool
        True if the program is valid, False otherwise.
    """
    statements = string.split(';')
    return all(statement(stmt.strip()) for stmt in statements)


def main():
    user_input = input("Enter a program: ")
    try:
        if program(user_input):
            print("Valid Program")
        else:
            print("Invalid Program")
    except Exception as e:
        print("Invalid Program")

if __name__ == "__main__":
    main()


